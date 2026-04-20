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
        Schema::create('tugas', function (Blueprint $table) { // Membuat tabel dengan nama 'tugas'
            $table->id(); // Membuat kolom 'id' sebagai primary key
            $table->foreignId('pembimbing_id')->constrained('users')->cascadeOnDelete(); // Menghubungkan ke tabel users (pembimbing)
            $table->foreignId('assigned_to')->constrained('users')->cascadeOnDelete(); // Menghubungkan ke tabel users (peserta)
            $table->string('judul'); // Membuat kolom 'judul' tugas
            $table->text('deskripsi')->nullable(); // Membuat kolom 'deskripsi', boleh kosong
            $table->date('deadline')->nullable(); // Membuat kolom 'deadline', boleh kosong
            $table->timestamps(); // Membuat kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};