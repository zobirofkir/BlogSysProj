<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user && Hash::check($request->password , $user->password))
        {
            abort(401);
        }
        $token = $user->createToken('Personnel access token')->accessToken;
        return AuthResource::make(["token" => $token]);
    }

    

    public function logout(Request $request)
    {
        return $request->user()->token()->revoke();
    }
}
