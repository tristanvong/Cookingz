<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\ContactForm;

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
            $contactForm = ContactForm::create($validated);

            $name = $validated['name'];
            $email = $validated['email'];
            $message = $validated['message'];

            Mail::send(new ContactFormMail($name, $email, $message));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error sending your message. Please try again later.');
        }
    
        return redirect()->back()->with('success', 'Message sent successfully.');
    }   
    
    public function listContactForms()
    {
        $contactForms = ContactForm::orderBy('created_at', 'desc')->get();
        return view('admin.contact_forms.index', compact('contactForms'));
    }
    public function showContactForm($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        return view('admin.contact_forms.show', compact('contactForm'));
    }

    public function replyToContactForm(Request $request, $id)
    {
        $validated = $request->validate([
            'reply' => 'required|string',
        ]);

        $contactForm = ContactForm::findOrFail($id);
        $replyMessage = $validated['reply'];
        $adminEmail = auth()->user()->email;

        try {
            Mail::to($contactForm->email)->send(new ContactFormReply($contactForm->name, $contactForm->email, $replyMessage, $adminEmail));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error sending the reply. Please try again later.');
        }
        $contactForm->reply = $replyMessage;
        $contactForm->status = 'replied';
        $contactForm->save();

        return redirect()->route('admin.contactForms.index')->with('success', 'Reply sent successfully.');
    }

    public function destroy($id)
    {
        $contactForm = ContactForm::findOrFail($id);
        $contactForm->delete();

        return redirect()->route('admin.contactForms.index')
            ->with('success', 'Contact form deleted successfully.');
    }

}