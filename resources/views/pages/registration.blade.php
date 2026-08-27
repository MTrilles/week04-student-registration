@extends('components.layout')

@section('content')
<div class="page-intro">
    <h1>Student Portal</h1>
    <p>College of Information Technology Digital Registration</p>
</div>

<!-- Lower Right Toast Notification Container -->
<div id="toastContainer" class="toast-container"></div>

<div class="ios-card glass-theme">
    <style>
        /* Typography & Smoothness */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        .glass-theme {
            font-family: 'Poppins', sans-serif;
            background: rgba(255, 255, 255, 0.08); /* Glass base */
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.35);
            /* Simple Intro Animation */
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            transform: translateY(30px);
            color: #ffffff; 
        }

        @keyframes slideUpFade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .phase-indicator {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }
        
        .phase-title {
            font-weight: 600; 
            font-size: 18px;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }

        .phase-badge {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: #ffffff;
            background: rgba(59, 130, 246, 0.5);
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.2);
        }

        /* Input Styling */
        .ios-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
            color: #f8fafc;
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
            margin-top: 15px;
        }

        .ios-input {
            width: 100%;
            padding: 14px 16px;
            background: rgba(0, 0, 0, 0.25); /* Dark transparent for contrast */
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            font-size: 14px;
            color: #ffffff;
            outline: none;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 5px;
        }

        .ios-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .ios-input:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: #60A5FA;
            box-shadow: 0 0 15px rgba(96, 165, 250, 0.3);
        }

        /* Improved Dropdown UI */
        select.ios-input {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23FFFFFF%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat;
            background-position: right 16px top 50%;
            background-size: 12px auto;
        }

        select.ios-input option {
            background-color: #1e293b; /* Solid dark background for readable dropdown */
            color: #ffffff;
            padding: 10px;
        }

        /* Improved Calendar UI */
        input[type="date"].ios-input::-webkit-calendar-picker-indicator {
            filter: invert(1);
            cursor: pointer;
            opacity: 0.8;
            transition: 0.2s;
        }
        
        input[type="date"].ios-input::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }

        /* Button Styling */
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
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(255,255,255,0.2);
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
            margin-top: 10px;
        }

        .ios-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        /* Scanner Box */
        .scan-box {
            border: 2px dashed rgba(255, 255, 255, 0.5);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
            margin-bottom: 24px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        }

        .scan-box:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }

        .validation-error {
            color: #FCA5A5; 
            font-size: 12px; 
            margin-top: 2px; 
            display: block; 
            margin-bottom: 10px;
            font-weight: 500;
        }

        /* Lower Right Toast Notification Styles */
        .toast-container {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-width: 360px;
            width: calc(100% - 48px);
            pointer-events: none;
        }
        .toast-card {
            pointer-events: auto;
            background: rgba(15, 23, 42, 0.95);
            border: 1px solid rgba(239, 68, 68, 0.4);
            border-left: 4px solid #EF4444;
            color: #F8FAFC;
            padding: 16px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(12px);
            font-size: 13px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            animation: slideInRight 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .toast-content { flex: 1; }
        .toast-title { font-weight: 700; color: #EF4444; margin-bottom: 4px; font-size: 14px; }
        .toast-message { color: #CBD5E1; line-height: 1.4; }
        .toast-list { margin: 6px 0 0 0; padding-left: 18px; color: #F8FAFC; }
        .toast-list li { margin-bottom: 2px; }
        .toast-close {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
        .toast-close:hover { color: #FFFFFF; }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes fadeOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .hidden { display: none; }
    </style>

    <form id="registrationForm" action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Phase 1 -->
        <div id="phase1" class="phase">
            <div class="phase-indicator">
                <span class="phase-title">Academic Info</span>
                <span class="phase-badge">STEP 1 OF 3</span>
            </div>

            <!-- Tesseract Scanner Input -->
            <input type="file" id="id_scanner" accept="image/*" style="display: none;" onchange="processIdScan(this)">
            <div class="scan-box" onclick="document.getElementById('id_scanner').click()">
                <svg class="icon-svg" style="width:20px; height:20px; fill:currentColor;" viewBox="0 0 24 24"><path d="M4 4h3l2-2h6l2 2h3a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm8 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/></svg>
                <span id="scan_text">Tap to Upload & Scan School ID (Optional)</span>
            </div>

            <label class="ios-label">Student ID *</label>
            <input type="text" name="student_id" id="field_student_id" class="ios-input" value="{{ old('student_id') }}" placeholder="1234-5678" maxlength="9" oninput="formatStudentIdInput(this)">
            @error('student_id') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">First Name *</label>
            <input type="text" name="first_name" id="field_first_name" class="ios-input" value="{{ old('first_name') }}" placeholder="Alex" oninput="formatNameInput(this)">
            @error('first_name') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Middle Name (Optional)</label>
            <input type="text" name="middle_name" id="field_middle_name" class="ios-input" value="{{ old('middle_name') }}" placeholder="Julian" oninput="formatNameInput(this)">

            <label class="ios-label">Last Name *</label>
            <input type="text" name="last_name" id="field_last_name" class="ios-input" value="{{ old('last_name') }}" placeholder="Mercer" oninput="formatNameInput(this)">
            @error('last_name') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Program *</label>
            <select name="program" id="field_program" class="ios-input">
                <option value="" disabled {{ old('program') ? '' : 'selected' }}>Select Academic Program</option>
                <option value="BSIT" {{ old('program') == 'BSIT' ? 'selected' : '' }}>BS Information Technology</option>
                <option value="BSCS" {{ old('program') == 'BSCS' ? 'selected' : '' }}>BS Computer Science</option>
                <option value="BSIS" {{ old('program') == 'BSIS' ? 'selected' : '' }}>BS Information Systems</option>
            </select>
            @error('program') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Year Level *</label>
            <select name="year_level" id="field_year_level" class="ios-input">
                <option value="" disabled {{ old('year_level') ? '' : 'selected' }}>Select Year Level</option>
                <option value="1" {{ old('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                <option value="2" {{ old('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                <option value="3" {{ old('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                <option value="4" {{ old('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
            </select>
            @error('year_level') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Gender *</label>
            <select name="gender" id="field_gender" class="ios-input">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender') <span class="validation-error">{{ $message }}</span> @enderror

            <button type="button" class="ios-btn" onclick="nextPhase(2)">
                Continue
                <svg class="icon-svg" style="width:18px; height:18px; fill:currentColor;" viewBox="0 0 24 24"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </button>
        </div>

        <!-- Phase 2 -->
        <div id="phase2" class="phase hidden">
            <div class="phase-indicator">
                <span class="phase-title">Contact Info</span>
                <span class="phase-badge">STEP 2 OF 3</span>
            </div>

            <label class="ios-label">Date of Birth *</label>
            <input type="date" name="date_of_birth" id="field_date_of_birth" class="ios-input" value="{{ old('date_of_birth') }}" title="You must be at least 18 years old">
            @error('date_of_birth') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Address *</label>
            <input type="text" name="address" id="field_address" class="ios-input" value="{{ old('address') }}" placeholder="Street, City, Province">
            @error('address') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Email Address *</label>
            <input type="email" name="email" id="field_email" class="ios-input" value="{{ old('email') }}" placeholder="alex.mercer@cit.edu">
            @error('email') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Mobile Number *</label>
            <!-- Changed to tel and capped length via javascript -->
            <input type="tel" name="mobile_number" id="field_mobile_number" class="ios-input" value="{{ old('mobile_number') }}" placeholder="09123456789" maxlength="11" oninput="formatPhoneInput(this)">
            @error('mobile_number') <span class="validation-error">{{ $message }}</span> @enderror

            <button type="button" class="ios-btn" onclick="nextPhase(3)">
                Continue
                <svg class="icon-svg" style="width:18px; height:18px; fill:currentColor;" viewBox="0 0 24 24"><path d="M5 13h11.86l-5.43 5.43 1.42 1.42L21.14 12l-8.29-8.29-1.42 1.42L16.86 11H5v2z"/></svg>
            </button>
            <button type="button" class="ios-btn ios-btn-secondary" onclick="nextPhase(1, true)">Back</button>
        </div>

        <!-- Phase 3 -->
        <div id="phase3" class="phase hidden">
            <div class="phase-indicator">
                <span class="phase-title">Identification</span>
                <span class="phase-badge">STEP 3 OF 3</span>
            </div>

            <label class="ios-label">Profile Picture *</label>
            <input type="file" name="profile_picture" id="field_profile_picture" accept="image/*" class="ios-input" style="padding: 10px 16px;">
            @error('profile_picture') <span class="validation-error">{{ $message }}</span> @enderror

            <button type="submit" class="ios-btn">
                <svg class="icon-svg" style="width:18px; height:18px; fill:currentColor;" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                Complete Registration
            </button>
            <button type="button" class="ios-btn ios-btn-secondary" onclick="nextPhase(2, true)">Back</button>
        </div>
    </form>
</div>

<!-- Tesseract.js Client-Side Library -->
<script src="https://cdn.jsdelivr.net/npm/tesseract.js@5/dist/tesseract.min.js"></script>

<script>
    // Set strictly 18 years ago as the max allowed birth date on page load
    document.addEventListener('DOMContentLoaded', () => {
        const dobInput = document.getElementById('field_date_of_birth');
        const today = new Date();
        const maxYear = today.getFullYear() - 18;
        const maxMonth = String(today.getMonth() + 1).padStart(2, '0');
        const maxDay = String(today.getDate()).padStart(2, '0');
        
        dobInput.setAttribute('max', `${maxYear}-${maxMonth}-${maxDay}`);
    });

    // Strip non-numbers and limit strictly to 11 digits
    function formatPhoneInput(input) {
        let sanitized = input.value.replace(/\D/g, '');
        if (sanitized.length > 11) {
            sanitized = sanitized.slice(0, 11);
        }
        input.value = sanitized;
    }

    // Limits and formats Student ID input specifically into XXXX-XXXX
    function formatStudentIdInput(input) {
        let val = input.value.replace(/\D/g, ''); 
        if (val.length > 4) {
            val = val.substring(0, 4) + '-' + val.substring(4, 8);
        }
        input.value = val;
    }

    // Strict Name Format Rule: No numbers or special characters & Auto-capitalize each word
    function formatNameInput(input) {
        let cleanValue = input.value.replace(/[^a-zA-Z\s\-']/g, '');
        cleanValue = cleanValue.replace(/(^\w|\s\w|[\-']\w)/g, function(letter) {
            return letter.toUpperCase();
        });
        input.value = cleanValue;
    }

    // Lower Right Toast Dialog Generator
    function showToast(message, fieldsList = []) {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');
        toast.className = 'toast-card';
        
        let listHtml = '';
        if (fieldsList.length > 0) {
            listHtml = `<ul class="toast-list">${fieldsList.map(f => `<li>${f}</li>`).join('')}</ul>`;
        }

        toast.innerHTML = `
            <div class="toast-content">
                <div class="toast-title">Validation Error</div>
                <div class="toast-message">${message}</div>
                ${listHtml}
            </div>
            <button type="button" class="toast-close" onclick="closeToast(this.parentElement)">&times;</button>
        `;

        container.appendChild(toast);
        setTimeout(() => { closeToast(toast); }, 6000);
    }

    function closeToast(toastElement) {
        if (toastElement && toastElement.parentElement) {
            toastElement.style.animation = 'fadeOutRight 0.3s forwards';
            setTimeout(() => toastElement.remove(), 300);
        }
    }

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    // Phase Navigation with Validation Gate
    function nextPhase(targetPhase, isGoingBack = false) {
        if (isGoingBack) {
            document.querySelectorAll('.phase').forEach(el => el.classList.add('hidden'));
            document.getElementById('phase' + targetPhase).classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
            return;
        }

        const activePhase = document.querySelector('.phase:not(.hidden)').id;
        let missingFields = [];

        if (activePhase === 'phase1') {
            const studentId = document.getElementById('field_student_id').value.trim();
            const firstName = document.getElementById('field_first_name').value.trim();
            const lastName = document.getElementById('field_last_name').value.trim();
            const program = document.getElementById('field_program').value;
            const yearLevel = document.getElementById('field_year_level').value;
            const gender = document.getElementById('field_gender').value;

            if (!studentId || !/^\d{4}-\d{4}$/.test(studentId)) missingFields.push('Student ID (Must be XXXX-XXXX format)');
            if (!firstName) missingFields.push('First Name');
            if (!lastName) missingFields.push('Last Name');
            if (!program) missingFields.push('Program');
            if (!yearLevel) missingFields.push('Year Level');
            if (!gender) missingFields.push('Gender');

            if (missingFields.length > 0) {
                showToast('Please complete all required fields in Step 1 before continuing:', missingFields);
                return;
            }
        } 
        else if (activePhase === 'phase2') {
            const dob = document.getElementById('field_date_of_birth').value;
            const address = document.getElementById('field_address').value.trim();
            const email = document.getElementById('field_email').value.trim();
            const mobile = document.getElementById('field_mobile_number').value.trim();

            if (!dob) {
                missingFields.push('Date of Birth');
            } else {
                // Secondary check to ensure user isn't tampering with HTML directly
                const dobDate = new Date(dob);
                const today = new Date();
                let age = today.getFullYear() - dobDate.getFullYear();
                const m = today.getMonth() - dobDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < dobDate.getDate())) {
                    age--;
                }
                if (age < 18) {
                    missingFields.push('Age requirement not met (Must be 18+)');
                }
            }
            if (!address) missingFields.push('Address');
            if (!email) {
                missingFields.push('Email Address');
            } else if (!isValidEmail(email)) {
                missingFields.push('Email Address (Invalid format)');
            }
            if (!mobile) {
                missingFields.push('Mobile Number');
            } else if (mobile.length !== 11) {
                missingFields.push('Mobile Number (Must be exactly 11 digits)');
            }

            if (missingFields.length > 0) {
                showToast('Please resolve the following before continuing:', missingFields);
                return;
            }
        }

        document.querySelectorAll('.phase').forEach(el => el.classList.add('hidden'));
        document.getElementById('phase' + targetPhase).classList.remove('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        const profilePic = document.getElementById('field_profile_picture');
        if (!profilePic.files || profilePic.files.length === 0) {
            e.preventDefault();
            showToast('Profile picture is required:', ['Profile Picture']);
        }
    });

    // Highly Aggressive Integer Extractor for Student ID
    function extractStudentId(text) {
        let sanitized = text.replace(/[Oo]/g, '0').replace(/[lI|]/g, '1').replace(/[S]/g, '5')
                            .replace(/[Zz]/g, '2').replace(/[B]/g, '8').replace(/[G]/g, '6');
        let flattened = sanitized.replace(/\D/g, '');
        let match = flattened.match(/(\d{4})(\d{4})/);
        return match ? `${match[1]}-${match[2]}` : '';
    }

    // Auto-detect program matching specific full titles directly
    function extractProgram(text) {
        let cleanText = text.replace(/[\r\n]+/g, ' ').replace(/\s+/g, ' ');
        if (/Bachelor of Science in Information Technology/i.test(cleanText) || /Information Technology/i.test(cleanText) || /BSIT/i.test(cleanText)) return 'BSIT';
        if (/Bachelor of Science in Computer Science/i.test(cleanText) || /Computer Science/i.test(cleanText) || /BSCS/i.test(cleanText)) return 'BSCS';
        if (/Bachelor of Science in Information Systems/i.test(cleanText) || /Information Systems/i.test(cleanText) || /BSIS/i.test(cleanText)) return 'BSIS';
        return '';
    }

    // Scans line-by-line to avoid merging Names and Program texts
    function extractParsedName(text) {
        let firstName = '', middleName = '', lastName = '';
        let lines = text.split('\n');
        for (let line of lines) {
            let cleanLine = line.trim();
            if (cleanLine.length < 5 || /\d/.test(cleanLine) || /bachelor|science|technology|computer|systems|college|information/i.test(cleanLine)) continue;
            let match3 = cleanLine.match(/^([a-zA-Z]{2,})[\s\-]+([a-zA-Z]\.?)\s+([a-zA-Z]{2,})$/);
            if (match3) return { firstName: match3[1], middleName: match3[2].replace(/[\.\-]/g, ''), lastName: match3[3] };
            let match2 = cleanLine.match(/^([a-zA-Z]{2,})\s+([a-zA-Z]{2,})$/);
            if (match2) return { firstName: match2[1], middleName: '', lastName: match2[2] };
        }
        return { firstName, middleName, lastName };
    }

    async function processIdScan(input) {
        if (!input.files || !input.files[0]) return;
        const scanText = document.getElementById('scan_text');
        scanText.innerText = "Initializing OCR... 0%";
        try {
            const result = await Tesseract.recognize(
                input.files[0], 'eng', {
                    logger: m => {
                        if (m.status === 'recognizing text') {
                            const progress = Math.round(m.progress * 100);
                            scanText.innerText = `Scanning document... ${progress}%`;
                        }
                    }
                }
            );
            const rawText = result.data ? result.data.text : '';
            console.log("RAW OCR OUTPUT:\n", rawText);
            const studentId = extractStudentId(rawText);
            const nameData = extractParsedName(rawText);
            const program = extractProgram(rawText);

            if (!studentId && !nameData.firstName) {
                scanText.innerText = "Scan completed, but fields were not recognized. Please review.";
            } else {
                scanText.innerText = "Scan Complete! Fields Auto-filled.";
            }
            if (studentId) document.getElementById('field_student_id').value = studentId;
            if (nameData.firstName) document.getElementById('field_first_name').value = nameData.firstName;
            if (nameData.middleName) document.getElementById('field_middle_name').value = nameData.middleName;
            if (nameData.lastName) document.getElementById('field_last_name').value = nameData.lastName;
            if (program) document.getElementById('field_program').value = program;

            formatNameInput(document.getElementById('field_first_name'));
            formatNameInput(document.getElementById('field_last_name'));
        } catch (error) {
            scanText.innerText = "Scanning failed. Please try again.";
            console.error("Tesseract Error:", error);
        }
    }
</script>
@endsection