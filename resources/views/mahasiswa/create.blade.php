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
        <hr style="margin:16px 0; border:none; border-top:1px solid #e5e7eb;">
        <p style="color:#6b7280; margin:0 0 8px;">Akun Mahasiswa (dibuat otomatis). Default email/password diisi dari NIM dan bisa diubah.</p>
        <label>Email Akun
            <input type="email" name="user_email" id="user_email" value="{{ old('user_email', old('nim') ? (old('nim').'@sika.local') : '') }}" placeholder="contoh: TI121212@sika.local">
        </label>
        <label>Password Akun
            <input type="text" name="user_password" id="user_password" value="{{ old('user_password') }}" placeholder="default: NIM">
        </label>
        <script>
            (function(){
                const nim = document.querySelector('input[name=nim]');
                const email = document.getElementById('user_email');
                const pass = document.getElementById('user_password');
                function applyDefaults(){
                    if(nim && nim.value){
                        if(!email.value){ email.value = nim.value + '@sika.local'; }
                        if(!pass.value){ pass.value = nim.value; }
                    }
                }
                nim && nim.addEventListener('input', applyDefaults);
                document.addEventListener('DOMContentLoaded', applyDefaults);
            })();
        </script>
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
