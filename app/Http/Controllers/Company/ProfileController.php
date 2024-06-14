<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\ChangeProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function index()
    {
        return view('company.profile.index');
    }

    public function updateProfile(ChangeProfileRequest $request): JsonResponse
    {
        $id = $request->input('edit_value');
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message' => trans('messages.profile_updated_successfully')
        ]);
    }
}
