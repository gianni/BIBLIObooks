<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BookRepositoryInterface;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
        return Book::all();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function find(int $id)
    {
        return Book::findOrFail($id);
    }

    public function delete(int $id)
    {
        $book = Book::find($id);
        $book->delete();
    }

    public function update(int $id, array $data)
    {
        $book = Book::findOrFail($id);
        $book->update($data);

        return $book;
    }
}