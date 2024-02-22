<?php

namespace App\Http\Controllers;


use App\Http\Requests\DestroyTicketRequest;
use App\Http\Requests\ListTicketRequest;
use App\Http\Requests\ShowTicketRequest;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Interfaces\Repositories\TicketRepositoryInterface;

class BookController extends Controller
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function list()
    {
        return new BookCollection($this->bookRepository->all());
    }

    public function store(BookStoreRequest $request)
    {
        $bookModel = $this->bookRepository->create([
            'title' => $request->title,
            'author' => $request->author,
            'published_at' => $request->published_at,
            'isbn' => $request->isbn
        ]);

        return new BookResource($bookModel);
    }

    public function show(BookShowRequest $request, int $id)
    {
        $book = $this->bookRepository->find($id);
        abort_if(! $book, 404);

        // book details
        return new BookResource($book);
    }

    public function update(BookUpdateRequest $request, int $id)
    {
        abort_unless($this->bookRepository->find($id), 404, 'Book not found');

        $bookModel = $this->bookRepository->update(
            $id,
            $request->validated()
        );

        // Book update
        return new BookResource($bookModel);
    }

    public function delete(BookDestroyRequest $request, int $id)
    {

        $book = $this->bookRepository->find($id);
        abort_unless($book, 404, 'Book not found');

        $this->bookRepository->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully',
            'company' => new BookResource($book),
        ]);
    }
}