<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        // We first get all the permissions defined in the database
        $permissions = DB::table('permissions')->where('status', 1)->get();
        $transformedPermissions = [];

        // We loop through the permissions
        foreach ($permissions as $permission) {

            // We set the name of the permission as the key of the array (e.g. view-users)
            $permissionName = $permission->permission . '-' . $permission->resource;

            // We check if the permission is not already defined
            if (!isset($transformedPermissions[$permissionName])) {

                // If not, we add it to the array with its name and an empty array of roles
                $transformedPermissions[$permissionName] = [
                    'name' => $permissionName,
                    'roles' => [],
                ];
            }

            // We push the role to the roles array of the permission
            $transformedPermissions[$permissionName]['roles'][] = $permission->role;
        }

        // We re-index the array
        $transformedPermissions = array_values($transformedPermissions);

        // Define gates for each permission
        foreach ($transformedPermissions as $permission) {
            Gate::define($permission['name'], function ($user) use ($permission) {
                return in_array($user->type, $permission['roles']);
            });
        }
    }
}
