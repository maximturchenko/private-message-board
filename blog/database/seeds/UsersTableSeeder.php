<?php

use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        DB::table('users')->delete();
        User::create(array(
            'name' => 'Eugene',
            'email' =>  Str::random(10).'@gmail.com',
            'email_verified_at' => Str::random(10),
            'password' => Hash::make('password'),
        ));
        User::create(array(
            'name' => 'Mikle',
            'email' =>  Str::random(10).'@gmail.com',
            'email_verified_at' => Str::random(10),
            'password' => Hash::make('password'),
        ));
        User::create(array(
            'name' => 'Tony',
            'email' =>  Str::random(10).'@gmail.com',
            'email_verified_at' => Str::random(10),
            'password' => Hash::make('password'),
        ));
        User::create(array(
            'name' => 'Andre',
            'email' =>  Str::random(10).'@gmail.com',
            'email_verified_at' => Str::random(10),
            'password' => Hash::make('password'),
        ));
    }
}
