<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function switchRole(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $verificationCode = env('ADMIN_VERIFICATION_CODE', '123456');

        /** @var User $user */
        $user = Auth::user(); // IDE now knows $user is a User model

        if ($request->code === $verificationCode) {
            // Toggle role
            $user->role = $user->role === 'user' ? 'admin' : 'user';
            $user->save();

            return back()->with('success', 'Your role has been switched to ' . $user->role . '!');
        }

        return back()->with('error', 'Invalid verification code.');
    }
}
