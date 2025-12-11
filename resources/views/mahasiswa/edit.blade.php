<x-layouts.app :title="'Edit Mahasiswa'">
    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label>NIM
            <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" @auth @if(auth()->user()->role!=='admin') readonly @endif @endauth>
            @auth
                @if(auth()->user()->role!=='admin')
                    <small style="color:#6b7280; display:block;">Mahasiswa tidak dapat mengubah NIM.</small>
                @endif
            @endauth
        </label>
        <label>Nama
            <input type="text" name="nama" value="{{ old('nama', $mahasiswa->nama) }}">
        </label>
        <label>Prodi
            <select name="prodi">
                @php($prodis = ['Teknik Informatika','Sistem Informasi','Teknik Komputer','Ilmu Komputer'])
                @foreach($prodis as $p)
                    <option value="{{ $p }}" @selected(old('prodi', $mahasiswa->prodi)===$p)>{{ $p }}</option>
                @endforeach
            </select>
        </label>
        <label>Alamat
            <textarea name="alamat">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
        </label>
        <label>Gambar
            <input type="file" name="gambar" accept="image/*">
            @if($mahasiswa->gambar)
                <div style="margin-top:6px"><img src="{{ asset('storage/'.$mahasiswa->gambar) }}" width="150"></div>
            @endif
        </label>
        @auth
            @if(auth()->user()->role==='admin')
                <hr style="margin:16px 0; border:none; border-top:1px solid #e5e7eb;">
                <p style="color:#6b7280; margin:0 0 8px;">Akun Mahasiswa terkait. Email/password default dari NIM. Kosongkan password jika tidak ingin mengubah.</p>
                <label>Email Akun
                    <input type="email" name="user_email" id="user_email" value="{{ old('user_email', $user->email ?? ($mahasiswa->nim.'@sika.local')) }}" placeholder="contoh: TI121212@sika.local">
                </label>
                <label>Password Akun
                    <input type="text" name="user_password" id="user_password" value="{{ old('user_password') }}" placeholder="kosongkan untuk tidak mengubah">
                </label>
            @endif
        @endauth
        <div style="display:flex; gap:8px; align-items:center; margin-top:10px;">
            <button class="btn" type="submit">Simpan</button>
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
