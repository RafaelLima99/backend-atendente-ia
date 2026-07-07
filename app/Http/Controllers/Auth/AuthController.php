<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(UserRequest $request)
    {

       if (! Auth::attempt($request->validated())) {

            return response()->json([
                "message" => "Credenciais inválidas."
            ], 401);
        }

        $user = Auth::user();

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }

    public function register(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        
        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => new UserResource($user),
        ], 201);

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout realizado com sucesso.'
        ]);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}
