@extends('components.layout')

@section('content')
@include('components.theme-navbar')

<!-- Enable View Transitions for Continuous Feel Between Page Loads (Chrome 111+) -->
<meta name="view-transition" content="same-origin">

<!-- Roaming Ambient Light -->
<div class="roaming-light"></div>

<div class="page-intro">
    <h1>Confirm Registration</h1>
    <p>Please review your details before submitting</p>
</div>

<!-- Lower Right Toast Notification Container for Navigation Block -->
<div id="toastContainer" class="toast-container"></div>

<div class="ios-card glass-theme" style="text-align: center; max-width: 600px; margin: 0 auto;">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        /* Roaming Light Animation */
        .roaming-light {
            position: fixed;
            top: -50%; left: -50%;
            width: 200%; height: 200%;
            background: radial-gradient(circle at 50% 50%, rgba(96, 165, 250, 0.12) 0%, transparent 40%);
            z-index: -1;
            pointer-events: none;
            animation: roamLight 20s infinite alternate cubic-bezier(0.45, 0.05, 0.55, 0.95);
        }
        @keyframes roamLight {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(8%, 12%) scale(1.1); }
            100% { transform: translate(-8%, -10%) scale(1); }
        }

        /* Intro Animations */
        .page-intro {
            animation: fadeInDown 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(-20px);
        }
        @keyframes fadeInDown {
            to { opacity: 1; transform: translateY(0); }
        }

        .glass-theme {
            font-family: 'Poppins', sans-serif;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.35);
            color: #ffffff;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            animation-delay: 0.1s;
            opacity: 0;
            transform: translateY(30px);
        }
        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Icon Transition */
        .icon-svg {
            transition: fill 0.3s ease;
        }

        .confirm-img {
            width: 120px; 
            height: 120px; 
            border-radius: 50%; 
            object-fit: cover; 
            margin-bottom: 20px; 
            border: 4px solid #60A5FA;
            background: rgba(255,255,255,0.1);
            box-shadow: 0 4px 15px rgba(96, 165, 250, 0.4);
        }

        .info-panel {
            background: rgba(0,0,0,0.25);
            border-radius: 16px;
            padding: 24px;
            text-align: left;
            border: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
        }
        
        .info-panel p {
            margin: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 10px;
        }
        .info-panel p:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            color: rgba(255,255,255,0.5);
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 500;
            display: block;
            margin-bottom: 3px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
            flex-direction: column;
        }

        /* Re-used Button Styles */
        .ios-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 16px;
            background: rgba(255, 255, 255, 0.9);
            color: #0f172a;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
            text-decoration: none;
        }
        .ios-btn:hover {
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255,255,255,0.3);
        }
        .ios-btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            box-shadow: none;
        }
        .ios-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        /* Toast UI */
        .toast-container { position: fixed; bottom: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px; max-width: 360px; pointer-events: none; }
        .toast-card { pointer-events: auto; background: rgba(15, 23, 42, 0.95); border: 1px solid rgba(239, 68, 68, 0.4); border-left: 4px solid #EF4444; color: #F8FAFC; padding: 16px; border-radius: 14px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5); backdrop-filter: blur(12px); font-size: 13px; display: flex; align-items: flex-start; gap: 12px; animation: slideInRight 0.3s cubic-bezier(0.16, 1, 0.3, 1); }
        .toast-content { flex: 1; }
        .toast-title { font-weight: 700; color: #EF4444; margin-bottom: 4px; font-size: 14px; }
        .toast-message { color: #CBD5E1; line-height: 1.4; }
        .toast-close { background: none; border: none; color: #94A3B8; font-size: 18px; cursor: pointer; padding: 0; line-height: 1; }
        @keyframes slideInRight { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes fadeOutRight { from { transform: translateX(0); opacity: 1; } to { transform: translateX(100%); opacity: 0; } }

        /* =========================================
           LIGHT MODE OVERRIDES - High Contrast
        ========================================= */
        body.theme-light .roaming-light {
            background: radial-gradient(circle at 50% 50%, rgba(37, 99, 235, 0.08) 0%, transparent 40%);
        }
        
        body.theme-light .icon-svg {
            fill: #000000 !important; /* Force icons black */
        }
        
        body.theme-light .page-intro h1,
        body.theme-light .page-intro p {
            color: #0f172a !important;
            -webkit-text-fill-color: #0f172a !important; /* Prevents text color fade issue */
            text-shadow: none !important;
            font-weight: 800 !important;
            background: none !important;
        }
        body.theme-light .glass-theme {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(0, 0, 0, 0.15);
            color: #0f172a;
            font-weight: 600;
        }
        body.theme-light h2 {
            color: #0f172a !important;
            font-weight: 800 !important;
        }
        body.theme-light p {
            color: #0f172a !important;
            font-weight: 700 !important;
        }
        body.theme-light .info-panel {
            background: rgba(0,0,0,0.05);
            border-color: rgba(0,0,0,0.2);
            color: #0f172a;
        }
        body.theme-light .info-panel p {
            border-bottom-color: rgba(0,0,0,0.2);
            font-weight: 600 !important;
        }
        body.theme-light .info-label {
            color: #1e293b;
            font-weight: 800;
        }
        body.theme-light .ios-btn {
            background: #0f172a;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.2);
        }
        body.theme-light .ios-btn:hover {
            background: #1e293b;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.3);
        }
        body.theme-light .ios-btn-secondary {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0,0,0,0.3);
            color: #0f172a;
            font-weight: 700;
            box-shadow: none;
        }
        body.theme-light .ios-btn-secondary:hover {
            background: rgba(0, 0, 0, 0.1);
        }
        body.theme-light .toast-card {
            background: rgba(255, 255, 255, 0.98);
            color: #0f172a;
            border-color: #EF4444;
            font-weight: 600;
        }
        body.theme-light .toast-message {
            color: #1e293b;
            font-weight: 600;
        }
    </style>

    @if($student->profile_picture)
        <img src="{{ asset('storage/' . $student->profile_picture) }}" alt="Profile" class="confirm-img">
    @endif
    
    <h2 style="margin: 0 0 5px 0; font-size: 24px;">{{ $student->first_name }} {{ $student->last_name }}</h2>
    <p style="color: #2563eb !important; font-weight: 700 !important; margin: 0 0 24px 0; font-size: 15px;">{{ $student->student_id }}</p>

    <div class="info-panel">
        <p><span class="info-label">Academic Program</span> {{ $student->program }} (Year {{ $student->year_level }})</p>
        <p><span class="info-label">Email Address</span> {{ $student->email }}</p>
        <p><span class="info-label">Phone Number</span> {{ $student->mobile_number }}</p>
        <p><span class="info-label">Home Address</span> {{ $student->address }}</p>
    </div>

    <div class="btn-group">
        <form action="{{ route('students.confirm', $student->id) }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="ios-btn">
                <svg class="icon-svg" style="width:18px; height:18px; fill:currentColor;" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                Confirm Information
            </button>
        </form>

        <button type="button" class="ios-btn ios-btn-secondary" onclick="window.history.back()">
            Return
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('a[href*="saved"]');
        
        navLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                showToast("You can't check the data, confirm your information first.");
            });
        });
    });

    function showToast(message) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = 'toast-card';
        toast.innerHTML = `
            <div class="toast-content">
                <div class="toast-title">Action Required</div>
                <div class="toast-message">${message}</div>
            </div>
            <button type="button" class="toast-close" onclick="closeToast(this.parentElement)">&times;</button>
        `;
        container.appendChild(toast);
        setTimeout(() => { closeToast(toast); }, 4500);
    }

    function closeToast(toastElement) {
        if (toastElement && toastElement.parentElement) {
            toastElement.style.animation = 'fadeOutRight 0.3s forwards';
            setTimeout(() => toastElement.remove(), 300);
        }
    }
</script>
@endsection