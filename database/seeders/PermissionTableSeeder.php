<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'freelancer.viewAny',
            'freelancer.view',
            'freelancer.create',
            'freelancer.edit',
            'freelancer.delete',
            'freelancer.approve',
            'freelancer.approveAndReject',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'admin'
            ]);
        }
        Admin::find(1)->givePermissionTo($permissions);
        $adminRole = Role::firstOrCreate([
            'name' => 'super-admin',
            'guard_name' => 'admin'
        ]);
        Admin::find(1)->assignRole($adminRole);
    }
}
