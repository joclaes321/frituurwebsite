<?php
namespace App\Http\Controllers;

use Mail;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request)
    {
        $to_email = env('TO_EMAIL', null);

        // Send email
        $subject = $request->get('subject');
        Mail::send('emails.contact', [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message'),
                'subject' => $request->get('subject')
            ], function($message) use ($subject, $to_email)
            {
                $message->to($to_email, 'Admin')->subject($subject);
            });

        return redirect()->route('contact')->with('message', 'Thanks for your request!');
    }
}
