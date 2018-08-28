<?php

namespace Modules\Address\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddressDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //DB::unprepared(file_get_contents(module_path('Address') . '/Database/Seeders/oc_events_countries.sql'));
        //DB::unprepared(file_get_contents(module_path('Address') . '/Database/Seeders/oc_events_regions.sql'));
        //DB::unprepared(file_get_contents(module_path('Address') . '/Database/Seeders/oc_events_cities.sql'));
        // $this->call("OthersTableSeeder");
    }
}
