<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Talent Management')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            overflow-x: hidden;
            background: #f8fafc;
        }

        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background: #1f2937;
            padding: 15px;
            overflow-y: auto;
        }

        .brand {
            color: #fff;
            font-weight: bold;
            text-align: center;
            padding: 10px 0;
            font-size: 20px;
        }

        .sidebar hr {
            color: rgba(255,255,255,.15);
        }

        .user-info {
            text-align: center;
            padding: 15px 10px;
        }

        .user-info img {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            border: 3px solid rgba(255,255,255,.2);
            margin-bottom: 10px;
        }

        .user-info h6 {
            color: #fff;
            margin-bottom: 2px;
            font-weight: 600;
        }

        .user-info small {
            color: #cbd5e1;
            display: block;
            font-size: 12px;
        }

        .user-info .badge {
            margin-top: 8px;
            font-size: 11px;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 10px 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            margin-bottom: 3px;
            transition: .2s;
        }

        .sidebar .nav-link:hover {
            background: #374151;
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #fff;
        }

        .section-title {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 18px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .content {
            margin-left: 260px;
            padding: 25px;
        }

        .logout-btn {
            color: #dc3545 !important;
        }

        .logout-btn:hover {
            background: rgba(220,53,69,.15) !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    
    <!-- SIDEBAR -->
    <div class="sidebar">
        
        <!-- LOGO -->
        <div class="brand">
            Talent Management
        </div>

        <hr>

        <!-- USER LOGIN -->
        <div class="user-info">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama) }}&background=2563eb&color=ffffff" alt="Avatar">
            <h6>{{ Auth::user()->nama }}</h6>
            <small>NIP : {{ Auth::user()->nip }}</small>
            <span class="badge bg-primary">
                {{ strtoupper(Auth::user()->role) }}
            </span>
            @if(Auth::user()->jabatan)
                <small class="mt-2">
                    <i class="bi bi-briefcase-fill"></i>
                    {{ Auth::user()->jabatan }}
                </small>
            @endif

            @if(Auth::user()->unit_kerja)
                <small>
                    <i class="bi bi-building"></i>
                    {{ Auth::user()->unit_kerja }}
                </small>
            @endif
        </div>

        <hr>

        <a href="/talent/matrix" class="nav-link">
            <i class="bi bi-grid-3x3-gap"></i>
            9 Box Matrix
        </a>

        @if(Auth::user()->role == "ADMIN")
            <a href="/pegawai" class="nav-link">
                <i class="bi bi-people"></i>
                Data Pegawai
            </a>
        @endif

        <div class="section-title">
            Sumbu Y (Kinerja)
        </div>

        <a href="/predikat" class="nav-link">
            <i class="bi bi-star"></i>
            Predikat Kinerja
        </a>

        <a href="/penghargaan" class="nav-link">
            <i class="bi bi-trophy"></i>
            Penghargaan
        </a>

        <a href="/penugasan" class="nav-link">
            <i class="bi bi-diagram-3"></i>
            Penugasan Tim
        </a>

        <div class="section-title">
            Sumbu X (Potensial)
        </div>

        <a href="/pendidikan" class="nav-link">
            <i class="bi bi-mortarboard"></i>
            Pendidikan Formal
        </a>

        <a href="/kompetensi" class="nav-link">
            <i class="bi bi-journal-bookmark"></i>
            Pengembangan Kompetensi
        </a>

        <a href="{{ route('riwayat-jabatan.index') }}" class="nav-link">
            <i class="bi bi-briefcase"></i>
            Riwayat Jabatan
        </a>

        <a href="/organisasi" class="nav-link">
            <i class="bi bi-people-fill"></i>
            Organisasi
        </a>

        <a href="/hukuman" class="nav-link">
            <i class="bi bi-exclamation-triangle"></i>
            Hukuman Disiplin
        </a>

        <hr>

        @if(Auth::user()->role == "ADMIN")
            <a href="/talent-weight" class="nav-link">
                <i class="bi bi-gear"></i>
                Pengaturan Bobot
            </a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="mt-2">
            @csrf

            <button type="submit"
                class="nav-link logout-btn border-0 bg-transparent w-100 text-start">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </form>

    </div>

    <!-- CONTENT -->
    <div class="content">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </div>

</body>

</html>