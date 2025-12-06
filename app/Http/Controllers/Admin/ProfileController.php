<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    // public function profileUpdate(Request $request, User $user) 
    // {
    //     $user->name = $request->input("name");
    //     $user->email = $request->input("email");
    //     $user->phone = $request->input("phone");
    //     $user->save();
    //     alert("success", "Profile has been updated");
    //     return redirect(dashboard_route('admin.profile'));
    // }

    public function userUpdatePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();
        $oldPassword = $request->input('password');
        $newPassword = $request->input('password');

        $user->password = Hash::make($newPassword);
        $user->setRememberToken(Str::random(60));
        $user->save();

        try {
            Auth::logoutOtherDevices($oldPassword);
        } catch (\Exception $e) {
            Log::warning('logoutOtherDevices failed: ' . $e->getMessage());
        }

        Log::info('User password changed', ['user_id' => $user->id, 'ip' => $request->ip()]);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Password has been changed.']);
        }
        $this->alert("success", "Password has been updated.");
        return redirect(dashboard_route('admin.profile'));
    }
}
