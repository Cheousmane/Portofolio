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

        Log::info('Contact form submission', [
            'mailer' => config('mail.default'),
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'username' => config('mail.mailers.smtp.username'),
            'has_password' => !empty(config('mail.mailers.smtp.password')),
            'to' => config('mail.contact_to'),
        ]);

        try {
            Mail::to(config('mail.contact_to', 'sidibeousmanemohamed@gmail.com'))
                ->send(new ContactMessage($data));

            Log::info('Contact mail sent successfully');
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return back()->with('success', 'Message envoyé ! Je vous réponds sous 24h.');
    }
}
