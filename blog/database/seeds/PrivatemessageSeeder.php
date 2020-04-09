<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivatemessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privatemessage')->delete();
    }
}
