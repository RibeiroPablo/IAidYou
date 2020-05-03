<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;

class LoginController extends Controller
{
    protected function login(LoginRequest $request)
    {
        try {
            $user = User::with('address')->byPhoneNumber($request->phone_number)->firstOrFail();
            return response()->json(['message' => 'User successfully logged in.', 'user' => $user]);
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'The user is not registered.'], 404);
        }
    }
}
