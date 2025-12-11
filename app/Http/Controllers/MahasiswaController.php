<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{

    private function ensureAdmin(): void
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    public function index()
    {
        if (Auth::user() && Auth::user()->role === 'mahasiswa') {
            $own = Mahasiswa::where('nim', Auth::user()->nim)->first();
            if (!$own) {
                return view('mahasiswa.mine_not_found');
            }
            return redirect()->route('mahasiswa.show', $own->id);
        }

        $mahasiswas = Mahasiswa::latest()->paginate(6);
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();
        $validated = $request->validate([
            'nim' => 'required|string|max:50|unique:mahasiswas,nim',
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            // optional account fields for user
            'user_email' => 'nullable|email|unique:users,email',
            'user_password' => 'nullable|string|min:6',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('mahasiswa', 'public');
            $validated['gambar'] = $path;
        }

        $m = Mahasiswa::create(collect($validated)->only(['nim','nama','prodi','alamat','gambar'])->toArray());

        // Create corresponding user account with defaults derived from NIM
        $email = $validated['user_email'] ?? ($validated['nim'] . '@sika.local');
        $passwordPlain = $validated['user_password'] ?? $validated['nim'];
        User::firstOrCreate(
            ['nim' => $validated['nim']],
            [
                'name' => $validated['nama'],
                'email' => $email,
                'password' => Hash::make($passwordPlain),
                'role' => 'mahasiswa',
            ]
        );

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa & akun berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        if (Auth::user() && Auth::user()->role === 'mahasiswa' && $mahasiswa->nim !== Auth::user()->nim) {
            abort(403, 'Unauthorized');
        }
        $user = User::where('nim', $mahasiswa->nim)->first();
        return view('mahasiswa.show', compact('mahasiswa', 'user'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $user = User::where('nim', $mahasiswa->nim)->first();

        // Admin dapat mengedit siapa saja
        if (Auth::user()->role === 'admin') {
            return view('mahasiswa.edit', compact('mahasiswa','user'));
        }

        // Mahasiswa hanya boleh mengedit datanya sendiri
        if (Auth::user()->role === 'mahasiswa') {
            if ($mahasiswa->nim !== Auth::user()->nim) {
                abort(403, 'Unauthorized');
            }
            return view('mahasiswa.edit', compact('mahasiswa','user'));
        }

        abort(403, 'Unauthorized');
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $isAdmin = Auth::user()->role === 'admin';
        $isOwnerStudent = Auth::user()->role === 'mahasiswa' && $mahasiswa->nim === Auth::user()->nim;

        if (!$isAdmin && !$isOwnerStudent) {
            abort(403, 'Unauthorized');
        }

        if ($isAdmin) {
            // existing user (by old NIM)
            $existingUser = User::where('nim', $mahasiswa->nim)->first();

            $validated = $request->validate([
                'nim' => 'required|string|max:50|unique:mahasiswas,nim,' . $mahasiswa->id,
                'nama' => 'required|string|max:255',
                'prodi' => 'required|string|max:255',
                'alamat' => 'required|string',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'user_email' => [
                    'nullable','email',
                    Rule::unique('users','email')->ignore($existingUser?->id),
                ],
                'user_password' => 'nullable|string|min:6',
            ]);

            if ($request->hasFile('gambar')) {
                if ($mahasiswa->gambar) {
                    Storage::disk('public')->delete($mahasiswa->gambar);
                }
                $path = $request->file('gambar')->store('mahasiswa', 'public');
                $validated['gambar'] = $path;
            }

            // Update Mahasiswa fields only
            $mahasiswa->update(collect($validated)->only(['nim','nama','prodi','alamat','gambar'])->toArray());

            // Sync user account
            $email = $validated['user_email'] ?? ($mahasiswa->nim . '@sika.local');
            $passwordPlain = $validated['user_password'] ?? null; // null means keep existing

            if ($existingUser) {
                $existingUser->name = $validated['nama'];
                $existingUser->email = $email;
                $existingUser->nim = $mahasiswa->nim;
                if ($passwordPlain) {
                    $existingUser->password = Hash::make($passwordPlain);
                }
                $existingUser->save();
            } else {
                User::create([
                    'name' => $validated['nama'],
                    'email' => $email,
                    'nim' => $mahasiswa->nim,
                    'password' => Hash::make($passwordPlain ?? $mahasiswa->nim),
                    'role' => 'mahasiswa',
                ]);
            }

            return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa & akun berhasil diperbarui');
        }

        // Student (owner) update: restricted fields, cannot change NIM or account
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'prodi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($mahasiswa->gambar) {
                Storage::disk('public')->delete($mahasiswa->gambar);
            }
            $path = $request->file('gambar')->store('mahasiswa', 'public');
            $validated['gambar'] = $path;
        }

        $mahasiswa->update($validated);
        return redirect()->route('mahasiswa.show', $mahasiswa)->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $this->ensureAdmin();
        if ($mahasiswa->gambar) {
            Storage::disk('public')->delete($mahasiswa->gambar);
        }
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa dihapus');
    }
}
