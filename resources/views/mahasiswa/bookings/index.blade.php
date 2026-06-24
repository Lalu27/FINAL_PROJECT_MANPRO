@extends('layouts.mahasiswa')
@section('title', 'Riwayat Booking Kost')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="space-y-6 animate__animated animate__fadeIn">
    <div class="py-2">
        <h2 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight">Riwayat Pemesanan Kost Anda</h2>
        <p class="text-xs text-gray-500 mt-0.5">Pantau estimasi tagihan, durasi sewa, dan persetujuan status booking aktif Anda.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden w-full">
        <table class="w-full text-left border-collapse table-fixed text-xs">
            <thead>
                <tr class="bg-slate-50 text-[10px] font-black uppercase tracking-wider text-slate-400 border-b border-slate-100">
                    <th class="p-4 pl-6 w-1/3">Properti Kost</th>
                    <th class="p-4 w-1/6">Durasi Sewa</th>
                    <th class="p-4 w-1/4">Total Tagihan Estimasi</th>
                    <th class="p-4 text-center w-1/6">Status</th>
                    <th class="p-4 pr-6 text-center w-1/6">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                @forelse($bookings as $booking)
                    <tr id="booking-row-{{ $booking->id }}" class="booking-row hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6 font-extrabold text-slate-800 break-words">
                            {{ $booking->property->nama_properti ?? 'Kost Terhapus' }}
                        </td>
                        <td class="p-4 text-slate-500 break-words">{{ $booking->durasi_sewa }} Bulan</td>
                        <td class="p-4 font-bold text-[#004ac6] break-words">
                            Rp {{ number_format(($booking->property->harga_bulanan ?? 0) * $booking->durasi_sewa, 0, ',', '.') }}
                        </td>
                        <td class="p-4 text-center">
                            @if($booking->status === 'approved')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-50 text-green-600 border border-green-100">Disetujui</span>
                            @elseif($booking->status === 'rejected')
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-50 text-red-600 border border-red-100">Ditolak</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-100">Pending</span>
                            @endif
                        </td>
                        
                        <td class="p-4 pr-6">
                            <div class="flex items-center justify-center gap-2">
                                @if($booking->status === 'approved')
                                    <a href="{{ route('mahasiswa.reviews.create', ['property_id' => $booking->property_id]) }}"
                                       class="inline-flex items-center gap-1 px-2.5 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 font-black text-[10px] uppercase tracking-wider rounded-xl transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-xs">rate_review</span>
                                        <span>Ulas</span>
                                    </a>
                                @endif

                                <button type="button" onclick="sembunyikanRiwayat({{ $booking->id }})" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all cursor-pointer shadow-sm border border-slate-100 bg-white flex items-center justify-center">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-16 text-center text-slate-400">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <div class="p-3 bg-slate-50 text-slate-300 rounded-full">
                                    <span class="material-symbols-outlined text-3xl">receipt_long</span>
                                </div>
                                <p class="text-xs font-bold text-slate-400">Kamu belum memiliki riwayat pemesanan kamar kost saat ini.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Ambil daftar ID booking yang pernah disembunyikan dari penyimpanan lokal browser
        let hiddenBookings = JSON.parse(localStorage.getItem('hidden_bookings') || "[]");
        
        // 2. Langsung bersihkan/hilangkan baris dari tabel sebelum halaman selesai dirender sepenuhnya
        hiddenBookings.forEach(id => {
            let row = document.getElementById(`booking-row-${id}`);
            if (row) row.remove();
        });
    });

    function sembunyikanRiwayat(id) {
        if (confirm('Apakah Anda yakin ingin menyembunyikan riwayat booking ini dari halaman Anda?')) {
            // 1. Masukkan ID riwayat yang dipilih ke daftar hitam LocalStorage
            let hiddenBookings = JSON.parse(localStorage.getItem('hidden_bookings') || "[]");
            if (!hiddenBookings.includes(id)) {
                hiddenBookings.push(id);
                localStorage.setItem('hidden_bookings', JSON.stringify(hiddenBookings));
            }
            
            // 2. Beri efek transisi memudar ke kanan demi user experience yang halus
            let row = document.getElementById(`booking-row-${id}`);
            if (row) {
                row.style.transition = "all 0.3s ease";
                row.style.opacity = "0";
                row.style.transform = "translateX(20px)";
                // Hapus elemen secara permanen dari dokumen HTML setelah animasi selesai
                setTimeout(() => row.remove(), 300);
            }
        }
    }
</script>
@endsection