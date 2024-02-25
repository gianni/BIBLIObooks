<?php

use App\Models\Reservation;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

it('creates and soft deletes a reservation', function () {

    // prepare
    $reservation = Reservation::create(
        [
            'requester' => 'biblio x',
            'date_from' => '2024-03-01',
            'date_to' => '2024-03-10',
            'book_id' => 1
        ]
    );

    // act
    $reservation->delete();

    // assert
    $this->assertSoftDeleted(Reservation::class, ['id' => $reservation->id]);
});
