@extends('layouts.admin')
@section('title', 'Detail Berkas Owner')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.owners.index') }}" class="text-slate-400 hover:text-slate-600"><span class="material-symbols-outlined">arrow_back</span></a>
        <h2 class="text-xl font-extrabold text-slate-900">Verifikasi Dokumen</h2>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 space-y-6">
        <div class="grid grid-cols-2 gap-4 text-xs">
            <div>
                <p class="font-bold text-slate-400 uppercase">Nama Pendaftar</p>
                <p class="text-sm font-black text-slate-800 mt-1">{{ $owner->nama }}</p>
            </div>
            <div>
                <p class="font-bold text-slate-400 uppercase">Email Terdaftar</p>
                <p class="text-sm font-black text-slate-800 mt-1">{{ $owner->email }}</p>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-xs font-bold text-slate-400 uppercase">Lampiran KTP / Dokumen Resmi</p>
            <div class="w-full h-64 bg-slate-100 rounded-xl overflow-hidden border border-slate-200 flex items-center justify-center">
                @if($owner->foto_ktp_dokumen)
                    <img src="{{ asset('storage/' . $owner->foto_ktp_dokumen) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-slate-400 text-xs font-medium">Dokumen tidak ditemukan</span>
                @endif
            </div>
        </div>

        <div class="flex gap-3 pt-2">
            <form action="{{ route('admin.owners.verify', $owner->id) }}" method="POST" class="flex-1">
                @csrf @method('PUT')
                <input type="hidden" name="approve" value="1">
                <button class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2.5 rounded-xl text-xs uppercase cursor-pointer">Setujui Akun</button>
            </form>
            <form action="{{ route('admin.owners.verify', $owner->id) }}" method="POST" class="flex-1">
                @csrf @method('PUT')
                <input type="hidden" name="approve" value="0">
                <button class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl text-xs uppercase cursor-pointer">Tolak</button>
            </form>
        </div>
    </div>
</div>
@endsection