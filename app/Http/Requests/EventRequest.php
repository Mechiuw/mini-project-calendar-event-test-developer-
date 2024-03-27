<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }

    /**
     *
     *
     * @return array<string
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ];
    }
}
