<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ('local' !== env('APP_ENV')) {
            return;
        }

        Post::factory()
            ->count(100)
            ->create();
    }
}
