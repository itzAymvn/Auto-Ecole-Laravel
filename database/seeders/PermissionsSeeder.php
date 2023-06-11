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
            'admin' => [
                'users' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'vehicles' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'exams' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'payments' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'spendings' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'sessions' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'statistics' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'settings' => [
                    'view' => 1,
                    'edit' => 1,
                ],
            ],
            // Instructor permissions
            'instructor' => [
                'users' => [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                ],
                'vehicles' => [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                ],
                'exams' => [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                ],
                'payments' => [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                ],
                'spendings' => [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                ],
                'sessions' => [
                    'view' => 1,
                    'create' => 1,
                    'edit' => 1,
                    'delete' => 1,
                ],
                'statistics' => [
                    'view' => 0,
                    'create' => 0,
                    'edit' => 0,
                    'delete' => 0,
                ],
                'settings' => [
                    'view' => 0,
                    'edit' => 0,
                ],
            ],
        ];

        $groupedPermissions = [];

        // Group permissions by role and resource
        foreach ($permissions as $role => $resources) {
            foreach ($resources as $resource => $permissionData) {
                foreach ($permissionData as $permission => $status) {
                    $groupedPermissions[] = [
                        'role' => $role,
                        'resource' => $resource,
                        'permission' => $permission,
                        'status' => $status,
                    ];
                }
            }
        }

        DB::table('permissions')->insert($groupedPermissions);
    }
}
