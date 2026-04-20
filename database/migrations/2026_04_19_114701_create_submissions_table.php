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
        Schema::create('submissions', function (Blueprint $table) { // Membuat tabel dengan nama 'submissions'
            $table->id(); // Membuat kolom 'id' sebagai primary key
            $table->foreignId('tugas_id')->constrained('tugas')->cascadeOnDelete(); // Menghubungkan pengumpulan ini ke ID tugas yang mana
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // Menghubungkan pengumpulan ini ke ID user (peserta) yang mengumpulkan
            $table->string('file_path'); // Membuat kolom 'file_path' untuk menyimpan lokasi file di dalam folder server
            $table->string('file_name'); // Membuat kolom 'file_name' untuk menyimpan nama asli file yang diupload peserta
            $table->integer('nilai')->nullable(); // Membuat kolom 'nilai' berupa angka bulat (integer), boleh kosong jika pembimbing belum menilai
            $table->text('komentar')->nullable(); // Membuat kolom 'komentar' untuk catatan revisi dari pembimbing, boleh kosong
            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at'
            $table->unique(['tugas_id', 'user_id']); // Mencegah 1 user mengumpulkan tugas lebih dari 1 kali pada tugas yang sama
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
