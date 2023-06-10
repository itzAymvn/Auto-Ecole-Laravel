<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        try {
            // Check if the database connection is available
            DB::connection()->getPdo();

            // Check if the permissions table exists
            if (Schema::hasTable('permissions')) {
                // Retrieve the permissions from the database
                $permissions = DB::table('permissions')->where('status', 1)->get();
                $transformedPermissions = [];

                // Transform the permissions data
                foreach ($permissions as $permission) {
                    $permissionName = $permission->permission . '-' . $permission->resource;

                    if (!isset($transformedPermissions[$permissionName])) {
                        $transformedPermissions[$permissionName] = [
                            'name' => $permissionName,
                            'roles' => [],
                        ];
                    }

                    $transformedPermissions[$permissionName]['roles'][] = $permission->role;
                }

                $transformedPermissions = array_values($transformedPermissions);

                // Define gates for each permission
                foreach ($transformedPermissions as $permission) {
                    Gate::define($permission['name'], function ($user) use ($permission) {
                        return in_array($user->type, $permission['roles']);
                    });
                }
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur
        }
    }
}
