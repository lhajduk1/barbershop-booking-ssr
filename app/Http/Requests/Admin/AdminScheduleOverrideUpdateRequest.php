<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

final class AdminScheduleOverrideUpdateRequest extends FormRequest
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
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'is_working' => ['boolean'],
            'breaks' => ['array'],
            'breaks.*' => ['array', 'array:date,start_time,end_time'],
            'breaks.*.date' => ['required', 'date'],
            'breaks.*.start_time' => ['required', 'date_format:H:i'],
            'breaks.*.end_time' => ['required', 'date_format:H:i', 'after:breaks.*.start_time'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $breaks = collect($this->input('breaks', []))
            ->map(function (array $break) {
                return [
                    'date' => $this->input('date'),
                    'start_time' => $this->normalizeTime($break['start_time'] ?? null),
                    'end_time' => $this->normalizeTime($break['end_time'] ?? null),
                ];
            })
            ->all();

        $this->merge([
            'start_time' => $this->normalizeTime($this->input('start_time')),
            'end_time' => $this->normalizeTime($this->input('end_time')),
            'is_working' => ! (bool) $this->is_off,
            'breaks' => $breaks
        ]);
    }

    private function normalizeTime(?string $time): ?string
    {
        return $time ? mb_substr($time, 0, 5) : null;
    }
}
