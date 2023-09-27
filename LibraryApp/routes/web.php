<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Models\Book;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome', ['books' => null]);


Route::group(['middleware' => 'admin', 'prefix' => '/dashboard'], function() {
    Route::get('/books', [BookController::class, 'index'])->name('dashboard');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::post('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');


    Route::get('/authors', [AuthorController::class, 'index'])->name('authors');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
    Route::post('/authors/create', [AuthorController::class, 'create'])->name('authors.create');

});


//Route::get('/dashboard', function () {
//    return view('dashboard', [
//        'books' => Book::all()
//    ]);
//})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
