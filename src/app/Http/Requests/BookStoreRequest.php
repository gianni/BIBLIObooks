<?php

namespace App\Http\Requests;

use App\Enums\TicketStatusEnum;
use Illuminate\Validation\Rule;

class BookStoreRequest extends AbstractRequest
{
    public function rules(): array
    {
        $requiredString = 'required|string|max:255';

        return [
            'title' => $requiredString,
            'author' => $requiredString,
            'published_at' => $requiredString,
            'isbn' => $requiredString
        ];
    }
}
