<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = ContactForm::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function show($id)
    {
        $contact = ContactForm::findOrFail($id);
        return view('admin.contact.show', compact('contact'));
    }

    public function reply(Request $request, $id)
    {
        $contact = ContactForm::findOrFail($id);
        // Here you can add the logic to send a reply via email
        return redirect()->route('admin.contact.index')->with('success', 'Reply sent successfully!');
    }
}
