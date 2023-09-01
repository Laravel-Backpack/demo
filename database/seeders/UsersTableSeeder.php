<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        // Create admin
        User::create([
            'name'              => 'Demo Admin',
            'email'             => 'admin@example.com',
            'password'          => bcrypt('admin'),
            'email_verified_at' => now(),
        ]);

        User::factory()->count(131)->create();
    }
}
