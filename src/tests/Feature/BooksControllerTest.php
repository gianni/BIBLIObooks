<?php

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Books Controller', function () {

    test('user can list properly the books list', function () {

        Book::create([
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ]);

        $jsonResponse = $this->getJson('/api/books')
            ->assertStatus(200);

        expect($jsonResponse->json())->toHaveCount(1);
    });

    test('user can get book details', function () {

        $bookData = [
            'title' => 'book title',
            'author' => 'book author',
            'published_at' => '2020-01-01',
            'isbn' => '1234567890123',
        ];
        $book = Book::create($bookData);

        $jsonResponse = $this->getJson('/api/books/'.$book->id)
            ->assertStatus(200);

        expect($jsonResponse->json())->tobe(['id' => $book->id, ...$bookData]);
    });
});

test('an user can add a new book', function () {

    $this->postJson('/api/books', [
        'title' => 'book title 2',
        'author' => 'book author 2',
        'published_at' => '2020-02-02',
        'isbn' => '1234567890124',
    ])
        ->assertStatus(201)
        ->assertJsonPath('title', 'book title 2')
        ->assertJsonPath('isbn', '1234567890124');
});

test('an user can update a book correctly', function () {

    $book = Book::create([
        'title' => 'book title',
        'author' => 'book author',
        'published_at' => '2020-01-01',
        'isbn' => '1234567890123',
    ]);

    $this->putJson("/api/books/$book->id", [
        'title' => 'book title updated',
        'author' => 'book author',
        'published_at' => '2020-03-03',
        'isbn' => '1234567890123',
    ])
        ->assertStatus(200)
        ->assertJsonPath('title', 'book title updated');
});

test('an user can delete a book', function () {

    $book = Book::create([
        'title' => 'book title',
        'author' => 'book author',
        'published_at' => '2020-01-01',
        'isbn' => '1234567890123',
    ]);

    $this->deleteJson("/api/books/$book->id")
        ->assertStatus(200)
        ->assertJsonPath('message', 'Book deleted successfully');

});
