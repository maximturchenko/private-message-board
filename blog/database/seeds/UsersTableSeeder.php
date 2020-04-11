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
        DB::table('users')->insert([
            'name' => 'Eugene',
            'email' =>  Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
            ]);
        DB::table('users')->insert([
            'name' => 'Mikle',
            'email' =>  Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),  
        ]);
        DB::table('users')->insert([
            'name' => 'Tony',
            'email' =>  Str::random(10).'@gmail.com',
            'password' => Hash::make('password'), 
            ]);
        DB::table('users')->insert([
            'name' => 'Andre',
            'email' =>  Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
