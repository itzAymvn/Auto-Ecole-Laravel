<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('title')->nullable();
            $table->text('value')->nullable();
            $table->text('default_value')->nullable();
            $table->timestamps();
        });
        */

        Setting::create([
            'name' => 'site_name',
            'title' => 'Site Name',
            'value' => '',
            'default_value' => 'Auto-Ecole',
        ]);

        Setting::create([
            'name' => 'phone_number',
            'title' => 'Phone Number',
            'value' => '',
            'default_value' => '06 00 00 00 00',
        ]);
    }
}
