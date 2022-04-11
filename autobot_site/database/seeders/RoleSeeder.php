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
            if(!Role::query()->where('id_role', $i)->exists())
            {
                Role::make($i, $roles[$i])->save();
            }
            else
            {
                Role::query()->where('id_role', $i)->update([
                    'name_role' => $roles[$i]
                ]);
            }
        }
    }
}
