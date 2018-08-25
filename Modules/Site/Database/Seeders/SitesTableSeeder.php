<?php

namespace Modules\Site\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (DB::table('sites')->where('slug', '=', 'main')->first() === null) {
            $adminRole = DB::table('sites')->insert([
                'name'        => 'Manage',
                'slug'        => 'main',
                'domain_id' => DB::table('domains')->first()->id,
            ]);
        }
    }
}
