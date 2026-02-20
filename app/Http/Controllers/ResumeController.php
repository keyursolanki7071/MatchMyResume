<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use App\Services\ResumeExtractorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ResumeController extends Controller
{
    public function index() {
        return Inertia::render('dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120'
        ]);

        $file = $request->file('resume');
        $path = $file->store('resumes');

        $rawText = app(ResumeExtractorService::class)
            ->extract(storage_path("app/private/{$path}"));

        $resume = Resume::create([
            'user_id' => Auth::id(),
            'file_path' => $path,
            'raw_text' => $rawText
        ]);

        return redirect()->back()->with('success', 'Resume uploaded successfully.');
    }
}
