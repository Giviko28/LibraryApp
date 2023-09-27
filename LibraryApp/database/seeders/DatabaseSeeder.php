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
        Author::factory(10)->create();
        Book::factory(10)->create();
        // I know, I could've made this a lot better
        for($i = 1; $i<=10; $i++) {
            DB::table('book_author')->insert([
                ['book_id' => $i, 'author_id' => $i],
            ]);
        }
    }
}
