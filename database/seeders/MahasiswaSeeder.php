<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nim'=>'TI121212','nama'=>'Gunawan','prodi'=>'Sistem Informasi','alamat'=>'Mataram','gambar'=>null],
            ['nim'=>'TI121213','nama'=>'Putri','prodi'=>'Teknik Informatika','alamat'=>'Denpasar','gambar'=>null],
            ['nim'=>'TI121214','nama'=>'Budi','prodi'=>'Teknik Komputer','alamat'=>'Surabaya','gambar'=>null],
            ['nim'=>'TI121215','nama'=>'Sari','prodi'=>'Ilmu Komputer','alamat'=>'Bandung','gambar'=>null],
            ['nim'=>'TI121216','nama'=>'Andi','prodi'=>'Sistem Informasi','alamat'=>'Jakarta','gambar'=>null],
            ['nim'=>'TI121217','nama'=>'Dewi','prodi'=>'Teknik Informatika','alamat'=>'Bogor','gambar'=>null],
            ['nim'=>'TI121218','nama'=>'Rizky','prodi'=>'Teknik Komputer','alamat'=>'Yogyakarta','gambar'=>null],
            ['nim'=>'TI121219','nama'=>'Rina','prodi'=>'Ilmu Komputer','alamat'=>'Semarang','gambar'=>null],
            ['nim'=>'TI121220','nama'=>'Adi','prodi'=>'Sistem Informasi','alamat'=>'Malang','gambar'=>null],
            ['nim'=>'TI121221','nama'=>'Nina','prodi'=>'Teknik Informatika','alamat'=>'Makassar','gambar'=>null],
        ];

        foreach ($data as $d) {
            Mahasiswa::firstOrCreate(['nim' => $d['nim']], $d);
        }
    }
}