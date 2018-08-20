<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = \Nwidart\Modules\Facades\Module::all();
        foreach($modules as $module)
        {
            $name = $module->getName();
            $slug = $module->getLowerName();
            $description = $module->getDescription();
            if (DB::table('modules')->where('slug', '=', $slug)->first() === null) {
                $adminRole = DB::table('modules')->insert([
                    'name'        => $name,
                    'slug'        => $slug,
                    'description' => $description,
                ]);
            }

        }
    }
}
