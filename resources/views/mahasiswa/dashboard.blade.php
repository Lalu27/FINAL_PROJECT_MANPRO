@extends('layouts.mahasiswa')
@section('title', 'Workspace Mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <x-stat-card title="Kost Aktif Saya" value="{{ $activeBookingsCount ?? 0 }} Kamar" icon="bed" color="blue" />
        <x-stat-card title="Jadwal Survei" value="{{ $mySurveysCount ?? 0 }} Agenda" icon="calendar_month" color="amber" />
    </div>

    <!-- Riwayat Transaksi Ringkas -->
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm p-6 space-y-4">
        <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider">Status Sewa Terbaru</h3>
        <div class="divide-y divide-slate-50 text-xs">
            @forelse($bookings as $booking)
                <div class="py-3 flex justify-between items-center first:pt-0 last:pb-0">
                    <div>
                        <p class="font-bold text-slate-800">{{ $booking->property->nama_properti }}</p>
                        <p class="text-slate-400 mt-0.5">Durasi: {{ $booking->durasi_sewa }} Bulan</p>
                    </div>
                    <span class="px-2.5 py-1 font-bold rounded-full text-[10px] uppercase {{ $booking->status === 'approved' ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700' }}">
                        {{ $booking->status }}
                    </span>
                </div>
            @empty
                <p class="text-slate-400 py-2">Kamu belum mengajukan pemesanan kost apa pun.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection