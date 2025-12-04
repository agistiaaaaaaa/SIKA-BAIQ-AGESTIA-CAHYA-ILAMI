<x-layouts.app :title="'Daftar Mahasiswa'">
    <a href="{{ route('mahasiswa.create') }}" class="btn">Tambah Mahasiswa</a>
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Alamat</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($mahasiswas as $m)
            <tr>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->prodi }}</td>
                <td>{{ $m->alamat }}</td>
                <td>
                    @if($m->gambar)
                        <img src="{{ asset('storage/'.$m->gambar) }}" alt="{{ $m->nama }}" width="120">
                    @else - @endif
                </td>
                <td class="table-actions">
                    <a href="{{ route('mahasiswa.show', $m) }}" class="btn secondary">Detail</a>
                    <a href="{{ route('mahasiswa.edit', $m) }}" class="btn">Edit</a>
                    <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
    {{ $mahasiswas->links() }}
</x-layouts.app>