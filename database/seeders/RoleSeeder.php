<?php

namespace Database\Seeders;

use App\Models\Role\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::create([
            'Label' => 'Pinia',
            'Alias' => 'pinia',
        ]);
        Role::create([
            'Label' => 'Founder',
            'Alias' => 'founder',
        ]);
        // Role::create([
        //     'Label' => 'Worker',
        //     'Alias' => 'worker',
        // ]);
    }
}
