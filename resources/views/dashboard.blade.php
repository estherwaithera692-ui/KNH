<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>User Dashboard - Registration System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background: linear-gradient(135deg,#eef2ff 0,#e6f4ff 100%); min-height:100vh; }
        .avatar {
            width:64px; height:64px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center;
            color:#fff; font-weight:700; font-size:1.25rem;
            background: linear-gradient(45deg,#4f46e5,#06b6d4);
        }
        .card-ghost { background:rgba(255,255,255,0.95); box-shadow:0 8px 30px rgba(2,6,23,0.07); }
        @media (max-width:575.98px){ .header-actions { flex-direction:column; gap:.5rem; } }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="card card-ghost mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center gap-3">
                    <div class="avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="mb-0">{{ Auth::user()->name ?? 'User' }}</h3>
                        <small class="text-muted">Welcome back — here's your dashboard</small>
                    </div>
                    @if(Auth::user()->usertype && Auth::user()->usertype->name === 'Admin')
                        <span class="badge bg-danger ms-3">ADMIN</span>
                    @endif
                </div>

                <div class="d-flex header-actions align-items-center gap-2">
                    <a href="{{ route('biodataCollect') }}" class="btn btn-success"> 
                        {{ Auth::user()->bioData ? 'Update Bio Data' : 'Submit Bio Data' }}
                    </a>
                    <a href="{{ url('/profile') }}" class="btn btn-outline-primary">Edit Profile</a>
                    @if(Auth::user()->usertype && Auth::user()->usertype->name === 'Admin')
                        <a href="{{ route('admin.bioData.index') }}" class="btn btn-danger">Admin Panel</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Bootstrap JS (bundle includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
