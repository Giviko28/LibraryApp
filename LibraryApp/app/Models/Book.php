<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['authors'];


    public static function savePivot(array $authors, Book $book)
    {
        foreach($authors as $author) {
            DB::table('book_author')->insert([
                ['book_id' => $book->id, 'author_id' => $author]
            ]);
        }
    }

    public static function updatePivot(array $authors, Book $book)
    {
        DB::table('book_author')->where('book_id', $book->id)->delete();
        self::savePivot($authors, $book);
    }

    public function scopeFilter($query, $search)
    {
        $query->when($search, function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhereHas('authors', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        });
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

}
