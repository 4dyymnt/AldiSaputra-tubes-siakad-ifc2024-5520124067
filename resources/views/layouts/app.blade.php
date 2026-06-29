<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - @yield('title', 'Sistem Informasi Akademik')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #1e40af;
            --primary-dark: #1e3a8a;
        }
        body { background: #f1f5f9; font-family: 'Segoe UI', sans-serif; }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform 0.3s;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }
        .sidebar-brand h5 { color: #fff; font-weight: 700; margin: 0; font-size: 1.1rem; }
        .sidebar-brand small { color: rgba(255,255,255,0.6); font-size: 0.75rem; }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.75);
            padding: 0.65rem 1.25rem;
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
        }
        .sidebar .nav-link i { width: 20px; }
        .sidebar-section {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.4);
            padding: 1rem 1.25rem 0.25rem;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .content-area { padding: 1.75rem; }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .card-header { background: #fff; border-bottom: 1px solid #f1f5f9; border-radius: 12px 12px 0 0 !important; padding: 1rem 1.25rem; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .badge-admin { background: #dc2626; }
        .badge-mhs { background: #059669; }
        .table th { font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; border-top: none; }
        .table td { vertical-align: middle; }
        .stat-card { border-radius: 12px; padding: 1.25rem; color: #fff; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--primary); color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.9rem; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <h5><i class="bi bi-mortarboard-fill me-2"></i>SIAKAD</h5>
            <small>Sistem Informasi Akademik</small>
        </div>
        <nav class="py-2">
            @if(auth()->user()->isAdmin())
                <div class="sidebar-section">Main</div>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <div class="sidebar-section">Manajemen Data</div>
                <a href="{{ route('dosen.index') }}" class="nav-link {{ request()->routeIs('dosen.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge me-2"></i> Dosen
                </a>
                <a href="{{ route('mahasiswa.index') }}" class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Mahasiswa
                </a>
                <a href="{{ route('matakuliah.index') }}" class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active' : '' }}">
                    <i class="bi bi-book me-2"></i> Mata Kuliah
                </a>
                <a href="{{ route('jadwal.index') }}" class="nav-link {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3 me-2"></i> Jadwal
                </a>
                <a href="{{ route('krs.admin') }}" class="nav-link {{ request()->routeIs('krs.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-check me-2"></i> KRS Mahasiswa
                </a>
            @else
                <div class="sidebar-section">Main</div>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
                <div class="sidebar-section">Akademik</div>
                <a href="{{ route('krs.index') }}" class="nav-link {{ request()->routeIs('krs.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-check me-2"></i> KRS Saya
                </a>
                <a href="{{ route('jadwal.mahasiswa') }}" class="nav-link {{ request()->routeIs('jadwal.mahasiswa') ? 'active' : '' }}">
                    <i class="bi bi-calendar3 me-2"></i> Jadwal Kuliah
                </a>
            @endif
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="topbar">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            <div class="d-flex align-items-center gap-2 ms-auto">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div style="font-size:0.85rem; font-weight:600; line-height:1.2">{{ auth()->user()->name }}</div>
                    <span class="badge {{ auth()->user()->isAdmin() ? 'badge-admin' : 'badge-mhs' }}" style="font-size:0.65rem;">
                        {{ ucfirst(auth()->user()->role) }}
                    </span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="ms-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
