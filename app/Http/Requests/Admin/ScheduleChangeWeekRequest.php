<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;

final class ScheduleChangeWeekRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'type' => ['string', 'in:current,previous,next'],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'date' => Date::parse($this->date ?? Date::today()),
        ]);
    }
}
