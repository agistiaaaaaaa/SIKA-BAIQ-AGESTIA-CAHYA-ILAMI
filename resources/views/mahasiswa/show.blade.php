<x-layouts.app :title="'Detail Mahasiswa'">
    <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
    <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
    <p><strong>Prodi:</strong> {{ $mahasiswa->prodi }}</p>
    <p><strong>Alamat:</strong> {{ $mahasiswa->alamat }}</p>
    @if(isset($user))
        <p><strong>Email Akun:</strong> {{ $user->email }}</p>
        <p style="color:#6b7280; margin-top:-6px;">Password default: NIM (dapat diubah oleh admin)</p>
    @endif
    @if($mahasiswa->gambar)
        <img src="{{ asset('storage/'.$mahasiswa->gambar) }}" alt="{{ $mahasiswa->nama }}" width="300">
    @endif
    <p>
        <a href="{{ route('mahasiswa.index') }}" class="btn secondary">Kembali</a>
        @auth
            @if(auth()->user()->role==='admin' || (auth()->user()->role==='mahasiswa' && auth()->user()->nim===$mahasiswa->nim))
                <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn">Edit</a>
            @endif
        @endauth
    </p>
</x-layouts.app>
