<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Cache;

class ContactService
{
    public function list(
        int $userId,
        array $filters = [],
        ?string $search = null,
        string $sortBy = 'first_name',
        string $sortOrder = 'asc'
    ) {
        $cacheKey = 'contacts:user=' . $userId
                    . ':search=' . ($search ?? 'all')
                    . ':sort=' . $sortBy . '_' . $sortOrder
                    . ':filters=' . md5(json_encode($filters));

        return Cache::remember($cacheKey, 60, function () use ($userId, $filters, $search, $sortBy, $sortOrder) {

            $query = Contact::query()
                ->where('user_id', $userId)
                ->select('id', 'user_id', 'first_name', 'last_name', 'phone', 'email', 'address', 'created_at');

            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "$search%")
                      ->orWhere('last_name', 'like', "$search%")
                      ->orWhere('phone', 'like', "$search%")
                      ->orWhere('email', 'like', "$search%");
                });
            }

            foreach ($filters as $field => $value) {
                if (in_array($field, ['first_name', 'last_name', 'phone', 'email'])) {
                    $query->where($field, 'like', "$value%");
                }
            }

            $allowedSort = ['first_name', 'last_name', 'phone', 'email', 'created_at'];
            if (!in_array($sortBy, $allowedSort)) {
                $sortBy = 'first_name';
            }
            $sortOrder = strtolower($sortOrder) === 'desc' ? 'desc' : 'asc';

            $query->orderBy($sortBy, $sortOrder);

            return $query->cursorPaginate(50);
        });
    }

    public function create(array $data): Contact
    {
        $contact = Contact::create($data);

        event(new \App\Events\ContactCreated($contact));

        Cache::tags('contacts_user_' . $contact->user_id)->flush();

        return $contact;
    }

    public function update(Contact $contact, array $data): Contact
    {
        $contact->update($data);

        event(new \App\Events\ContactUpdated($contact));

        Cache::tags('contacts_user_' . $contact->user_id)->flush();

        return $contact;
    }

    public function delete(Contact $contact): void
    {
        $userId = $contact->user_id;
        $contact->delete();

        event(new \App\Events\ContactDeleted($contact));

        Cache::tags('contacts_user_' . $userId)->flush();
    }

    public function bulkDelete(int $userId, array $ids): void
    {
        Contact::where('user_id', $userId)
               ->whereIn('id', $ids)
               ->delete();

        Cache::tags('contacts_user_' . $userId)->flush();
    }
}
