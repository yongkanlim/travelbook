<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // Handles POST (Create) requests & Receives user input through $request (form submit data)
    public function switchRole(Request $request)
    {
        // Validate request to ensures code field is Present, string (name = 'code' in form input)
        $request->validate([
            'code' => 'required|string',
        ]);

        // Reads the verification code from .env, Uses '123456' as a fallback default 
        // (set ADMIN_VERIFICATION_CODE=ADMIN2025 in .env file), else it auto use 123456 (Here i use default)
        $verificationCode = env('ADMIN_VERIFICATION_CODE', '123456');

        // IDE hint tells editors that $user is a User model
        // Retrieves the currently logged-in user
        /** @var User $user */
        $user = Auth::user(); // IDE now knows $user is a User model

        // strict comparison (===)
        if ($request->code === $verificationCode) {
            // =============================================================================================
            // Toggle role (Why use toggle)
            // =============================================================================================
            // Same form can both upgrade and downgrade roles
            // No need for separate “switch to admin” and “switch to user” logic
            // if role is 'user', switch to 'admin', if role is 'admin', switch to 'user'
            // Format: condition ? value_if_true : value_if_false;
            // save() = Save to Database, updated role value into the users table (only this user’s record)
            // =============================================================================================
            $user->role = $user->role === 'user' ? 'admin' : 'user';
            $user->save();

            // ===========================================================================================
            // Redirects user back to previous page
            // Stores success message in session (will use in layout.navigation.blade.php/guest.blade.php)
            // Message is displayed in the modal UI (in layout.navigation.blade.php/guest.blade.php)
            // ===========================================================================================
            return back()->with('success', 'Your role has been switched to ' . $user->role . '!');
        }

        return back()->with('error', 'Invalid verification code.');
    }
}
