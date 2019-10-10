<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->where('email', 'admin@example.com')->count() == 0) {
            DB::table('users')->insert([
                'name'     => 'Demo Admin',
                'email'    => 'admin@example.com',
                'password' => bcrypt('admin'),
            ]);
        }

        factory(User::class, 131)->create();
    }
}
