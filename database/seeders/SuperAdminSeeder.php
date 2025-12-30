<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role ada
        $superAdminRole = Role::firstOrCreate([
            'name' => 'Super Admin'
        ]);

        // Ambil semua permission
        $permissions = Permission::pluck('id')->all();
        $superAdminRole->syncPermissions($permissions);

        // Buat user Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('superadmin123'),
            ]
        );

        // Assign role
        if (! $superAdmin->hasRole($superAdminRole)) {
            $superAdmin->assignRole($superAdminRole);
        }
    }
}
