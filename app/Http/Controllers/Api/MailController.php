<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use App\Models\Flat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    // Funzione per inviare l'email come nel vecchio esercizio
    public function message(Request $request)
    {
        $data = $request->all();
        $flat = Flat::find($data['flat_id']);
        $ownerEmail = $flat->user->email;
        $mail = new ContactMessageMail($data['flat_id'], $data['first_name'], $data['last_name'], $data['email_sender'], $data['text']);
        Mail::to($ownerEmail)->send($mail);

        // return $data; 
        return response(null, 204);
    }

    public function store(Request $request)
    {
        // TODO: Validazione
        $data = $request->all();
        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();

        $flat = Flat::find($data['flat_id']);
        $ownerEmail = $flat->user->email;
        $mail = new ContactMessageMail($data['flat_id'], $data['first_name'], $data['last_name'], $data['email_sender'], $data['text']);
        Mail::to($ownerEmail)->send($mail);
        return response(null, 204);
    }
}
