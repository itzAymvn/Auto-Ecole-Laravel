<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // group by role and for each role group by resource
        $permissions = Permission::all()->groupBy('role')->map(function ($role) {
            return $role->groupBy('resource');
        });

        return view('settings.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $status = $request->input('status');

        $permission->status = $status;
        $permission_name = $permission->permission . '-' . $permission->resource;
        $permission_status = $status ? 'activée' : 'désactivée';
        if ($permission->save()) {
            $message = "La permission $permission_name a été $permission_status pour le rôle $permission->role";
        } else {
            $message = "Une erreur s'est produite lors de la mise à jour de la permission $permission_name pour le rôle $permission->role";
        }

        return response()->json([
            'message' => $message,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
