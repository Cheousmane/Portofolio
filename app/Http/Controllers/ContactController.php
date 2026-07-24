<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request): RedirectResponse
    {
        $data = $request->validated();

        try {
            Mail::to(config('mail.contact_to', 'sidibeousmanemohamed@gmail.com'))
                ->send(new ContactMessage($data));
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
        }

        return back()->with('success', 'Message envoyé ! Je vous réponds sous 24h.');
    }
}
