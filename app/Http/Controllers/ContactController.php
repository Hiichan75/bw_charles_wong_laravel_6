<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact.form'); // Display the contact form
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Create a new contact form entry
        $contact = new ContactForm($request->all());
        $contact->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function userMessages()
    {
        $user = Auth::user();
        $messages = ContactForm::where('email', $user->email)->get(); // Assuming contact messages are linked by email
        return view('contact.user_messages', compact('messages'));
    }
}
