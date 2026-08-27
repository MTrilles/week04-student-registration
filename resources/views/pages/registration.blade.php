@extends('components.layout')

@section('content')
<div class="page-intro">
    <h1>Student Portal</h1>
    <p>College of Information Technology Digital Registration</p>
</div>

<div class="ios-card">
    <style>
        .phase-indicator {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .phase-badge {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--ios-blue);
            background: rgba(59, 130, 246, 0.15);
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }
        .scan-box {
            border: 2px dashed rgba(59, 130, 246, 0.4);
            background: rgba(59, 130, 246, 0.05);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            color: var(--ios-blue);
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            margin-bottom: 24px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .scan-box:hover {
            background: rgba(59, 130, 246, 0.1);
            border-color: var(--ios-blue);
        }
    </style>

    <form id="registrationForm" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Phase 1 -->
        <div id="phase1" class="phase">
            <div class="phase-indicator">
                <span style="font-weight: 600; font-size: 16px;">Academic Info</span>
                <span class="phase-badge">STEP 1 OF 3</span>
            </div>

            <div class="scan-box" onclick="alert('Scanner module initialized. Camera processing for auto-fill...')">
                <svg class="icon-svg" style="width:20px; height:20px;" viewBox="0 0 24 24"><path d="M4 4h3l2-2h6l2 2h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm8 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg>
                Scan School ID to Auto-Fill (Optional)
            </div>

            <label class="ios-label">Student ID</label>
            <input type="text" name="student_id" class="ios-input" required placeholder="2026-00123">

            <label class="ios-label">First Name</label>
            <input type="text" name="first_name" class="ios-input" required placeholder="Alex">

            <label class="ios-label">Middle Name (Optional)</label>
            <input type="text" name="middle_name" class="ios-input" placeholder="Julian">

            <label class="ios-label">Last Name</label>
            <input type="text" name="last_name" class="ios-input" required placeholder="Mercer">

            <label class="ios-label">Program</label>
            <select name="program" class="ios-input" required>
                <option value="" disabled selected>Select Academic Program</option>
                <option value="BSIT">BS Information Technology</option>
                <option value="BSCS">BS Computer Science</option>
                <option value="BSIS">BS Information Systems</option>
            </select>

            <label class="ios-label">Year Level</label>
            <select name="year_level" class="ios-input" required>
                <option value="" disabled selected>Select Year Level</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>

            <label class="ios-label">Gender</label>
            <select name="gender" class="ios-input" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <button type="button" class="ios-btn" onclick="nextPhase(2)">
                Continue
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </button>
        </div>

        <!-- Phase 2 -->
        <div id="phase2" class="phase hidden">
            <div class="phase-indicator">
                <span style="font-weight: 600; font-size: 16px;">Contact Info</span>
                <span class="phase-badge">STEP 2 OF 3</span>
            </div>

            <label class="ios-label">Date of Birth</label>
            <input type="date" name="dob" class="ios-input" required>

            <label class="ios-label">Address</label>
            <input type="text" name="address" class="ios-input" required placeholder="Street, City, Province">

            <label class="ios-label">Email Address</label>
            <input type="email" name="email" class="ios-input" required placeholder="alex.mercer@cit.edu">

            <label class="ios-label">Mobile Number</label>
            <input type="number" name="mobile" class="ios-input" required placeholder="09123456789">

            <button type="button" class="ios-btn" onclick="nextPhase(3)">
                Continue
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </button>
            <button type="button" class="ios-btn ios-btn-secondary" onclick="nextPhase(1)">Back</button>
        </div>

        <!-- Phase 3 -->
        <div id="phase3" class="phase hidden">
            <div class="phase-indicator">
                <span style="font-weight: 600; font-size: 16px;">Identification</span>
                <span class="phase-badge">STEP 3 OF 3</span>
            </div>

            <label class="ios-label">Profile Picture</label>
            <input type="file" name="profile_picture" accept="image/*" class="ios-input" required>

            <button type="submit" class="ios-btn">
                <svg class="icon-svg" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                Complete Registration
            </button>
            <button type="button" class="ios-btn ios-btn-secondary" onclick="nextPhase(2)">Back</button>
        </div>
    </form>
</div>

<script>
    function nextPhase(phaseNumber) {
        document.querySelectorAll('.phase').forEach(el => el.classList.add('hidden'));
        document.getElementById('phase' + phaseNumber).classList.remove('hidden');
    }
</script>
@endsection