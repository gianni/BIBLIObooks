<?php

namespace App\Repositories;

use App\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all()
    {
        return Reservation::paginate(config('paginate.per_page'));
    }

    public function create(array $data)
    {
        return Reservation::create($data);
    }
}
