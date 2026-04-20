<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
    {
        // Pastikan nama tabelnya kita paksa jadi 'absensi' (bukan 'absensis')
        Schema::create('absensi', function (Blueprint $table) { // Membuat tabel dengan nama 'absensi'
            $table->id(); // Membuat kolom 'id' sebagai primary key
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Menghubungkan absen ini dengan id di tabel users. Jika user dihapus, absennya ikut terhapus (cascade)
            $table->date('tanggal'); // Membuat kolom 'tanggal' berformat YYYY-MM-DD untuk mencatat hari absen
            $table->dateTime('clock_in')->nullable(); // Membuat kolom 'clock_in' dengan format waktu lengkap, boleh kosong (belum absen masuk)
            $table->dateTime('clock_out')->nullable(); // Membuat kolom 'clock_out' dengan format waktu lengkap, boleh kosong (belum absen pulang)
            $table->text('catatan_kegiatan')->nullable(); // Membuat kolom 'catatan_kegiatan' bertipe teks panjang, boleh kosong
            $table->enum('status', ['hadir', 'sakit', 'izin', 'alfa'])->default('alfa'); // Membuat kolom 'status', otomatis terisi 'hadir' jika tidak ditentukan
            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at'
            $table->unique(['user_id', 'tanggal']); // Mencegah 1 user melakukan lebih dari 1 kali absen di tanggal yang sama persis
        });
    

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
