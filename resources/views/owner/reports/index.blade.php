@extends('layouts.owner')
@section('title', 'Laporan Keuangan Kost')

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
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Laporan Keuangan & Omzet</h2>
            <p class="text-sm text-gray-500 mt-1">Pantau akumulasi total uang masuk dan pembukuan detail sewa dari penghuni kost Anda.</p>
        </section>

        <section class="mb-6">
            <div class="bg-white p-6 rounded-2xl border border-slate-200/60 shadow-sm flex flex-col gap-3 max-w-sm hover:shadow-md transition-shadow">
                <div class="inline-flex p-3 bg-indigo-50 text-[#4648d4] rounded-xl w-fit">
                    <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
                </div>
                <div>
                    <p class="text-xs font-black text-slate-400 uppercase tracking-wider">Total Pendapatan Bersih</p>
                    <p class="text-2xl font-black text-[#4648d4] mt-1">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden w-full">
                <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Buku Kas Transaksi Masuk</h3>
                </div>
                <div class="overflow-x-auto w-full hide-scrollbar">
                    <table class="w-full text-left border-collapse whitespace-nowrap text-xs">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <th class="py-4 px-6">Penyewa Kost</th>
                                <th class="py-4 px-6">Nama Properti</th>
                                <th class="py-4 px-6">Masa Sewa</th>
                                <th class="py-4 px-6 text-right">Total Bayar</th>
                                <th class="py-4 px-6 text-center">Status Pembukuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-gray-700">
                            @forelse($financialBookings as $book)
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="py-4 px-6 font-bold text-gray-900">{{ $book->user->nama }}</td>
                                    <td class="py-4 px-6 font-medium text-slate-500">{{ $book->property->nama_properti }}</td>
                                    <td class="py-4 px-6 font-semibold text-slate-400">{{ $book->durasi_sewa }} Bulan</td>
                                    <td class="py-4 px-6 text-right font-black text-emerald-600">
                                        Rp {{ number_format(($book->property->harga_bulanan ?? 0) * ($book->durasi_sewa ?? 1), 0, ',', '.') }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 bg-green-50 text-green-700 font-bold text-[10px] uppercase rounded-full tracking-wider border border-green-200/40">Lunas / Masuk</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-20 px-6 text-center">
                                        <div class="inline-flex p-4 bg-slate-50 text-slate-400 rounded-full mb-3">
                                            <span class="material-symbols-outlined text-3xl">payments</span>
                                        </div>
                                        <p class="text-xs font-bold text-slate-400">Belum ada catatan pemasukan keuangan dari transaksi sewa kost.</p>
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
@endsection