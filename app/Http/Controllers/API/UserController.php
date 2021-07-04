<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public function store(SaveUserRequest $request)
    {
        User::create($request->all());

        return response()->json([
            'res' => true,
            'msg' => 'Usuario registrado con éxito'
        ], 200);
    }

    public function show(User $user)
    {
        return response()->json([
            'res' => true,
            'user' => $user
        ], 200);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());

        return response()->json([
            'res' => true,
            'msg' => 'Usuario actualizado con éxito'
        ], 200);

    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'res' => true,
            'msg' => 'Usuario eliminado con éxito'
        ], 200);
    }
}
