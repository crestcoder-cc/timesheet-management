<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Company\AdminLoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginCheck(AdminLoginRequest $request): JsonResponse
    {
        if (Auth::guard('web')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            if (Auth::guard('web')->user()->status === 'active') {
                return response()->json([
                    'message' => 'Login Successfully',
                ]);
            }
            return response()->json([
                'message' => 'Account Deactivated',
            ], 422);
        }
        return response()->json([
            'message' => 'Invalid Credentials',
        ], 422);
    }

    public function login()
    {
        if (auth()->guard('web')->user()) {
            return redirect()->route('home');
        }
        return view('web.auth.login');
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
