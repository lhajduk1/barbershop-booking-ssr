<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

final class StoreBookingRequest extends FormRequest
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
            'employee_id' => ['integer', 'exists:employees,id'],
            'starts_at' => ['required', 'date', 'after_or_equal:today'],
            'customer_first_name' => ['required', 'string', 'max:255'],
            'customer_last_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'starts_at' => $this->date && $this->time ? Date::parse($this->date.' '.$this->time)->format('Y-m-d H:i') : '',
        ]);
    }

    // TODO: implement custom more accurate messages.
    public function messages()
    {
        return [];
    }
}
