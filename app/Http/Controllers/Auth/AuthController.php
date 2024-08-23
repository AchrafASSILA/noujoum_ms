<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Config\Config;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validation->messages()->all()) {
            return response(['msg' => $validation->messages()->all()], 403);
        }
        // check email
        $user = User::where('email', $request->email)->first();
        // check password
        if ($user && !$user->active) {
            return response(['msg' => ['Compte n\'est pas active']], 401);
        }
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['msg' => ['Mot de passe incorrect']], 401);
        }
        $config = Config::first();
        $token =  $user->createToken('token')->plainTextToken;
        $user = [
            'name' => strtoupper($user->name),
            'role' => $user->roles->Alias,
            'image' => $user->getImage()
        ];
        return response([
            'logo' => $config->getLogo(),
            'app_name' => $config->Title,
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();
        return response(['msg' => 'logout success'], 200);
    }
}
