<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->where('email', '=', 'itsursujit@gmail.com')->first() === null)
        {
            DB::table('users')->insert([
                'name'     => 'Sujit Baniya',
                'email'    => 'itsursujit@gmail.com',
                'password' => bcrypt('test12345'),
            ]);
        }
        // $this->call("OthersTableSeeder");
    }
}
