<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredString = 'required|string|max:255';

        return [
            'title' => $requiredString,
            'author' => $requiredString,
            'published_at' => 'required|date_format:Y-m-d',
            'isbn' => 'required|string|max:13|min:13'
        ];
    }
}
