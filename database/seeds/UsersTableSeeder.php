<?php

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
        App\User::create([
        	'name' 		=> 'Alvin M. Espejo',
        	'email' 	=> 'admin@udemy.com', 
        	'password' 	=> bcrypt(123456),
        	'avatar' 	=> asset('avatar/default_avatar.png'), 
        	'admin' 	=> 1
        ]);

        App\User::create([
            'name'      => 'Mayjoy M. Espejo',
            'email'     => 'mayjoy@udemy.com', 
            'password'  => bcrypt(123456),
            'avatar'    => asset('avatar/default_avatar.png')
        ]);
    }
}
