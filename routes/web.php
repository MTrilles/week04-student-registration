<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

// Form
Route::get('/', [StudentController::class, 'create'])->name('registration');

// Standard Controller Routes
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/saved', [StudentController::class, 'index'])->name('saved.registration');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');