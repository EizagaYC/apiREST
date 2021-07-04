<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|',
            'email'   => 'required|string||unique:users,email',
            'birtday' => 'required',
            'age'     => 'required',
            'sex'     => 'required|string|',
            'address' => 'required|string|',
            'country' => 'required|string|',
            'phone'   => 'required|string|max:11',
            'dni'     => 'required|string|max:8|unique:users,dni',
            'password'=> 'required|string|confirmed'
        ]);

        $user = User::create([
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

        $user->roles()->attach($request->roles);

        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'data' => [
                'message' => '¡Registered user successfully!',
                'token' => $token,
                'user' => $user->with('roles')->where('id',$user->id)->first()
            ]
        ], 200);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email'   => 'required|email',
            'password'=> 'required'
        ]);

        # Check email and password

        $user = User::with('roles')->where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'data' => [
                    'message' => '¡The provided credentials are incorrect!'
                ]
            ], 401);
        }

        $token = $user->createToken($user->email)->plainTextToken;

        return response()->json([
            'data' => [
                'message' => '¡Logged in!',
                'token' => $token,
                'user' => $user
            ]
        ], 200);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => '¡Logged out!'
        ], 200);
    }
}
