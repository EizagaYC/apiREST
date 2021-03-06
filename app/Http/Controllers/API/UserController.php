<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        Gate::authorize('haveaccess','user.index');

        return User::all();
    }

    public function show(User $user)
    {
        Gate::authorize('haveaccess','user.show');

        return response()->json([
            'data' => [
                'user' => $user->with('roles')->where('id',$user->id)->first()
            ]
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('haveaccess','user.edit');

        $data = $request->validate([
            'name'    => 'required|string|',
            'email'   => 'required|string|unique:users,email,'.$user->id,
            'birtday' => 'required',
            'age'     => 'required',
            'sex'     => 'required|string|',
            'address' => 'required|string|',
            'country' => 'required|string|',
            'phone'   => 'required|string|max:11',
            'dni'     => 'required|string|max:8|unique:users,dni,'.$user->id,
            'password'=> 'required|string|confirmed'
        ]);

        $user->update([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'age'     => $data['age'],
            'birtday' => $data['birtday'],
            'sex'     => $data['sex'],
            'address' => $data['address'],
            'country' => $data['country'],
            'phone'   => $data['phone'],
            'dni'     => $data['dni'],
            'password'=> Hash::make($data['password'])
        ]);

        $user->roles()->sync($request->roles);

        return response()->json([
            'data' => [
                'message' => '¡User updated successfully!'
            ]
        ], 200);

    }

    public function destroy(User $user)
    {
        Gate::authorize('haveaccess','user.destroy');

        $user->delete();

        return response()->json([
            'data' => [
                'message' => '¡User deleted successfully!'
            ]
        ], 200);
    }
}
