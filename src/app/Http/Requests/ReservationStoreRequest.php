<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DateRangeNotOverlap;

class ReservationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $requiredString = 'required|string|max:255';

        return [
            'requester' => $requiredString,
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:date_from',
                new DateRangeNotOverlap
                ],
            'book_id' => 'required|integer',
        ];
    }
}
