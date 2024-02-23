<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookResource;

class ReservationResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'requester' => $this->requester,
            'date_from' => $this->date_from->format('Y-m-d'),
            'date_to' => $this->date_to->format('Y-m-d'),
            'book' => new BookResource($this->book)
        ];
    }
}
