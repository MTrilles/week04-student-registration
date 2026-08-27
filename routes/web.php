<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student; // Ensure you import your Student model if you have one

Route::get('/', function () {
    return view('pages.registration');
})->name('registration');

Route::get('/saved', function () {
    $students = []; 
    
    return view('pages.saved', compact('students'));
})->name('saved.registration');