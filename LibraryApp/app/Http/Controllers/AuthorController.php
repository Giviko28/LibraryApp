<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        return view('dashboard-authors', [
            'authors' => Author::all()
        ]);
    }
}
