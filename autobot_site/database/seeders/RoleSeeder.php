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
        foreach($roles as $role)
        {
            if(!Role::query()->where('name', $role)->exists())
            {
                Role::make($role)->save();
            }
        }
    }
}
