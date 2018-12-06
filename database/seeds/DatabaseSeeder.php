<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatesTableSeeder::class);
        $this->call(SubscribersTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(FieldTableSeeder::class);
    }
}
