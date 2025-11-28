<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $service;

    public function __construct(ContactService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $contacts = $this->service->list(
            auth()->id(),
            $request->filter ?? [],
            $request->search ?? null,
            $request->sort_by ?? 'first_name',
            $request->sort_order ?? 'asc'
        );

        return ContactResource::collection($contacts);
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $contact = $this->service->create($data);
        return new ContactResource($contact);
    }

    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact = $this->service->update($contact, $request->validated());
        return new ContactResource($contact);
    }

    public function destroy(Contact $contact)
    {
        $this->service->delete($contact);
        return response()->json(null, 204);
    }

    public function bulkDelete(Request $request)
    {
        $data = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:contacts,id',
        ]);

        $this->service->bulkDelete($data['ids']);

        return response()->json(['message' => 'Contacts deleted successfully.']);
    }
}
