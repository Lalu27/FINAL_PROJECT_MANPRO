@extends('layouts.app')

@section('title', 'Daftar StayFind - Temukan Kos Impianmu')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<style>
    body { font-family: 'Inter', sans-serif; background-color: #f8f9ff; }
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
</style>

<!-- 🌟 PERBAIKAN: Menggunakan class warna universal standar Tailwind agar tidak crash dengan layout induk -->
<div class="bg-[#f8f9ff] text-gray-900 min-h-screen flex flex-col">
    <main class="flex-grow flex items-center justify-center pt-12 pb-12 px-4">
        <div class="w-full max-w-[1100px] grid md:grid-cols-2 bg-white rounded-lg overflow-hidden shadow-[0px_10px_30px_rgba(15,23,42,0.1)]">
            
            <!-- Left Side: Visual Context -->
            <div class="hidden md:block relative overflow-hidden bg-blue-50">
                <div class="absolute inset-0 opacity-40">
                    <img class="w-full h-full object-cover" alt="StayFind Dormitory View" src="https://images.unsplash.com/photo-1554995207-c18c203602cb?auto=format&fit=crop&w=800&q=80"/>
                </div>
                <div class="relative z-10 p-12 flex flex-col justify-end h-full text-blue-900">
                    <h2 class="text-3xl font-bold leading-tight">Temukan hunian terbaik untuk masa depanmu.</h2>
                    <p class="text-sm opacity-90 max-w-md mt-2">Gabung bersama ribuan mahasiswa dan pemilik kost di platform pencarian hunian paling terpercaya di Indonesia.</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-blue-100 via-transparent to-transparent"></div>
            </div>

            <!-- Right Side: Registration Form -->
            <div class="flex flex-col justify-center bg-white p-8 md:p-12">
                <div class="mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h3>
                    <p class="text-sm text-gray-500 mt-1">Mulai perjalanan mencari hunian yang nyaman.</p>
                </div>

                <!-- Display Errors validasi dari backend -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm mb-4">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4" id="registrationForm">
                    @csrf
                    
                    <!-- Hidden Role Input -->
                    <input type="hidden" name="role" id="roleInput" value="{{ old('role', 'mahasiswa') }}">

                    <!-- User Role Selection Tabs -->
                    <div class="grid grid-cols-2 gap-2 p-1 bg-gray-100 rounded-xl">
                        <button class="flex items-center justify-center gap-2 py-3 rounded-lg font-semibold transition-all text-sm text-gray-700" id="tab-mahasiswa" onclick="selectRole('mahasiswa', event)" type="button">
                            <span class="material-symbols-outlined text-[20px]">school</span>
                            Mahasiswa
                        </button>
                        <button class="flex items-center justify-center gap-2 py-3 rounded-lg font-semibold transition-all text-sm text-gray-700" id="tab-owner" onclick="selectRole('owner', event)" type="button">
                            <span class="material-symbols-outlined text-[20px]">real_estate_agent</span>
                            Pemilik Kost
                        </button>
                    </div>

                    <!-- Input Fields Group -->
                    <div class="space-y-4 pt-2">
                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-600 px-1">Nama Lengkap</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">person</span>
                                <input class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-md text-sm focus:outline-none focus:border-[#4648d4] transition-all" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required type="text"/>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-semibold text-gray-600 px-1">Email</label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">mail</span>
                                <input class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-md text-sm focus:outline-none focus:border-[#4648d4] transition-all" name="email" value="{{ old('email') }}" placeholder="contoh@email.com" required type="email"/>
                            </div>
                        </div>

                        <!-- Dynamic Document Upload Field for Owner -->
                        <div class="space-y-1 hidden" id="ktpUploadField">
                            <label class="text-xs font-semibold text-gray-600 px-1">Foto KTP / Dokumen Verifikasi Kos</label>
                            <div class="relative">
                                <input type="file" name="foto_ktp_dokumen" id="fotoKtpInput" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 px-1">Password</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock</span>
                                    <input class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-md text-sm focus:outline-none focus:border-[#4648d4] transition-all" name="password" placeholder="••••••••" required type="password"/>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-semibold text-gray-600 px-1">Konfirmasi Password</label>
                                <div class="relative">
                                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">lock_reset</span>
                                    <input class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-300 rounded-md text-sm focus:outline-none focus:border-[#4648d4] transition-all" name="password_confirmation" placeholder="••••••••" required type="password"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Conditions -->
                    <div class="flex items-start gap-3 py-2">
                        <input class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer mt-0.5" id="terms" required type="checkbox"/>
                        <label class="text-xs text-gray-500 leading-tight cursor-pointer" for="terms">
                            Saya menyetujui <a class="text-blue-600 hover:underline" href="#">Syarat & Ketentuan</a> serta <a class="text-blue-600 hover:underline" href="#">Kebijakan Privasi</a> StayFind.
                        </label>
                    </div>

                    <!-- CTA Submit Button -->
                    <button class="w-full py-3 bg-[#4648d4] hover:bg-opacity-90 text-white font-bold rounded-md shadow-md transition-all flex items-center justify-center gap-2 mt-4 group cursor-pointer" type="submit">
                        Daftar Sekarang
                        <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>

                    <!-- Login Redirect -->
                    <div class="text-center pt-2">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?&nbsp;
                            <a class="text-blue-600 font-bold hover:underline" href="{{ route('login') }}">Masuk</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    function selectRole(role, e) {
        if(e) e.preventDefault(); 

        const tabMahasiswa = document.getElementById('tab-mahasiswa');
        const tabOwner = document.getElementById('tab-owner');
        const roleInput = document.getElementById('roleInput');
        const ktpUploadField = document.getElementById('ktpUploadField');
        const fotoKtpInput = document.getElementById('fotoKtpInput');

        roleInput.value = role;

        if (role === 'mahasiswa') {
            tabMahasiswa.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
            tabOwner.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
            ktpUploadField.classList.add('hidden');
            if (fotoKtpInput) fotoKtpInput.removeAttribute('required');
        } else {
            tabOwner.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
            tabMahasiswa.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
            ktpUploadField.classList.remove('hidden');
            if (fotoKtpInput) fotoKtpInput.setAttribute('required', 'required');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const currentRole = document.getElementById('roleInput').value;
        selectRole(currentRole);
    });
</script>
@endsection