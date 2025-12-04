<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sika' }}</title>
    <style>
        :root {
            --pri: #0f766e; /* teal-700 */
            --pri-hover: #115e59; /* teal-800 */
            --text: #1b1b18;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg: #fafafa;
        }
        * { box-sizing: border-box; }
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 0; color: var(--text); background: var(--bg); }
        header { background: white; border-bottom: 1px solid var(--border); }
        .nav { max-width: 980px; margin: 0 auto; padding: 14px 16px; display: flex; align-items: center; justify-content: space-between; }
        .brand { font-weight: 700; color: var(--pri); }
        .nav a { color: var(--text); text-decoration: none; margin-right: 12px; }
        .container { max-width: 900px; margin: 0 auto; padding: 20px 16px; }
        .flash { padding: 10px; margin-bottom: 16px; background: #e8ffe8; border: 1px solid #a7e3a7; border-radius: 6px; }
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
    </style>
</head>
<body>
<header>
    <div class="nav">
        <div class="brand">Sika</div>
        <nav>
            <a href="{{ url('/') }}">Beranda</a>
            <a href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
            <a href="{{ route('mahasiswa.create') }}" class="btn" style="margin-left:6px;">Tambah</a>
        </nav>
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
</body>
</html>