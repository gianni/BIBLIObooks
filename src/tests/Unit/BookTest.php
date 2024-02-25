<?php

use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

uses(TestCase::class, DatabaseTransactions::class);

it('creates and soft deletes a book', function () {

    // prepare
    $book = Book::create([
        'title' => 'Test Book',
        'author' => 'Test Author',
        'published_at' => now(),
        'isbn' => '123456789',
    ]);

    // act
    $book->delete();

    // assert
    $this->assertSoftDeleted(Book::class, ['id' => $book->id]);
});
