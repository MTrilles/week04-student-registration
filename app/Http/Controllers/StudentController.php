<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() 
    {
        $students = Student::latest()->get();
        return view('pages.saved', compact('students'));
    }

    public function create() 
    {
        return view('pages.registration');
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'mobile_number' => 'required|numeric',
            'gender' => 'required|string',
            'date_of_birth' => 'required|date',
            'program' => 'required|string',
            'year_level' => 'required|string',
            'address' => 'required|string',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $validated['profile_picture'] = $path;
        }

        $student = Student::create($validated);

        return redirect()->route('students.show', $student->id)
                         ->with('success', 'Student registered successfully!');
    }

    public function show(Student $student) 
    {
        return view('pages.show', compact('student'));
    }
}