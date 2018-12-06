<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\State;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name' => State::$STATE_ACTIVE,
        ]);
        DB::table('states')->insert([
            'name' => State::$STATE_UNSUBSCRIBED,
        ]);
        DB::table('states')->insert([
            'name' => State::$STATE_JUNK,
        ]);
        DB::table('states')->insert([
            'name' => State::$STATE_BOUNCED,
        ]);
        DB::table('states')->insert([
            'name' => State::$STATE_UNCONFIRMED,
        ]);
    }
}
