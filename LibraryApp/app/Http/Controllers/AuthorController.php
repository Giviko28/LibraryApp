<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('dashboard.authors', [
            'authors' => Author::latest()->get()
        ]);
    }
    public function show(Author $author)
    {
        return view('dashboard.author-show', [
           'author' => $author,
           'books' => $author->books
        ]);
    }
    public function create(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        Author::create([
            'name' => $data['name']
        ]);

        return back()->with('message', 'Book added succesfully');
    }
}
