@extends('layouts.owner')
@section('title', 'Pesanan Sewa Masuk')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<script id="tailwind-config">
    tailwind.config = { 
        theme: { 
            extend: { 
                "colors": { 
                    "primary": "#4648d4", 
                    "secondary": "#006c49", 
                    "background": "#f8f9ff" 
                } 
            } 
        } 
    }
</script>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="bg-[#f8f9ff] text-gray-900 pb-24 animate__animated animate__fadeIn">
    <main class="max-w-7xl mx-auto px-4 md:px-6 py-6 space-y-6">
        
        <section class="py-4">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Permintaan Booking Masuk</h2>
            <p class="text-sm text-gray-500 mt-1">Berikut adalah riwayat data pemesanan kamar kost dari mahasiswa secara real-time.</p>
        </section>

        <section class="mb-8">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden w-full">
                <div class="overflow-x-auto w-full hide-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <th class="py-4 px-6">Nama Mahasiswa</th>
                                <th class="py-4 px-6">Kost Tujuan</th>
                                <th class="py-4 px-6">Durasi</th>
                                <th class="py-4 px-6 text-center">Status</th>
                                <th class="py-4 px-6 text-center">Aksi Konfirmasi / Bersihkan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-gray-700">
                            @forelse($bookings as $book)
                                <tr id="owner-booking-row-{{ $book->id }}" class="hover:bg-slate-50/40 transition-colors">
                                    <td class="py-4 px-6 font-bold text-gray-900">{{ $book->user->nama }}</td>
                                    <td class="py-4 px-6 font-medium text-[#4648d4]">{{ $book->property->nama_properti }}</td>
                                    <td class="py-4 px-6 font-semibold text-gray-500">{{ $book->durasi_sewa }} Bulan</td>
                                    <td class="py-4 px-6 text-center">
                                        @if($book->status === 'pending')
                                            <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-700 font-bold text-[10px] uppercase rounded-full tracking-wider border border-amber-200/40">Pending</span>
                                        @elseif($book->status === 'approved')
                                            <span class="inline-flex items-center px-2.5 py-1 bg-green-50 text-green-700 font-bold text-[10px] uppercase rounded-full tracking-wider border border-green-200/40">Disetujui</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 bg-red-50 text-red-700 font-bold text-[10px] uppercase rounded-full tracking-wider border border-red-200/40">Ditolak</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center justify-center gap-2">
                                            @if($book->status === 'pending')
                                                <form action="{{ route('owner.bookings.update', $book->id) }}" method="POST">
                                                    @csrf @method('PUT') 
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit" class="bg-[#4648d4] text-white px-3 py-1.5 rounded-xl font-bold text-[11px] hover:bg-opacity-90 transition-all cursor-pointer flex items-center gap-1 shadow-sm">
                                                        <span class="material-symbols-outlined text-xs">check_circle</span> Terima
                                                    </button>
                                                </form>
                                                <form action="{{ route('owner.bookings.update', $book->id) }}" method="POST">
                                                    @csrf @method('PUT') 
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" class="bg-slate-100 text-slate-700 px-3 py-1.5 rounded-xl font-bold text-[11px] hover:bg-slate-200 transition-all cursor-pointer flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-xs">cancel</span> Tolak
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" onclick="sembunyikanRiwayatOwner({{ $book->id }})" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg border border-slate-100 bg-white transition-all cursor-pointer flex items-center gap-1 font-bold text-[10px] uppercase tracking-wider shadow-sm">
                                                    <span class="material-symbols-outlined text-sm">delete</span> Hapus Riwayat
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 px-6 text-center">
                                        <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full mb-3">
                                            <span class="material-symbols-outlined text-3xl">receipt_long</span>
                                        </div>
                                        <p class="text-xs font-bold text-slate-400">Belum ada mahasiswa yang memesan sewa kost saat ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Ambil daftar ID booking yang pernah disembunyikan oleh Owner
        let ownerHiddenBookings = JSON.parse(localStorage.getItem('owner_hidden_bookings') || "[]");
        
        // 2. Langsung buang baris data tersebut dari layar sebelum halaman dirender penuh
        ownerHiddenBookings.forEach(id => {
            let row = document.getElementById(`owner-booking-row-${id}`);
            if (row) row.remove();
        });
    });

    function sendunyikanRiwayatOwner(id) {
        if (confirm('Apakah Anda yakin ingin menghapus dan membersihkan catatan pesanan ini dari halaman Anda?')) {
            // 1. Amankan ID transaksi ke dalam list memori lokal browser milik Owner
            let ownerHiddenBookings = JSON.parse(localStorage.getItem('owner_hidden_bookings') || "[]");
            if (!ownerHiddenBookings.includes(id)) {
                ownerHiddenBookings.push(id);
                localStorage.setItem('owner_hidden_bookings', JSON.stringify(ownerHiddenBookings));
            }
            
            // 2. Mainkan efek visual geser memudar lalu hilangkan dari tabel HTML secara langsung
            let row = document.getElementById(`owner-booking-row-${id}`);
            if (row) {
                row.style.transition = "all 0.3s ease";
                row.style.opacity = "0";
                row.style.transform = "translateX(25px)";
                setTimeout(() => row.remove(), 300);
            }
        }
    }
</script>
@endsection