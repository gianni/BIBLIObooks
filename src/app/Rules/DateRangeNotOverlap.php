<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\DataAwareRule;
use App\Models\Reservation;

class DateRangeNotOverlap implements DataAwareRule, ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    protected $data = [];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $overlap = Reservation::where(function ($query) {
            $query->where('date_to', '>=', $this->data['date_from'])
                  ->where('date_from', '<=', $this->data['date_to'])
                  ->where('book_id', $this->data['book_id']);
        })->exists();

        if($overlap) {
            $fail('The reservation period overlaps with a previous one.');
        }

    }

    public function setData(array $data)
    {
        $this->data = $data;
    }
}
