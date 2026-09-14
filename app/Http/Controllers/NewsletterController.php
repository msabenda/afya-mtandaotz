<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse|JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        NewsletterSubscriber::query()->updateOrCreate(
            ['email' => $data['email']],
            ['subscribed_at' => now()]
        );

        $message = 'You are subscribed. You will receive an email when we publish new articles.';

        if ($request->expectsJson()) {
            return response()->json(['message' => $message]);
        }

        return redirect('/#newsletter')->with('newsletter_status', $message);
    }
}
