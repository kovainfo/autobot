<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::getBaseArray();
        for($i = 0; $i < count($roles); $i++)
        {
            if(!Role::query()->where('id_role', $i+1)->exists())
            {
                Role::factory([
                    'id_role' => $i+1,
                    'name_role' => $roles[$i]
                ])->create();
            }
            elseif(!Role::query()->where('name_role', $roles[$i])->where('id_role', $i+1)->exists())
            {
                Role::query()->where('id_role', $i+1)->update([
                    'name_role' => $roles[$i]
                ]);
            }
        }
    }
}
