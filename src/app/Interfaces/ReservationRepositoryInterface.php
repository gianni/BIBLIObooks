<?php

namespace App\Interfaces;

interface ReservationRepositoryInterface
{
    public function all();

    public function create(array $data);
}
