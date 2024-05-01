<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function message(Request $request)
    {
        $data = $request->all();

        $mail = new ContactMessageMail($data['flat_id'], $data['first_name'], $data['last_name'], $data['email_sender'], $data['text']);
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);

        // return $data; 
        return response(null, 204);
    }
}
