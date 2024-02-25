<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'requester',
        'date_from',
        'date_to',
        'book_id',
    ];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function overlapped($data): bool
    {
        return $this->where(function ($query) use ($data) {
            $query->where('date_to', '>=', $data['date_from'])
                ->where('date_from', '<=', $data['date_to'])
                ->where('book_id', $data['book_id']);
        })->exists();
    }
}
