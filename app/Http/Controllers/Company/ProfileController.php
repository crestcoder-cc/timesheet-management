<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\ChangeProfileRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('company.profile.index');
    }

    public function updateProfile(ChangeProfileRequest $request): JsonResponse
    {
        $id = $request->input('edit_value');
        $user = Company::find($id);
        $user->name = $request->name;
        $user->person_name = $request->person_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Profile Update Successfully'
        ]);
    }
}
