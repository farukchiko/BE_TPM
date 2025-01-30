<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

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

            // Simpan contact
            $contact = Contact::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'subject' => $validated['subject'],
                'message' => $validated['message']
            ]);

            Log::info('Contact created:', $contact->toArray());

            return response()->json([
                'message' => 'Message sent successfully',
                'contact_id' => $contact->id
            ], 201);

        } catch (\Exception $e) {
            Log::error('Error during sending message:', [
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
