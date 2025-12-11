<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sika' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/css/sb-admin-2.min.css" rel="stylesheet" />
    <style>
        :root {
            /* STMIK Lombok Yellow theme (Praya, Lombok Tengah) */
            --pri: #FFC107; /* aiut yellow */
            --pri-hover: #E0A800; /* darken yellow */
            --text: #1b1b18;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg: #fffef8; /* subtle warm background */
            --hero-soft: #FFF3CD; /* soft yellow */
            --hero-border: #FCE68A;
        }
        * { box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 0; color: var(--text); background: var(--bg); }
        header { background: white; border-bottom: 1px solid var(--border); }
        .nav { max-width: 980px; margin: 0 auto; padding: 14px 16px; display: flex; align-items: center; justify-content: space-between; }
        .brand { font-weight: 700; color: var(--pri); }
        .nav a { color: var(--text); text-decoration: none; margin-right: 12px; }
        .container { max-width: 900px; margin: 0 auto; padding: 20px 16px; }
        .flash { padding: 10px; margin-bottom: 16px; background: var(--hero-soft); border: 1px solid var(--hero-border); border-radius: 6px; }
        label { display: block; font-size: 14px; margin-top: 8px; color: var(--muted); }
        input[type=text], select, textarea, input[type=file] { width: 100%; padding: 10px; font-size: 16px; border: 1px solid var(--border); border-radius: 6px; margin-top: 6px; background: white; }
        textarea { min-height: 100px; }
        .btn { display: inline-block; background: var(--pri); color: white; border: none; border-radius: 6px; padding: 8px 14px; font-size: 15px; cursor: pointer; text-decoration: none; }
        .btn:hover { background: var(--pri-hover); }
        .btn.secondary { background: #374151; }
        .btn.secondary:hover { background: #1f2937; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; background: white; }
        thead th { font-weight: 600; font-size: 14px; color: var(--muted); }
        th, td { border-bottom: 1px solid var(--border); padding: 10px; text-align: left; }
        .table-actions { display: flex; gap: 8px; align-items: center; }
        img { max-width: 100%; height: auto; border-radius: 6px; }
        .pagination { display: flex; gap: 8px; margin-top: 14px; }
        .pagination nav { display: inline-flex; gap: 8px; }
        /* home hero */
        .hero { background: linear-gradient(90deg, #FFF9DB, #FFE082); border: 1px solid var(--hero-border); padding: 18px; border-radius: 10px; }
        .hero h2 { margin: 0 0 6px; color: var(--pri-hover); }
        .features { display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-top: 16px; }
        .card { background: white; border: 1px solid var(--border); border-radius: 10px; padding: 14px; }
        .card h3 { margin: 0 0 6px; font-size: 16px; color: var(--pri-hover); }
    </style>
</head>
<body>
<header>
    <div class="nav">
        <div class="brand">Sika</div>
        <nav>
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('mahasiswa.create') }}" class="btn" style="margin-left:6px;">Tambah</a>
                @endif
            @endauth
        </nav>
        <div>
            @auth
                <span style="margin-right:10px;">{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button class="btn secondary" type="submit">Logout</button>
                </form>
            @else
                <a class="btn secondary" href="{{ route('login') }}">Login</a>
                <span style="margin-left:8px; color: var(--muted);">Akun mahasiswa dibuat oleh admin</span>
            @endauth
        </div>
    </div>
</header>

<div class="container">
    <h1 style="margin: 0 0 8px;">{{ $title ?? 'Biodata Mahasiswa' }}</h1>
    <p style="color: var(--muted); margin: 0 0 12px;">Manajemen data mahasiswa sederhana.</p>
    @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif
    {{ $slot }}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/startbootstrap-sb-admin-2@4.1.4/js/sb-admin-2.min.js"></script>
</body>
</html>
