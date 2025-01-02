<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
    
        try {
            $name = $validated['name'];
            $email = $validated['email'];
            $message = $validated['message'];

            Mail::send(new ContactFormMail($name, $email, $message));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error sending your message. Please try again later.');
        }
    
        return redirect()->back()->with('success', 'Message sent successfully.');
    }    
}