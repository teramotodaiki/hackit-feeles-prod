<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'userid' => 'admin',
            'email' => 'admin@feeles.com',
            'password' => bcrypt('secret'),
            'is_admin' => true,
        ]);
    }
}
