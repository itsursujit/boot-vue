<?php

namespace Modules\Site\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DomainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        if (DB::table('domains')->where('domain', '=', 'boot-vue.test')->first() === null) {
            $adminRole = DB::table('domains')->insert([
                'name'        => 'boot-vue',
                'ext'        => 'test',
                'domain' => 'boot-vue.test',
            ]);
        }
    }
}
