@extends('components.layout')

@section('content')
<div class="page-intro">
    <h1>Profile Preview</h1>
    <p>Student Record Verified</p>
</div>

<div class="ios-card" style="text-align: center;">
    @if($student->profile_picture)
        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile" style="width: 120px; height: 120px; border-radius: 60px; object-fit: cover; margin-bottom: 20px; border: 3px solid var(--ios-blue);">
    @endif
    
    <h2 style="margin: 0 0 5px 0;">{{ $student->first_name }} {{ $student->last_name }}</h2>
    <p style="color: var(--ios-blue); font-weight: 600; margin: 0 0 20px 0;">{{ $student->student_id }}</p>

    <div style="background: rgba(255,255,255,0.05); border-radius: 12px; padding: 20px; text-align: left;">
        <p><strong>Program:</strong> {{ $student->program }} (Year {{ $student->year_level }})</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Phone:</strong> {{ $student->mobile_number }}</p>
        <p><strong>Address:</strong> {{ $student->address }}</p>
    </div>

    <a href="{{ route('saved.registration') }}" class="ios-btn ios-btn-secondary" style="margin-top: 20px; text-decoration: none;">View All Records</a>
</div>
@endsection