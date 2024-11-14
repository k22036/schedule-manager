<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('home'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::post('/home', [HomeController::class, 'render_content'])->name('render_content');

    Route::get('/edit', [HomeController::class, 'edit'])->name('edit');
    Route::post('/edit', [ScheduleController::class, 'editContent'])->name('edit-content');

    Route::get('/delete', function () {
        return redirect(route('error'));
    });
    Route::post('/delete', [ScheduleController::class, 'deleteContent'])->name('delete-content');

    Route::get('/add-content', function () {
        return view('pages.create_task');
    });
    Route::post('/add-content', [ScheduleController::class, 'addContent'])->name('add-content');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/error', function () {
    return view('pages.error');
})->name('error');

require __DIR__ . '/auth.php';
