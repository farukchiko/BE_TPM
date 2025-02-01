<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'subject' => 'required|string|max:255',
                'message' => 'required|string'
            ]);

            // Simpan ke database
            $contact = Contact::create($validated);

            Log::info('Contact successfully saved', ['contact' => $contact]);

            // Kirim email ke admin menggunakan Mailtrap
            Mail::to(env('MAIL_FROM_ADDRESS', 'admin@example.com'))->send(new ContactMail($contact));

            Log::info('Email sent successfully to admin', ['email' => env('MAIL_FROM_ADDRESS')]);

            return response()->json([
                'message' => 'Message sent successfully',
                'contact_id' => $contact->id
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error sending message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'message' => 'Failed to send message', 
                'error' => $e->getMessage()
            ], 500);
        }
    }
}