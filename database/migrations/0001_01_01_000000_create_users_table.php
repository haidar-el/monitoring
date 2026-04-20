<?php // Tag pembuka wajib untuk menandakan ini adalah file berisi bahasa pemrograman PHP.

use Illuminate\Database\Migrations\Migration; // Mengimpor (memanggil) class dasar bernama Migration dari dalam mesin Laravel.
use Illuminate\Database\Schema\Blueprint; // Mengimpor class Blueprint yang bertugas sebagai "penggaris/cetak biru" untuk merancang kolom tabel.
use Illuminate\Support\Facades\Schema; // Mengimpor alat (Facade) bernama Schema yang bertugas mengeksekusi pembuatan atau penghapusan tabel di MySQL.

return new class extends Migration // Membuat sebuah "kelas tanpa nama" (anonymous class) yang mewarisi semua kemampuan dari class Migration di atas.
{ // Kurung kurawal pembuka penanda dimulainya isi dari class.

    public function up(): void // Fungsi 'up' ini adalah yang paling penting. Isinya akan dieksekusi HANYA KETIKA kita mengetik 'php artisan migrate'.
    { // Kurung kurawal pembuka untuk fungsi up.

        Schema::create('users', function (Blueprint $table) { // Perintah kepada sistem: "Tolong buatkan tabel bernama 'users' menggunakan cetak biru berikut:"
            $table->id(); // Membuat kolom 'id' sebagai Primary Key (angka unik yang bertambah otomatis 1, 2, 3...).
            $table->string('nama'); // Membuat kolom 'nama' bertipe string (teks pendek maksimal 255 karakter).
            $table->string('email')->unique(); // Membuat kolom 'email' bertipe teks, dan 'unique()' memastikan tidak boleh ada email yang kembar/sama mendaftar.
            $table->timestamp('email_verified_at')->nullable(); // Membuat kolom penanda waktu kapan email diverifikasi. 'nullable()' artinya boleh dibiarkan kosong.
            $table->string('password'); // Membuat kolom 'password' untuk menyimpan kata sandi yang wujudnya sudah diacak (hash).
            $table->enum('role', ['admin', 'pembimbing', 'peserta'])->default('peserta'); // Membuat kolom 'role' dengan 3 pilihan pasti. 'default' artinya jika saat mendaftar role tidak diisi, otomatis ia menjadi 'peserta'.

            // --- INI ADALAH BAGIAN YANG SEBELUMNYA BIKIN ERROR ---
            // Mengapa dipecah jadi 2 baris? Karena MySQL bingung jika disuruh merujuk ke tabel 'users' yang sedang dalam proses dibuat.
            $table->foreignId('pembimbing_id')->nullable(); // BARIS 1: Membuat wadah kolomnya dulu. Namanya 'pembimbing_id', boleh kosong.
            $table->foreign('pembimbing_id')->references('id')->on('users')->nullOnDelete(); // BARIS 2: Menjadikan kolom tadi sebagai 'Foreign Key' yang menumpang ke kolom 'id' di tabel 'users' ini sendiri. 'nullOnDelete' artinya jika akun pembimbing dihapus, kolom ini isinya jadi kosong (bukan error).
            // -----------------------------------------------------

            $table->string('nim')->nullable(); // Membuat kolom 'nim' untuk mahasiswa/siswa, boleh kosong untuk admin.
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(); // Membuat kolom jenis kelamin (Laki-laki/Perempuan), boleh kosong.
            $table->string('no_hp')->nullable(); // Membuat kolom nomor handphone, boleh kosong.
            $table->string('institusi')->nullable(); // Membuat kolom asal sekolah/kampus, boleh kosong.
            $table->string('jurusan')->nullable(); // Membuat kolom program studi/jurusan, boleh kosong.
            $table->enum('tingkat_pendidikan', ['D3', 'D4', 'S1'])->nullable(); // Membuat kolom strata pendidikan dengan 3 pilihan pasti, boleh kosong.
            $table->string('durasi_pkl')->nullable(); // Membuat kolom durasi magang (misal "3 Bulan"), boleh kosong.
            $table->date('tanggal_masuk')->nullable(); // Membuat kolom pencatat tanggal mulai magang dengan format YYYY-MM-DD, boleh kosong.
            $table->date('tanggal_keluar')->nullable(); // Membuat kolom pencatat tanggal selesai magang, boleh kosong.
            $table->rememberToken(); // Fitur bawaan Laravel: Membuat kolom khusus untuk menyimpan token jika user mencentang "Ingat Saya" saat login.
            $table->timestamps(); // Alat ajaib Laravel: Otomatis membuat 2 kolom ('created_at' dan 'updated_at') untuk merekam kapan data dibuat dan terakhir diedit.
        }); // Menutup rancangan tabel 'users'.

        // --- DUA TABEL DI BAWAH INI ADALAH BAWAAN WAJIB LARAVEL 11 ---
        Schema::create('password_reset_tokens', function (Blueprint $table) { // Membuat tabel untuk fitur "Lupa Password".
            $table->string('email')->primary(); // Menjadikan email sebagai identitas utama (Primary Key) di tabel ini.
            $table->string('token'); // Kolom untuk menyimpan link/kode rahasia reset password.
            $table->timestamp('created_at')->nullable(); // Mencatat kapan token tersebut dibuat (karena biasanya token punya batas waktu kedaluwarsa).
        }); // Menutup rancangan tabel token.

        Schema::create('sessions', function (Blueprint $table) { // Membuat tabel 'sessions' untuk mencatat siapa saja yang sedang login di sistem (pengganti file session biasa).
            $table->string('id')->primary(); // ID sesi unik dari browser pengguna.
            $table->foreignId('user_id')->nullable()->index(); // ID dari user yang sedang login. 'index()' digunakan agar proses pencarian data lebih cepat.
            $table->string('ip_address', 45)->nullable(); // Mencatat alamat IP internet pengguna.
            $table->text('user_agent')->nullable(); // Mencatat informasi perangkat (misal: Chrome di Windows 11).
            $table->longText('payload'); // Menyimpan data-data internal sesi tersebut.
            $table->integer('last_activity')->index(); // Mencatat detak waktu terakhir user mengklik sesuatu, agar sistem tahu kapan harus men-logout user secara otomatis (timeout).
        }); // Menutup rancangan tabel sesi.

    } // Menutup fungsi up.

    public function down(): void // Fungsi 'down' ini adalah kebalikan dari 'up'. Dieksekusi saat kita mengetik 'php artisan migrate:rollback' atau 'migrate:fresh'.
    { // Kurung kurawal pembuka untuk fungsi down.
        Schema::dropIfExists('users'); // Perintah: "Hancurkan tabel 'users' jika tabel itu memang ada."
        Schema::dropIfExists('password_reset_tokens'); // Hancurkan tabel token reset.
        Schema::dropIfExists('sessions'); // Hancurkan tabel sessions.
    } // Menutup fungsi down.

}; // Menutup class anonymous dan mengakhirinya dengan titik koma (wajib karena ini adalah instruksi 'return').