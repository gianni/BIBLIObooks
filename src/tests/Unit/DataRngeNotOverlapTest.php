<?php

use App\Models\Reservation;
use App\Rules\DateRangeNotOverlap;
use Tests\TestCase;

uses(TestCase::class);

it('passes when there is no overlap', function () {

    $data = [
        'date_from' => '2024-03-01',
        'date_to' => '2024-03-10',
        'book_id' => 1,
    ];

    $reservation = Mockery::mock(Reservation::class);

    $validator = Validator::make($data, ['date_to' => new DateRangeNotOverlap($reservation)]);

    $reservation->shouldReceive('where')->once()->andReturnSelf();
    $reservation->shouldReceive('exists')->once()->andReturnFalse();

    expect($validator->validated())->toBe(['date_to' => '2024-03-10']);

});

it('not passes when there is overlap', function () {

    $data = [
        'date_from' => '2024-03-01',
        'date_to' => '2024-03-10',
        'book_id' => 1,
    ];

    $reservation = Mockery::mock(Reservation::class);

    $validator = Validator::make($data, ['date_to' => new DateRangeNotOverlap($reservation)]);

    $reservation->shouldReceive('where')->once()->andReturnSelf();
    $reservation->shouldReceive('exists')->once()->andReturnTrue();

    try {
        $validator->validated();
    } catch (Exception $e) {
        expect($e->getMessage())->toBe('The reservation period overlaps with a previous one.');
    }

});
