<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ('local' !== env('APP_ENV')) {
            return;
        }

        User::factory()
            ->count(50)
            ->create();
    }
}
