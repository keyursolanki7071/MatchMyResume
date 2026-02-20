<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ResumeController::class, 'index'])->name('dashboard');
    Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
});
