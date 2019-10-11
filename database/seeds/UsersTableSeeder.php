<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        if ((new User)->where('email', 'jaime@jaimemazo.com')->doesntExist()) {
            $user = User::create([
                'name' => 'Administrador',
                'email' => 'jaime@jaimemazo.com',
                'password' => 'Geachile2019',

            ]);
        }

    }
}
