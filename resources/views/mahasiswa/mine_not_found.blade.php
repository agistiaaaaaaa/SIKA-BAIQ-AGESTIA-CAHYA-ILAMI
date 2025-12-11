<x-layouts.app :title="'Data Mahasiswa Anda'">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">Data Mahasiswa Tidak Ditemukan</div>
                    <div class="card-body">
                        <p class="mb-3">Akun Anda terdaftar sebagai <strong>mahasiswa</strong>, namun kami tidak menemukan data mahasiswa yang terhubung dengan NIM Anda.</p>
                        <ul>
                            <li>Jika Anda mendaftar sendiri, pastikan NIM yang dimasukkan sesuai dan sudah terdata di sistem.</li>
                            <li>Jika data dibuatkan oleh admin, minta admin untuk mengisikan atau mencocokkan NIM di akun Anda.</li>
                        </ul>
                        <p class="mt-3">Silakan hubungi admin untuk bantuan lebih lanjut.</p>
                        <a href="{{ route('logout') }}" class="btn btn-outline-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

