<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactMail; // Assuming you have a Mailable class for the email

class ContactController extends Controller
{
    public function contactPage(Request $request)
    {
        if ($request->isMethod('post')) {
            // Retrieve form data
            $name = $request->input('name');
            $email = $request->input('email');
            $message = $request->input('description');
            $subject = "Feedback";

            // Validate required fields
            if (empty($name) || empty($email) || empty($message)) {
                Session::flash('error', 'All Fields Are Mandatory');
                return redirect()->route('contactpage');
            }

            // Get username if authenticated
            $username = $request->input('username', 'user is not registered');

            // Prepare email data
            $emailData = [
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'message' => $message,
                'subject' => $subject,
            ];

            try {
                // Send email
                Mail::to(config('mail.from.address'))->send(new ContactMail($emailData));

                // Flash success message
                Session::flash('success', 'Your message has been sent successfully!');
                return redirect()->route('home');
            } catch (\Exception $e) {
                // Flash error message if email fails
                Session::flash('error', 'Failed to send mail, try again later');
                return redirect()->route('contactpage');
            }
        } else {
            // Render the contact form view for GET requests
            return view('contact.index');
        }
    }
}