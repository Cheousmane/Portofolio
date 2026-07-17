<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Mail::to(config('mail.contact_to', 'sidibeousmanemohamed@gmail.com'))
            ->send(new ContactMessage($data));

        return back()->with('success', 'Message envoyé ! Je vous réponds sous 24h.');
    }
}
