<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = '/JSON_seeds/';
        $files = [
            'users.json',
            'routes.json',
            'services.json',
            'calendars.json',
            'routes_data.json',
            'user_plans.json',
            'reservations.json',
            'calendar_days_disableds.json',
        ];

        foreach ($files as $file) {
            $tableName = explode('.', $file)[0];
            $json = File::get(database_path($path . $file));

            $data = json_decode($json, true);
            foreach ($data[$tableName] as $routeData) {
                DB::table($tableName)->insert($routeData);
            }
        }
    }
}
