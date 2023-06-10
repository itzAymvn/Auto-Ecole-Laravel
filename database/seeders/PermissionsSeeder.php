<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Admin permissions
            [
                'role' => 'admin',
                'resource' => 'users',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'users',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'users',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'users',
                'permission' => 'delete',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'vehicles',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'vehicles',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'vehicles',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'vehicles',
                'permission' => 'delete',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'exams',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'exams',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'exams',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'exams',
                'permission' => 'delete',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'payments',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'payments',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'payments',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'payments',
                'permission' => 'delete',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'spendings',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'spendings',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'spendings',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'spendings',
                'permission' => 'delete',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'sessions',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'sessions',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'sessions',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'sessions',
                'permission' => 'delete',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'statistics',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'statistics',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'statistics',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'admin',
                'resource' => 'statistics',
                'permission' => 'delete',
                'status' => 1,
            ],
            // Instructor permissions
            [
                'role' => 'instructor',
                'resource' => 'sessions',
                'permission' => 'view',
                'status' => 1,
            ],
            [
                'role' => 'instructor',
                'resource' => 'sessions',
                'permission' => 'create',
                'status' => 1,
            ],
            [
                'role' => 'instructor',
                'resource' => 'sessions',
                'permission' => 'edit',
                'status' => 1,
            ],
            [
                'role' => 'instructor',
                'resource' => 'sessions',
                'permission' => 'delete',
                'status' => 1,
            ],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
