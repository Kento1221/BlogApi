<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(AuthLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            $user = Auth::user();
            $token = $user->createToken('blog_api')->plainTextToken;

            return response(['user' => $user, 'token' => $token]);
        }
    }

    public function register(AuthRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'name' => $validated['name'],
            'surname' => $validated['surname']
        ]);
        $token = $user->createToken('blog_api')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }

    public function logoutAllDevices()
    {
        return auth()->user()->tokens()->delete();
    }

    //TODO: validation emails
    public function sendValidationEmail()
    {

    }

    //TODO: sending emails and resetting passwords
    public function remindPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ]);
        return ['message' => $request['email']];
    }
}
