<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'search' => ['string', 'max:255']
        ]);

        return view('dashboard.books', [
            'books' => Book::latest()->filter($data['search'] ?? null)->get(),
            'authors' => Author::all()
        ]);
    }
    public function create(CreateBookRequest $request)
    {
        $data = $request->validated();

        $book = Book::create([
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'status' => $data['status'] ?? 0
        ]);

        Book::savePivot($data['authors'], $book);

        return back()->with('message', 'Book added successfully');
    }
    public function destroy(Book $book)
    {
        $book->delete();

        return back()->with('message', 'Book deleted succesfully');
    }


    public function edit(Book $book)
    {
        return view('dashboard.books-edit', [
            'book' => $book,
            'authors' => Author::latest()->get()
        ]);
    }

    public function update(CreateBookRequest $request, Book $book)
    {
        $data = $request->validated();
        $book->update([
          'title' => $data['title'],
          'release_date' => $data['release_date'],
          'status' => $data['status'] ?? 0
        ]);

        Book::updatePivot($data['authors'], $book);

        return back()->with('message', 'Book edited successfully');
    }
}
