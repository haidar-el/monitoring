<?php // Ini adalah tag pembuka wajib untuk memberi tahu server bahwa ini adalah kode PHP.

namespace Database\Seeders; // Memberitahu Laravel lokasi/alamat "kamar" dari file ini (ada di folder Database/Seeders).

use App\Models\User; // Memanggil (import) "Otak" atau Model dari tabel 'users' agar kita bisa memasukkan data ke tabel tersebut.
use Illuminate\Database\Seeder; // Memanggil fitur bawaan Laravel yang khusus bertugas untuk menyuntikkan (seed) data awal.
use Illuminate\Support\Facades\Hash; // Memanggil alat keamanan dari Laravel untuk mengacak (encrypt/hash) password.

class DatabaseSeeder extends Seeder // Membuat wadah (class) bernama 'DatabaseSeeder' yang mewarisi semua kemampuan dari 'Seeder' Laravel.
{ // Kurung kurawal pembuka penanda dimulainya isi dari class.

    public function run(): void // Ini adalah fungsi utama. Semua perintah di dalam sini akan otomatis dieksekusi saat kita memanggil seeder di terminal.
    { // Kurung kurawal pembuka untuk fungsi run.

        User::create([ // Perintah Eloquent ke database: "Tolong buatkan satu baris data baru di tabel users dengan data di bawah ini:"
            'nama' => 'Muhammad Haidar Adz Dzakwan', // Mengisi kolom 'nama' di database dengan nama Anda.
            'email' => 'admin@simonti.id', // Mengisi kolom 'email' yang akan digunakan untuk proses login nanti.
            'password' => Hash::make('password'), // Mengubah teks 'password' menjadi kode acak yang tidak bisa dibaca hacker sebelum disimpan.
            'role' => 'admin', // Menetapkan hak akses akun ini sebagai 'admin'.
        ]); // Kurung siku dan biasa penutup perintah create, WAJIB diakhiri dengan titik koma (;) di PHP.

    } // Kurung kurawal penutup untuk fungsi run.
} // Kurung kurawal penutup untuk class DatabaseSeeder.