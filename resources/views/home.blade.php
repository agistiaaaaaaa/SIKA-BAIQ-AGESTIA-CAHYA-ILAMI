<x-layouts.app :title="'Beranda'">
    <div class="hero">
        <h2>Sika — Sistem Informasi Kemahasiswaan STMIK Lombok</h2>
        <p style="margin:0; color:#5c5c55;">Kelola data mahasiswa, akun terintegrasi, dan akses aman dengan warna identitas kampus kuning. Kampus berlokasi di Praya, Lombok Tengah.</p>
        <div style="margin-top:12px; display:flex; gap:8px;">
            @auth
                @if(auth()->user()->role==='admin')
                    <a class="btn" href="{{ route('mahasiswa.index') }}">Kelola Mahasiswa</a>
                    <a class="btn secondary" href="{{ route('mahasiswa.create') }}">Tambah Data</a>
                @elseif(auth()->user()->role==='mahasiswa')
                    <a class="btn" href="{{ route('mahasiswa.index') }}">Lihat Data Saya</a>
                @endif
            @else
                <a class="btn" href="{{ route('login') }}">Login</a>
                <span style="align-self:center; color:var(--muted);">Akun dibuat oleh admin</span>
            @endauth
        </div>
    </div>

    <div class="features">
        <div class="card">
            <h3>Manajemen Data</h3>
            <p>Data mahasiswa (NIM, nama, prodi, alamat, foto) tersusun rapi dan mudah dicari.</p>
        </div>
        <div class="card">
            <h3>Akun Terintegrasi</h3>
            <p>Akun otomatis dari NIM, dapat disesuaikan oleh admin, sinkron dengan biodata.</p>
        </div>
        <div class="card">
            <h3>Akses Aman</h3>
            <p>Admin mengelola penuh, mahasiswa hanya dapat mengubah data miliknya sendiri.</p>
        </div>
    </div>

        <div class="card">
            <h3>Identitas Warna STMIK Lombok</h3>
            <p>Antarmuka menggunakan tema kuning (<span style="color:var(--pri)">#FFC107</span>) sebagai warna utama, konsisten dengan identitas STMIK Lombok di Praya, Lombok Tengah.</p>
        </div>
</x-layouts.app>
