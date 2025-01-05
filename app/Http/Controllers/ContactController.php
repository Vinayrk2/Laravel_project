<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function contactPage()
    {
        return view('contact.index');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'description' => 'required|string|min:10'
        ]);

        // Send email
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactFormMail($validated));

            // Redirect to the success page with data
    return redirect()->route('success')->with([
        'title' => 'Thank You for Reaching Out!',
        'message' => 'Your message has been successfully submitted. We will contact you soon!',
        'buttonText' => 'Return to Home',
        'redirectRoute' => 'index',
    ]);
    }
}