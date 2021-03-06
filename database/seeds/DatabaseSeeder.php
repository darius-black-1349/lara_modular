<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public static $seeders = [];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (static::$seeders as $seeder) {
            $this->call($seeder);
        }

    }
}
