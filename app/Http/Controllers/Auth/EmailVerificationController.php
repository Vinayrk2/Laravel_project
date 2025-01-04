<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice(Request $request)
    {
        // If user is already verified, redirect to home
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        $request->fulfill();
        return redirect('/')->with('status', 'Email verified!');
    }

    public function send(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/');
        }

        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
} 