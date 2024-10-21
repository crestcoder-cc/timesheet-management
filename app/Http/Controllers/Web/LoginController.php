<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordStoreRequest;
use App\Http\Requests\Company\AdminLoginRequest;
use App\Http\Requests\Web\ForgotPasswordStoreRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

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

    public function sendMail(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = Employee::where(['email' => $request->email])->first();
        if ($user) {
            $token = Password::getRepository()->create($user);
            $array = [
                'name' => $user->name,
                'actionUrl' => route('forgot-password', [$token]),
                'mail_title' => 'Please Click on the following link to reset your password.',
                'reset_password_subject' => 'Forgot Your Password',
                'main_title_text' => 'Forgot Your Password',
                'subject' => 'Password Reset',
            ];
            Mail::to($request->input('email'))->send(new ForgotPasswordMail($array));
            return response()->json([
                'message' => 'Please check your mail',
            ], 200);
        }
        return response()->json([
            'message' => 'Email not found',
        ], 400);
    }

    public function resetPassword($token)
    {
        $tokenData = DB::table('password_reset_tokens')->get();
        $email = null;
        foreach ($tokenData as $data) {
            if (Hash::check($token, $data->token)) {
                $email = $data->email;
                break;
            }
        }
        if (!empty($email)) {
            return view('web.forgot-password.forgot-password',
                ['token' => $token,
                    'email' => $email]);
        }
        abort(404);
    }

    public function resetPasswordSubmit(ForgotPasswordStoreRequest $request): JsonResponse
    {
        $password = $request->input('new_password');
        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->input('email'))->first();
        if ($tokenData) {
            $user = Employee::where('email', $tokenData->email)->first();
            if ($user) {
                $user->password = Hash::make($password);
                $user->update();
//                DB::table('notifications')->insert([
//                    'user_id' => $user->id,
//                    'first_name' => $user->name,
//                    'last_name' => $user->last_name,
//                    'email' => $user->email,
//                    'mobile_no' => $user->mobile_no,
//                    'created_at' => Carbon::now(),
//                    'type' => 'forgot_password_request',
//                    'message' => $user->email . ' ' . 'requested a password change',
//                ]);
                DB::table('password_reset_tokens')->where('email', $request['email'])->delete();
            } else {
                return response()->json(['message' => 'Email not found'], 422);
            }
            return response()->json(['message' => 'Password reset successfully']);
        }
        return response()->json(['message' => 'Email not found'], 422);
    }
}
