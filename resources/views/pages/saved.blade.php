@extends('components.layout')

@section('content')
<div class="page-intro">
    <h1>Student Records</h1>
    <p>Manage and review submitted registrations</p>
</div>

<div class="ios-card glass-theme">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <span class="phase-title">Directory Database</span>
        <a href="{{ route('registration') }}" class="ios-btn" style="width: auto; padding: 10px 20px; font-size: 13px; margin-top: 0;">
            <svg class="icon-svg" style="width:16px; height:16px;" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            Add New
        </a>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        .glass-theme {
            font-family: 'Poppins', sans-serif;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.35);
            color: #ffffff;
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .phase-title {
            font-weight: 600; 
            font-size: 18px;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.4);
        }

        .ios-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .ios-table th {
            font-size: 12px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 16px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }
        .ios-table td {
            padding: 16px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
            transition: background 0.2s ease;
        }
        .ios-table tbody tr {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .ios-table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.05);
        }
        .ios-badge {
            background: rgba(59, 130, 246, 0.3);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            box-shadow: 0 2px 10px rgba(59, 130, 246, 0.2);
        }
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: rgba(255,255,255,0.5);
        }
        .empty-icon {
            width: 48px;
            height: 48px;
            fill: currentColor;
            opacity: 0.5;
            margin-bottom: 12px;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }
        .modal-card {
            background: rgba(20, 30, 48, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 24px;
            padding: 40px;
            width: 90%;
            max-width: 450px;
            color: #fff;
            transform: translateY(30px);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 15px 35px rgba(0,0,0,0.5);
            text-align: center;
        }
        .modal-overlay.active .modal-card {
            transform: translateY(0);
        }
        .modal-close {
            background: none;
            border: none;
            color: rgba(255,255,255,0.5);
            font-size: 24px;
            position: absolute;
            top: 20px;
            right: 24px;
            cursor: pointer;
            transition: color 0.2s;
        }
        .modal-close:hover { color: #fff; }
        .modal-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #60A5FA;
            margin-bottom: 15px;
            background: rgba(255,255,255,0.1);
        }
        .modal-info-grid {
            text-align: left;
            background: rgba(0,0,0,0.2);
            padding: 20px;
            border-radius: 16px;
            margin-top: 20px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .modal-info-grid p {
            margin: 8px 0;
            font-size: 14px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 8px;
        }
        .modal-info-grid p:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .modal-label {
            color: rgba(255,255,255,0.5);
            font-weight: 500;
            font-size: 12px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 2px;
        }
    </style>

    <div style="overflow-x: auto;">
        <table class="ios-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Year</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students ?? [] as $student)
                    <tr onclick='openModal(@json($student))'>
                        <td style="font-weight: 600; color: #60A5FA;">{{ $student->student_id }}</td>
                        <td style="font-weight: 500;">{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td><span class="ios-badge">{{ $student->program }}</span></td>
                        <td>{{ $student->year_level }}</td>
                        <td style="color: #34D399; font-weight: 600;">Active</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg class="empty-icon" viewBox="0 0 24 24"><path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                                <div>No student records found.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Glass Modal for Student Details -->
<div id="studentModal" class="modal-overlay" onclick="closeModal(event)">
    <div class="modal-card" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeModal()">&times;</button>
        
        <img id="modal_img" src="" alt="Profile" class="modal-img" style="display: none;">
        <h2 id="modal_name" style="margin: 0 0 5px 0; font-size: 22px; font-weight: 600;"></h2>
        <p id="modal_id" style="color: #60A5FA; font-weight: 600; font-size: 14px; margin: 0 0 20px 0;"></p>

        <div class="modal-info-grid">
            <p>
                <span class="modal-label">Program & Year</span>
                <span id="modal_program"></span>
            </p>
            <p>
                <span class="modal-label">Email Address</span>
                <span id="modal_email"></span>
            </p>
            <p>
                <span class="modal-label">Phone Number</span>
                <span id="modal_phone"></span>
            </p>
            <p>
                <span class="modal-label">Home Address</span>
                <span id="modal_address"></span>
            </p>
        </div>
    </div>
</div>

<script>
    function openModal(student) {
        document.getElementById('modal_name').textContent = student.first_name + ' ' + (student.middle_name ? student.middle_name + ' ' : '') + student.last_name;
        document.getElementById('modal_id').textContent = student.student_id;
        document.getElementById('modal_program').textContent = student.program + ' (Year ' + student.year_level + ')';
        document.getElementById('modal_email').textContent = student.email;
        document.getElementById('modal_phone').textContent = student.mobile_number;
        document.getElementById('modal_address').textContent = student.address;
        
        const imgEl = document.getElementById('modal_img');
        if (student.profile_picture) {
            imgEl.src = '/storage/' + student.profile_picture;
            imgEl.style.display = 'inline-block';
        } else {
            imgEl.style.display = 'none';
        }

        document.getElementById('studentModal').classList.add('active');
    }

    function closeModal(event) {
        if (!event || event.target.id === 'studentModal' || event.target.className === 'modal-close') {
            document.getElementById('studentModal').classList.remove('active');
        }
    }
</script>
@endsection