@extends('components.layout')

@section('content')
<div class="page-intro">
    <h1>Student Portal</h1>
    <p>College of Information Technology Digital Registration</p>
</div>

<!-- Lower Right Toast Notification Container -->
<div id="toastContainer" class="toast-container"></div>

<div class="ios-card">
    <style>
        .phase-indicator {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--card-border, rgba(255, 255, 255, 0.08));
        }
        .phase-title {
            font-weight: 600; 
            font-size: 16px;
            color: var(--text-main, #F8FAFC);
        }
        .phase-badge {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            color: var(--ios-blue, #3B82F6);
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
            color: var(--ios-blue, #3B82F6);
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
            border-color: var(--ios-blue, #3B82F6);
        }
        .validation-error {
            color: #EF4444; 
            font-size: 12px; 
            margin-top: -15px; 
            display: block; 
            margin-bottom: 15px;
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
        .toast-content {
            flex: 1;
        }
        .toast-title {
            font-weight: 700;
            color: #EF4444;
            margin-bottom: 4px;
            font-size: 14px;
        }
        .toast-message {
            color: #CBD5E1;
            line-height: 1.4;
        }
        .toast-list {
            margin: 6px 0 0 0;
            padding-left: 18px;
            color: #F8FAFC;
        }
        .toast-list li {
            margin-bottom: 2px;
        }
        .toast-close {
            background: none;
            border: none;
            color: #94A3B8;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
        .toast-close:hover {
            color: #FFFFFF;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes fadeOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
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
                <span id="scan_text">Tap to Upload & Scan School ID</span>
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
            <input type="date" name="date_of_birth" id="field_date_of_birth" class="ios-input" value="{{ old('date_of_birth') }}">
            @error('date_of_birth') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Address *</label>
            <input type="text" name="address" id="field_address" class="ios-input" value="{{ old('address') }}" placeholder="Street, City, Province">
            @error('address') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Email Address *</label>
            <input type="email" name="email" id="field_email" class="ios-input" value="{{ old('email') }}" placeholder="alex.mercer@cit.edu">
            @error('email') <span class="validation-error">{{ $message }}</span> @enderror

            <label class="ios-label">Mobile Number *</label>
            <input type="number" name="mobile_number" id="field_mobile_number" class="ios-input" value="{{ old('mobile_number') }}" placeholder="09123456789">
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
            <input type="file" name="profile_picture" id="field_profile_picture" accept="image/*" class="ios-input">
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
    // Limits and formats Student ID input specifically into XXXX-XXXX
    function formatStudentIdInput(input) {
        let val = input.value.replace(/\D/g, ''); // Strip all non-digits
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
                <div class="toast-title">Missing Required Fields</div>
                <div class="toast-message">${message}</div>
                ${listHtml}
            </div>
            <button type="button" class="toast-close" onclick="closeToast(this.parentElement)">&times;</button>
        `;

        container.appendChild(toast);

        setTimeout(() => {
            closeToast(toast);
        }, 5000);
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

            // Check if student ID matches exactly 4 digits - 4 digits
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

            if (!dob) missingFields.push('Date of Birth');
            if (!address) missingFields.push('Address');
            if (!email) {
                missingFields.push('Email Address');
            } else if (!isValidEmail(email)) {
                missingFields.push('Email Address (Invalid format)');
            }
            if (!mobile) missingFields.push('Mobile Number');

            if (missingFields.length > 0) {
                showToast('Please complete all required fields in Step 2 before continuing:', missingFields);
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

    // Extract student ID by flattening all vertical text/line breaks to combine separated numbers
    function extractStudentId(text) {
        let sanitized = text.replace(/[Oo]/g, '0');
        
        // Remove ALL spaces and newlines so vertically read characters (e.g. 0\n1\n2\n4) merge into a single string
        let flattened = sanitized.replace(/[\s\r\n]/g, '');
        
        // Looks for exactly 4 numbers, an optional dash (since it might be missed), and 4 numbers
        let match = flattened.match(/(\d{4})-?(\d{4})/);
        return match ? `${match[1]}-${match[2]}` : '';
    }

    // Auto-detect program handling explicit "Bachelor of Science in" and standard abbreviations
    function extractProgram(text) {
        // Flatten into a single clean line for easier regex matching
        let cleanText = text.replace(/[\r\n]+/g, ' ').replace(/\s+/g, ' ');

        if (/Bachelor of Science in (Information Technology|IT)/i.test(cleanText) || /BS[\s-]?Information Technology/i.test(cleanText) || /BSIT/i.test(cleanText)) {
            return 'BSIT';
        }
        if (/Bachelor of Science in (Computer Science|CS)/i.test(cleanText) || /BS[\s-]?Computer Science/i.test(cleanText) || /BSCS/i.test(cleanText)) {
            return 'BSCS';
        }
        if (/Bachelor of Science in (Information Systems|IS)/i.test(cleanText) || /BS[\s-]?Information Systems/i.test(cleanText) || /BSIS/i.test(cleanText)) {
            return 'BSIS';
        }
        return '';
    }

    function extractParsedName(text) {
        let firstName = '', middleName = '', lastName = '';
        let cleanText = text.replace(/[\r\n]+/g, ' ');

        let match3 = cleanText.match(/([a-zA-Z]{2,})[\s\-]+([a-zA-Z]\.?)\s+([a-zA-Z]{2,})/);
        if (match3 && !/bachelor|science|technology|college/i.test(match3[0])) {
            firstName = match3[1];
            middleName = match3[2].replace(/[\.\-]/g, '');
            lastName = match3[3];
            return { firstName, middleName, lastName };
        }

        let lines = text.split('\n');
        for (let line of lines) {
            line = line.trim();
            if (/bachelor|science|technology|college/i.test(line)) continue;
            let match2 = line.match(/^([a-zA-Z]{2,})\s+([a-zA-Z]{2,})$/);
            if (match2) {
                firstName = match2[1];
                lastName = match2[2];
                break;
            }
        }

        return { firstName, middleName, lastName };
    }

    async function processIdScan(input) {
        if (!input.files || !input.files[0]) return;

        const scanText = document.getElementById('scan_text');
        scanText.innerText = "Initializing OCR... 0%";

        try {
            const result = await Tesseract.recognize(
                input.files[0],
                'eng',
                {
                    logger: m => {
                        if (m.status === 'recognizing text') {
                            const progress = Math.round(m.progress * 100);
                            scanText.innerText = `Scanning document... ${progress}%`;
                        }
                    }
                }
            );

            const rawText = result.data ? result.data.text : '';

            const studentId = extractStudentId(rawText);
            const nameData = extractParsedName(rawText);
            const program = extractProgram(rawText);

            if (!studentId && !nameData.firstName) {
                scanText.innerText = "Image scanned, but no ID or Name detected. Try better lighting.";
                return;
            }

            if (studentId) document.getElementById('field_student_id').value = studentId;
            if (nameData.firstName) document.getElementById('field_first_name').value = nameData.firstName;
            if (nameData.middleName) document.getElementById('field_middle_name').value = nameData.middleName;
            if (nameData.lastName) document.getElementById('field_last_name').value = nameData.lastName;
            if (program) document.getElementById('field_program').value = program;

            formatNameInput(document.getElementById('field_first_name'));
            formatNameInput(document.getElementById('field_last_name'));

            scanText.innerText = "Scan Complete! Fields Auto-filled.";
        } catch (error) {
            scanText.innerText = "Scanning failed. Please try again.";
            console.error("Tesseract Error:", error);
        }
    }
</script>
@endsection