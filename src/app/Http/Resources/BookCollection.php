<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return $this->collection->toArray();
    }
}
