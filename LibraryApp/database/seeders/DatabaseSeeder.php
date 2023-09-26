<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin1',
            'email' => 'admin@example.com',
            'password' => Hash::make("Admin1"),
            'is_admin' => 1,
        ]);
        Book::factory(10)->create();
        Author::factory(10)->create();
        DB::table('book_author')->insert([
            ['book_id' => 1, 'author_id' => 1],
            ['book_id' => 1, 'author_id' => 3],
            ['book_id' => 1, 'author_id' => 4],
            ['book_id' => 1, 'author_id' => 2],
            ['book_id' => 2, 'author_id' => 1]
        ]);
    }
}
