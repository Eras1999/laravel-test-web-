<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; // Import the base Controller class
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('admin.Home.contact', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function updateStatus($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = $contact->status === 'Pending' ? 'Checked' : 'Pending';
        $contact->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Message deleted successfully!');
    }
}