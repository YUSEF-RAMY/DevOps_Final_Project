@extends('admin.layouts.app')

@section('title', 'Login Activity')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-person-lines-fill me-2"></i>Login Activity</h3>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive">
            <table id="sessionsTable" class="table table-striped align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>IP</th>
                        <th>User Agent</th>
                        <th>Last Activity</th>
                        <th>Session</th>
                        <th style="width:100px">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white border-bottom">
        <h3 class="card-title mb-0 fw-semibold"><i class="bi bi-x-circle me-2"></i>Destroy User Sessions</h3>
    </div>
    <div class="card-body p-3">
        <form class="row g-3 align-items-end" action="{{ route('admin.activities.sessions.destroy-user', 0) }}" method="post" onsubmit="return confirm('Destroy all sessions for this user?')" id="destroyUserSessionsForm">
            @csrf
            @method('DELETE')
            <div class="col-md-4">
                <label class="form-label">User ID</label>
                <input type="number" min="1" class="form-control filter-input" id="dus_user_id" placeholder="Enter user ID">
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-outline-danger" onclick="__destroyUserSessions()">
                    <i class="bi bi-x-circle me-1"></i>Destroy All Sessions
                </button>
            </div>
        </form>
        <script>
            function __destroyUserSessions(){
                const form = document.getElementById('destroyUserSessionsForm');
                const uid = document.getElementById('dus_user_id').value;
                if(!uid) return;
                form.action = form.action.replace(/\d+$/, String(uid));
                form.submit();
            }
        </script>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    initDataTableWithExport('#sessionsTable', {
        processing: true,
        serverSide: true,
        ajax: { url: '{{ route('admin.datatables', 'sessions') }}' },
        columns: [
            { data: 'user', name: 'user', orderable: true, searchable: false },
            { data: 'email', name: 'email', orderable: true, searchable: false },
            { data: 'phone', name: 'phone', orderable: true, searchable: false },
            { data: 'ip_address', name: 'ip_address', orderable: true, searchable: false },
            { data: 'user_agent', name: 'user_agent', orderable: true, searchable: false },
            { data: 'last_activity', name: 'last_activity', orderable: true, searchable: false },
            { data: 'id', name: 'id', orderable: true, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false, className: 'text-end', exportable: false },
        ],
        order: [[5, 'desc']],
    }, 'Login_Activity');
});
</script>
@endpush
@endsection


