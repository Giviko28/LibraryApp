<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        return view('dashboard-books', [
            'books' => Book::all(),
            'authors' => Author::all()
        ]);
    }
    public function create(CreateBookRequest $request)
    {
        $data = $request->validated();

        $book = Book::create([
            'title' => $data['title'],
            'release_date' => $data['release_date'],
            'status' => $data['status']
        ]);

        foreach($data['authors'] as $author) {
            DB::table('book_author')->insert([
               ['book_id' => $book->id, 'author_id' => $author]
            ]);
        }

        return back()->with('message', 'Book added successfully');
    }
}
