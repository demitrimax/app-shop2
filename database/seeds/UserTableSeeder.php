<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Moises',
            'email' => 'armandoaguilar1@gmail.com',
            'password' => bcrypt('mexico11'),
            'admin' => true
        ],
        [
            'name' => 'Juan',
            'email' => 'armandoaguilar1@gmail.com',
            'password' => bcrypt('mexico11'),
            'admin' => true
        ]);
    }
}
