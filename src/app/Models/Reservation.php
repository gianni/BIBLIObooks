<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "requester",
        "date_from",
        "date_to",
        "book_id",
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to' => 'date'
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}