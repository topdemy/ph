<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $contactId = $this->route('contact')->id;

        return [
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|nullable|string|max:255',
            'phone' => ['sometimes','required','string','max:20',
                        Rule::unique('contacts')->ignore($contactId)],
            'email' => ['sometimes','nullable','email',
                        Rule::unique('contacts')->ignore($contactId)],
            'address' => 'sometimes|nullable|string|max:500',
        ];
    }
}
