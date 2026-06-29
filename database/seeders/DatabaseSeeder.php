<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@siakad.ac.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Dosen
        $dosen = [
            ['nidn' => '0101010101', 'nama' => 'Dr. Budi Santoso'],
            ['nidn' => '0202020202', 'nama' => 'Dr. Siti Rahayu'],
            ['nidn' => '0303030303', 'nama' => 'Prof. Ahmad Fauzi'],
        ];
        foreach ($dosen as $d) {
            Dosen::create($d);
        }

        // Mahasiswa
        $mahasiswas = [
            ['npm' => '1234567890', 'nama' => 'Aldi Saputra'],
            ['npm' => '1234567891', 'nama' => 'Bela Sari'],
            ['npm' => '1234567892', 'nama' => 'Candra Wijaya'],
        ];
        foreach ($mahasiswas as $m) {
            Mahasiswa::create($m);
            User::create([
                'name'     => $m['nama'],
                'email'    => strtolower(str_replace(' ', '.', $m['nama'])) . '@mahasiswa.ac.id',
                'password' => Hash::make('password'),
                'role'     => 'mahasiswa',
                'npm'      => $m['npm'],
            ]);
        }

        // Mata Kuliah
        $matkul = [
            ['kode_matakuliah' => 'IF001001', 'nama_matakuliah' => 'Pemrograman Web I', 'sks' => 3],
            ['kode_matakuliah' => 'IF001002', 'nama_matakuliah' => 'Pemrograman Web II', 'sks' => 3],
            ['kode_matakuliah' => 'IF001003', 'nama_matakuliah' => 'Basis Data', 'sks' => 3],
            ['kode_matakuliah' => 'IF001004', 'nama_matakuliah' => 'Algoritma & Pemrograman', 'sks' => 4],
            ['kode_matakuliah' => 'IF001005', 'nama_matakuliah' => 'Jaringan Komputer', 'sks' => 3],
        ];
        foreach ($matkul as $mk) {
            Matakuliah::create($mk);
        }

        // Jadwal
        Jadwal::create([
            'kode_matakuliah' => 'IF001001',
            'nidn'            => '0101010101',
            'kelas'           => 'A',
            'hari'            => 'Senin',
            'jam'             => '08:00:00',
        ]);
        Jadwal::create([
            'kode_matakuliah' => 'IF001002',
            'nidn'            => '0202020202',
            'kelas'           => 'B',
            'hari'            => 'Selasa',
            'jam'             => '10:00:00',
        ]);
        Jadwal::create([
            'kode_matakuliah' => 'IF001003',
            'nidn'            => '0303030303',
            'kelas'           => 'A',
            'hari'            => 'Rabu',
            'jam'             => '13:00:00',
        ]);
    }
}
