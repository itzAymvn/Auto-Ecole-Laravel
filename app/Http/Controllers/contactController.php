<?php

namespace App\Http\Controllers;

use App\Mail\contactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
{
    public function send(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $mailData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'subject' => $validatedData['subject'],
            'message' => $validatedData['message'],
        ];

        if (Mail::to('aymanbdouzi@gmail.com')->send(new contactMail($mailData))) {
            // Insert into database (mails table)
            DB::table('mails')->insert([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('main', '#contact-section')->with('success', 'Votre message a été envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
        } else {
            return redirect()->route('main', '#contact-section')->with('error', 'Quelque chose s\'est mal passé! Veuillez réessayer.');
        }
    }
}
