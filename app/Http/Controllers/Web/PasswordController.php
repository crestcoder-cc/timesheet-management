<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordStoreRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function index()
    {
        return view('web.auth.change-password');
    }

    public function updatePassword(ChangePasswordStoreRequest $request): JsonResponse
    {
        $id = Auth::guard('web')->user()->id;
        $employee = Employee::find($id);
        $current_password = $request->current_password;
        $new_password = $request->new_password;
        if (!Hash::check($current_password, $employee->password)) {
            return response()->json(['message' => 'Current Password Is Not Valid'], 422);
        }
        Employee::where('id', $id)->update([
            'password' => bcrypt($new_password),
        ]);
        return response()->json(['message' => 'Password Update Successfully']);
    }

}
