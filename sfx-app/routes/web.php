<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EstimatorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Primary Web Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/solutions', [ServiceController::class, 'index'])->name('services.index');
Route::get('/solutions/{slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

Route::get('/insights', [BlogController::class, 'index'])->name('blog.index');
Route::get('/insights/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/privacy-policy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms-conditions', function () {
    return view('pages.terms');
})->name('terms');

// Dynamic Interactive Endpoints (Estimator & Modal API)
Route::post('/api/estimator/submit', [EstimatorController::class, 'store'])->name('api.estimator.submit');
Route::get('/api/projects/{slug}', [ProjectController::class, 'apiDetails'])->name('api.projects.details');
