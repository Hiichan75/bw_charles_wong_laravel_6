<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactController extends Controller
{
    public function show()
{
    return view('contact.form');
}

public function store(Request $request)
{
    $contact = new ContactForm($request->all());
    $contact->save();

    // Send email to admin
    // Note: Email sending logic would be added here. For example, you can use Laravel's Mail facade.
    return redirect()->back()->with('success', 'Message sent successfully!');
}

}
