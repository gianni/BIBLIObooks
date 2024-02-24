<?php

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Reservations Controller', function () {

    test('user can list properly the reservation list', function () {

        $book = Book::create([
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ]);

        Reservation::create([
            'requester'=>'biblio x',
            'date_from'=>'2024-03-01',
            'date_to'=>'2024-03-10',
            'book_id'=> $book->id,
        ]);

        $jsonResponse = $this->getJson('/api/reservations')
            ->assertStatus(200);

        expect($jsonResponse->json())->toHaveCount(1);
    });

});