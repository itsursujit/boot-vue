<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        /*
         * Add Roles
         *
         */
        if (DB::table('roles')->where('slug', '=', 'owner')->first() === null) {
            $adminRole = DB::table('roles')->insert([
                'name'        => 'Owner',
                'slug'        => 'owner',
                'description' => 'Owner',
                'level'       => 5,
            ]);
        }

        if (DB::table('roles')->where('slug', '=', 'site_owner')->first() === null) {
            $adminRole = DB::table('roles')->insert([
                'name'        => 'Site Owner',
                'slug'        => 'site_owner',
                'description' => 'Site Owner',
                'level'       => 4,
            ]);
        }
        /*
         * Add Roles
         *
         */
        if (DB::table('roles')->where('slug', '=', 'site_admin')->first() === null) {
            $adminRole = DB::table('roles')->insert([
                'name'        => 'Site Admin',
                'slug'        => 'site_admin',
                'description' => 'Site Admin Role',
                'level'       => 3,
            ]);
        }
        if (DB::table('roles')->where('slug', '=', 'user')->first() === null) {
            $userRole = DB::table('roles')->insert([
                'name'        => 'User',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ]);
        }
        if (DB::table('roles')->where('slug', '=', 'unverified')->first() === null) {
            $userRole = DB::table('roles')->insert([
                'name'        => 'Unverified',
                'slug'        => 'unverified',
                'description' => 'Unverified Role',
                'level'       => 0,
            ]);
        }
        // $this->call("OthersTableSeeder");
    }
}
