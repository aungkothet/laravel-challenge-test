<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            return response()->json([
                'user' => $user,
                'token' => $user->createToken('User-Token')->plainTextToken
            ]);
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Unauthorized.',
            ],Response::HTTP_UNAUTHORIZED);
        }
    }
}
