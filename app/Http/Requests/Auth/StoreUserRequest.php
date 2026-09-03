<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

final class StoreUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'unique:users,email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8',  'max:255', 'confirmed'],
            'agree_to_policies' => ['required', 'accepted'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->first_name.''.$this->last_name,
        ]);
    }
}
