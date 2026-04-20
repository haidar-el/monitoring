<?php

namespace App\Http\Controllers; //Menentukan lokasi folder file ini

use App\Http\Controllers\Controller; //mengambil dasar fungsi controller laravel
use illuminate\Http\Request;//memanggil alaat untuk menangkap data dari form (email&paswword).
use illuminate\Support\Facades\Auth;//memanggil fitur keamanan laravel untuk cek akun

class LoginController
{
    public function showLoginForm()//fungsi untuk menampilkan halaman muka login
    {
        if (auth::check()){ //jika pengguna ternyata sudah login sebelumnya....
            return $this->redirectByRole(Auth::user()->role);//....langsung lempar ke dashboard masing-masing
        }
            return view ('auth.login'); //jika belum login, tampilan file desain login.blade.php
    }
    public function login(request $request)//fungsi untuk memproses data saat tombol "Login" diklik
    {
        $scredentials = $request->validate([ //tahap validasi pastikan form tidak kosong
            'email'=>['required','email'], //email wajib diisi dan harus format yang benar
            'password'=> ['required'],//pasword wajib diisi
        ]);
        $remember=$request->has('remember');//mengecek apakah user mencentang "ingat saya"
        if (auth::attempt($scredentials, $remember)) {//mencocokkan email dan password ke database
            $request->session()->regenerate();//membuat ID sesi baru agar aman dari peretasan sesi
            return$this->redirectByRole(auth::user()->Role);//jika cocok, lempar ke dashboard sesuai role
        }

        return back()->withErrors([//jika email/password salah...
            'email'=> 'Email atau password tidak sesuai dengan data kami.',//kembalikan ke form dengan pesan error
        ])->onlyInput('email');//tetap tampilkan email yang tadi diketik agar user tidak perlu ketik ulang
    }

    public function logout(Request $request)//Fungsi unutuk keluar dari sistem
    {
        Auth::logout();//menghapus status login pengguna
        $request->session()->invalidate();//membuat token keamanan baru agar tidak bisa dipakai ulang
        return redirect('/login');//arahkan kembali ke halaman login
    }

    private function redirectByRole($role)// Fungsi cerdas untuk menentukan arah ja;an berdasarkan role
    {
        if ($role ==='admin') return redirect()->route('admin.dashboard');//jika admin, ke dashboard admin
        if ($role==='pembimbing') return redirect()->route('pembimbing.dashboard');//jika pembimbing, ke zonanya
        if ($role==='peserta')return redirect()->route('peserta.dashboard');//selain itu(peserta), ke dashboard peserta
    }
}