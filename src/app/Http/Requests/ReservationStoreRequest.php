<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use App\Rules\DateRangeNotOverlap;
use Illuminate\Foundation\Http\FormRequest;

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
            'date_from' => 'required|date_format:Y-m-d H:i:s|before_or_equal:date_to',
            'date_to' => [
                'required',
                'date_format:Y-m-d H:i:s',
                'after_or_equal:date_from',
                new DateRangeNotOverlap(new Reservation),
            ],
            'book_id' => 'required|integer',
        ];
    }
}
