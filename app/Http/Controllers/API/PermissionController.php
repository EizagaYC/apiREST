<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;


class PermissionController extends Controller
{
    public function index()
    {
        Gate::authorize('haveaccess','permission.index');

        return Permission::all();
    }

    public function show(Permission $permission)
    {
        Gate::authorize('haveaccess','permission.show');

        return response()->json([
            'data' => [
                'permission' => $permission
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        Gate::authorize('haveaccess','permission.create');

        $data = $request->validate([
            'name'    => 'required|string|unique:permissions,name',
            'slug'    => 'required|string|unique:permissions,slug,'.$permission->id,
        ]);

        $permission = Permission::create([
            'name'    => $data['name'],
            'slug'    => $data['slug']
        ]);

        return response()->json([
            'data' => [
                'message' => '¡Registered permission successfully!',
                'permission' => $permission
            ]
        ], 200);
    }



    public function update(Request $request, Permission $permission)
    {
        Gate::authorize('haveaccess','permission.edit');

        $data = $request->validate([
            'name'    => 'required|string|unique:permissions,name,'.$permission->id,
            'slug'    => 'required|string|unique:permissions,slug,'.$permission->id,
        ]);

        $permission->update([
            'name'    => $data['name'],
            'slug'    => $data['slug']
        ]);

        return response()->json([
            'data' => [
                'message' => '¡Permission updated successfully!'
            ]
        ], 200);

    }

    public function destroy(Permission $permission)
    {
        Gate::authorize('haveaccess','permission.destroy');

        if ($permission->roles()->count() <= 0) {
            $permission->delete();

            return response()->json([
                'data' => [
                    'message' => 'Permission deleted successfully!'
                ]
            ], 200);
        }
    }

}
