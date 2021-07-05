<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;


class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('haveaccess','role.index');

        return Role::with('permissions')->get();
    }

    public function show(Role $role)
    {
        Gate::authorize('haveaccess','role.show');

        return response()->json([
            'data' => [
                'role' => $role->with('permissions')->where('id',$role->id)->first()
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        Gate::authorize('haveaccess','role.create');

        $data = $request->validate([
            'name'    => 'required|string',
            'full-access' => 'required'
        ]);

        $role = Role::create([
            'name'    => $data['name'],
            'full-access' => $data['full-access']
        ]);

        $role->permissions()->sync($request->permissions);

        return response()->json([
            'data' => [
                'message' => '¡Registered role successfully!',
                'role' => $role->with('permissions')->where('id',$role->id)->first()
            ]
        ], 200);
    }



    public function update(Request $request, Role $role)
    {
        Gate::authorize('haveaccess','role.edit');

        $data = $request->validate([
            'name'    => 'required|string|'
        ]);

        $role->update([
            'name'    => $data['name']
        ]);

        return response()->json([
            'data' => [
                'message' => '¡Role updated successfully!'
            ]
        ], 200);

    }

    public function destroy(Role $role)
    {
        Gate::authorize('haveaccess','role.destroy');

        if ($role->users()->count() <= 0) {
            $role->delete();

            return response()->json([
                'data' => [
                    'message' => 'Role deleted successfully!'
                ]
            ], 200);
        }else{
            return response()->json([
                'data' => [
                    'message' => '¡This role is in use!'
                ]
            ], 403);
        }
    }
}
