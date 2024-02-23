<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'author',
        'published_at',
        'isbn',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(reservation::class);
    }
}
