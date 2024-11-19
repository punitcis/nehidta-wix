<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        // Store token in password_resets table
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send email with the reset link
        $resetLink = url('/password/reset/' . $token);

        Mail::send('auth.emails.password', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Your Password');
        });

        return back()->with('status', 'We have emailed your password reset link!');

        
    }

    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
        
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $passwordReset = DB::table('password_resets')->where([
            ['email', $request->email],
            ['token', $request->token],
        ])->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Invalid token!']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_resets')->where(['email' => $request->email])->delete();
    

        return redirect('/login')->with('status', 'Your password has been reset!');
    }
}
    
 
