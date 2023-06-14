<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            VehiclesSeeder::class,
            ExamsSeeder::class,
            PermissionsSeeder::class,
            SessionsSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
