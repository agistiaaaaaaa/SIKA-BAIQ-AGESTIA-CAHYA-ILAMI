<x-layouts.app :title="'Tambah Mahasiswa'">
    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>NIM
            <input type="text" name="nim" value="{{ old('nim') }}">
        </label>
        <label>Nama
            <input type="text" name="nama" value="{{ old('nama') }}">
        </label>
        <label>Prodi
            <select name="prodi">
                @php($prodis = ['Teknik Informatika','Sistem Informasi','Teknik Komputer','Ilmu Komputer'])
                @foreach($prodis as $p)
                    <option value="{{ $p }}" @selected(old('prodi')===$p)>{{ $p }}</option>
                @endforeach
            </select>
        </label>
        <label>Alamat
            <textarea name="alamat">{{ old('alamat') }}</textarea>
        </label>
        <label>Gambar
            <input type="file" name="gambar" accept="image/*">
        </label>
        <div style="display:flex; gap:8px; align-items:center; margin-top:10px;">
            <button class="btn" type="submit">Kirim</button>
            <a href="{{ route('mahasiswa.index') }}" class="btn secondary">Batal</a>
        </div>
    </form>
    @if ($errors->any())
        <div style="color:crimson; margin-top:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-layouts.app>