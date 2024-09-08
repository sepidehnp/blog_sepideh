<?php

namespace Database\Seeders;

use Spd\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public static array $seeders = [];

    public function run()
    {
        foreach (self::$seeders as $seeder) {
            $this->call($seeder);
        }

     // User::factory(10)->create();
    }
}
