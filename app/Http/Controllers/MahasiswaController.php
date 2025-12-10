<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $mahasiswas = Mahasiswa::latest()->paginate(10);
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
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('mahasiswa', 'public');
            $validated['gambar'] = $path;
        }

        Mahasiswa::create($validated);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $this->ensureAdmin();
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->ensureAdmin();
        $validated = $request->validate([
            'nim' => 'required|string|max:50|unique:mahasiswas,nim,' . $mahasiswa->id,
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
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui');
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
