<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => Type::$TYPE_DATE,
        ]);
        DB::table('types')->insert([
            'name' => Type::$TYPE_NUMBER,
        ]);
        DB::table('types')->insert([
            'name' => Type::$TYPE_BOOLEAN,
        ]);
        DB::table('types')->insert([
            'name' => Type::$TYPE_STRING,
        ]);
    }
}
