@extends('components.layout')

@section('content')
<div class="page-intro">
    <h1>Student Records</h1>
    <p>Manage and review submitted registrations</p>
</div>

<div class="ios-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <span style="font-size: 15px; color: var(--text-muted); font-weight: 500;">Directory Database</span>
        <a href="{{ route('registration') }}" class="ios-btn" style="width: auto; padding: 8px 16px; font-size: 13px;">
            <svg class="icon-svg" style="width:14px; height:14px;" viewBox="0 0 24 24"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
            Add New
        </a>
    </div>

    <style>
        .ios-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .ios-table th {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 12px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .ios-table td {
            padding: 16px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            font-size: 14px;
            color: var(--text-main);
        }
        .ios-badge {
            background-color: rgba(59, 130, 246, 0.15);
            color: var(--ios-blue);
            border: 1px solid rgba(59, 130, 246, 0.3);
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
        }
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--text-muted);
        }
        .empty-icon {
            width: 48px;
            height: 48px;
            fill: var(--text-muted);
            opacity: 0.4;
            margin-bottom: 12px;
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
                    <tr>
                        <td style="font-weight: 600; color: #FFFFFF;">{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td><span class="ios-badge">{{ $student->program }}</span></td>
                        <td>{{ $student->year_level }}</td>
                        <td style="color: #34D399; font-weight: 600;">Active</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <svg class="empty-icon" viewBox="0 0 24 24"><path d="M19 5v14H5V5h14m0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                                <div>No student records found</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection