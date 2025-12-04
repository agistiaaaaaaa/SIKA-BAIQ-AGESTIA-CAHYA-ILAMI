<x-layouts.app :title="'Detail Mahasiswa'">
    <p><strong>NIM:</strong> {{ $mahasiswa->nim }}</p>
    <p><strong>Nama:</strong> {{ $mahasiswa->nama }}</p>
    <p><strong>Prodi:</strong> {{ $mahasiswa->prodi }}</p>
    <p><strong>Alamat:</strong> {{ $mahasiswa->alamat }}</p>
    @if($mahasiswa->gambar)
        <img src="{{ asset('storage/'.$mahasiswa->gambar) }}" alt="{{ $mahasiswa->nama }}" width="300">
    @endif
    <p>
        <a href="{{ route('mahasiswa.index') }}" class="btn secondary">Kembali</a>
        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="btn">Edit</a>
    </p>
</x-layouts.app>