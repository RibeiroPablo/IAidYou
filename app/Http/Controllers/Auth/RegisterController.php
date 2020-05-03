<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    protected function register(RegisterRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = new User;
            $user->store($request);

            DB::commit();

            return response()->json(['message' => 'User successfully registered.', 'user' => $user]);
        } catch (\Exception $e) {
            DB::rollBack();

            report($e);

            return response()->json(['message' => 'Unable to register user.', 'error' => $e->getMessage()], 500);
        }
    }
}
