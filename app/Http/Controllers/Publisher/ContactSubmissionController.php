<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\View\View;

class ContactSubmissionController extends Controller
{
    public function index(): View
    {
        return view('publisher.contact-submissions.index', [
            'submissions' => ContactSubmission::query()->latest()->paginate(20),
        ]);
    }
}

