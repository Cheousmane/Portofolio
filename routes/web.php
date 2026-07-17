<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/debug', function () {
    $version = app()->version();
    $inertia = class_exists(\Inertia\Inertia::class) ? 'yes' : 'no';
    $ziggy = class_exists(\Tightenco\Ziggy\Ziggy::class) ? 'yes' : 'no';
    $providers = file_exists(base_path('bootstrap/providers.php')) ? 'yes' : 'no';
    $appService = class_exists(\App\Providers\AppServiceProvider::class) ? 'yes' : 'no';
    return "Laravel: $version | Inertia: $inertia | Ziggy: $ziggy | providers: $providers | AppService: $appService";
});

Route::get('/debug-view', function () {
    return view('debug');
});
