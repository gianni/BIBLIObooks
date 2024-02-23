<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationStoreRequest;
use App\Http\Resources\ReservationCollection;
use App\Http\Resources\ReservationResource;
use App\Interfaces\ReservationRepositoryInterface;

class ReservationsController extends Controller
{
    private ReservationRepositoryInterface $reservationRepository;

    public function __construct(ReservationRepositoryInterface $reservationRepository)
    {
        $this->reservationRepository = $reservationRepository;
    }

    public function index()
    {
        return new ReservationCollection($this->reservationRepository->all());
    }

    public function store(ReservationStoreRequest $request)
    {
        $reservationModel = $this->reservationRepository->create([
            'requester' => $request->requester,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'book_id' => $request->book_id,
        ]);

        return new ReservationResource($reservationModel);
    }
}
