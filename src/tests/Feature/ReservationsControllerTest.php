<?php

use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Reservations Controller', function () {

    test('user can list properly the reservation list', function () {

        // prepare
        $book = Book::create([
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ]);

        // act
        Reservation::create([
            'requester'=>'biblio x',
            'date_from'=>'2024-03-01',
            'date_to'=>'2024-03-10',
            'book_id'=> $book->id,
        ]);

        $jsonResponse = $this->getJson('/api/reservations')
            ->assertStatus(200);

        // assert
        expect($jsonResponse->json())->toHaveCount(1);
    });

    test('a library manager can create a new reservation for a book available in other library', function () {

        // prepare
        $book = Book::create([
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ]);

        // act & assert
        $jsonResponse = $this->postJson('/api/reservations', [
            'requester' => 'biblio x',
            'date_from' => '2024-03-01 12:00:00',
            'date_to' => '2024-03-10 12:00:00',
            'book_id' => $book->id,
        ])
        ->assertStatus(201)
        ->assertJsonPath('requester', 'biblio x')
        ->assertJsonPath('date_from', '2024-03-01 12:00:00')
        ->assertJsonPath('date_to', '2024-03-10 12:00:00')
        ->assertJsonPath('book.title', $book->title);

        ;
    });

    test('a library manager cannot create a new reservation when dates are not valid', function () {

        // prepare
        $book = Book::create([
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ]);

        //act & assert
        $jsonResponse = $this->postJson('/api/reservations', [
            'requester' => 'biblio x',
            'date_from' => '2024-04-01 12:00:00',
            'date_to' => '2024-03-10 12:00:00',
            'book_id' => $book->id,
        ])
        ->assertStatus(422)
        ->assertJsonPath('errors', [
            'date_from' => ['The date from field must be a date before or equal to date to.'],
            'date_to' => ['The date to field must be a date after or equal to date from.'],
        ]);
    });

    test('a library manager cannot create a new reservation when dates for a book overlap other reservations and dates', function () {

        // prepare
        $book = Book::create([
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ]);

        $reservation = Reservation::create([
            'requester'=>'biblio x',
            'date_from'=>'2024-03-01 12:00:00',
            'date_to'=>'2024-03-10 12:00:00',
            'book_id'=> $book->id,
        ]);

        //act & assert
        $jsonResponse = $this->postJson('/api/reservations', [
            'requester' => 'biblio x',
            'date_from' => '2024-03-08 12:00:00',
            'date_to' => '2024-03-20 12:00:00',
            'book_id' => $book->id,
        ])
        ->assertStatus(422)
        ->assertJsonPath('errors', [
            'date_to' => ['The reservation period overlaps with a previous one.'],
        ]);
    });

});