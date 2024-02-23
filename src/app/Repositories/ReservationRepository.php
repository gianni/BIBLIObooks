<?php

namespace App\Repositories;

use App\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all()
    {
        return Reservation::all();
    }

    public function create(array $data)
    {
        return Reservation::create($data);
    }
}
