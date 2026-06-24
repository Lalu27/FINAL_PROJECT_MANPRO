@extends('layouts.app')
@section('title', 'Hubungi Kami')

@section('content')
<section class="max-w-md mx-auto px-6 py-12 space-y-6">
    <div class="text-center space-y-1">
        <h2 class="text-2xl font-black text-slate-900">Hubungi Helpdesk</h2>
        <p class="text-xs text-slate-400">Ada kendala seputar akun atau transaksi? Hubungi kami langsung.</p>
    </div>
    
    <div class="bg-white p-6 border border-slate-200/60 rounded-2xl shadow-sm">
        <form class="space-y-4" onsubmit="event.preventDefault(); alert('Pesan bantuan berhasil terkirim!');">
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Nama Anda</label>
                <input type="text" required class="w-full px-3 py-2 border border-slate-200 text-xs rounded-xl focus:outline-none focus:border-[#004ac6]">
            </div>
            <div class="space-y-1">
                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Isi Pertanyaan / Keluhan</label>
                <textarea rows="3" required class="w-full px-3 py-2 border border-slate-200 text-xs rounded-xl focus:outline-none focus:border-[#004ac6]"></textarea>
            </div>
            <button type="submit" class="w-full bg-[#004ac6] text-white font-bold py-2.5 rounded-xl text-xs uppercase tracking-wider shadow-sm cursor-pointer hover:bg-[#003bb0]">Kirim Pesan</button>
        </form>
    </div>
</section>
@endsection