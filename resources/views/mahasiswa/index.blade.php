<x-layouts.app :title="'Daftar Mahasiswa'">
    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('mahasiswa.create') }}" class="btn">Tambah Mahasiswa</a>
        @endif
    @endauth
    <p style="color: var(--muted); margin: 8px 0 0;">Menampilkan 6 data per halaman.</p>
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
                        <img src="{{ asset('storage/'.$m->gambar) }}" alt="{{ $m->nama }}" width="80">
                    @else - @endif
                </td>
                <td class="table-actions">
                    <a href="{{ route('mahasiswa.show', $m) }}" class="btn secondary">Detail</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('mahasiswa.edit', $m) }}" class="btn">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $m) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn" onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        @endif
                    @endauth
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="pagination">
        @if($mahasiswas->previousPageUrl())
            <a href="{{ $mahasiswas->previousPageUrl() }}" class="btn secondary">Prev</a>
        @else
            <span class="btn secondary" style="opacity:0.5; pointer-events:none;">Prev</span>
        @endif
        <span style="align-self:center; color:var(--muted);">Halaman {{ $mahasiswas->currentPage() }} dari {{ $mahasiswas->lastPage() }}</span>
        @if($mahasiswas->nextPageUrl())
            <a href="{{ $mahasiswas->nextPageUrl() }}" class="btn">Next</a>
        @else
            <span class="btn" style="opacity:0.5; pointer-events:none;">Next</span>
        @endif
    </div>
</x-layouts.app>
