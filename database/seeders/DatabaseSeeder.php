<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Book::factory(50)->create()->each(function ($book) {
            $numReviews = random_int(5, 15);

            Review::factory($numReviews)
                ->for($book)
                ->create();
        });
    }
}
