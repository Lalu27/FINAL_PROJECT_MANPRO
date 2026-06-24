@extends('layouts.mahasiswa')
@section('title', 'Jadwal Kunjungan Lokasi')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<div class="space-y-6 animate__animated animate__fadeIn">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse($surveys as $survey)
            <div id="student-survey-card-{{ $survey->id }}" class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm flex flex-col justify-between gap-4 transition-all duration-300">
                <div class="flex justify-between items-start gap-2">
                    <div class="space-y-1.5">
                        <span class="text-[9px] font-black uppercase tracking-widest px-2 py-0.5 rounded bg-blue-50 text-[#004ac6]">Agenda Kunjungan</span>
                        <h3 class="font-extrabold text-slate-800 text-sm leading-snug tracking-tight">{{ $survey->property->nama_properti ?? 'Kost Terhapus' }}</h3>
                        <p class="text-[11px] text-slate-400 font-semibold flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-xs text-[#004ac6]">calendar_today</span> 
                            {{ is_string($survey->tanggal_survei) ? date('d M Y', strtotime($survey->tanggal_survei)) : $survey->tanggal_survei->format('d M Y') }}
                        </p>
                    </div>

                    @if($survey->status !== 'pending')
                        <button type="button" onclick="sembunyikanSurveyMhs({{ $survey->id }})" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl border border-slate-100 bg-white transition-all cursor-pointer shadow-sm shrink-0">
                            <span class="material-symbols-outlined text-sm">delete</span>
                        </button>
                    @endif
                </div>

                <div class="border-t border-slate-100 pt-3 flex justify-between items-center text-xs">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Status Respon Owner:</span>
                    
                    @if($survey->status === 'pending')
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-50 text-amber-600 border border-amber-100">Pending</span>
                    @elseif($survey->status === 'approved' || $survey->status === 'confirmed')
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-green-50 text-green-600 border border-green-100">Disetujui</span>
                    @else
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-50 text-red-600 border border-red-100">Ditolak</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-2 text-center py-16 bg-white border border-slate-200/60 rounded-2xl shadow-sm text-slate-400 flex flex-col items-center justify-center gap-3">
                <div class="p-3 bg-slate-50 text-slate-300 rounded-full">
                    <span class="material-symbols-outlined text-3xl">calendar_month</span>
                </div>
                <p class="text-xs font-bold text-slate-400">Kamu belum menjadwalkan kunjungan langsung ke properti mana pun.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Ambil daftar ID survei mhs yang pernah disembunyikan
        let studentHiddenSurveys = JSON.parse(localStorage.getItem('student_hidden_surveys') || "[]");
        
        // 2. Hilangkan dari layout
        studentHiddenSurveys.forEach(id => {
            let card = document.getElementById(`student-survey-card-${id}`);
            if (card) card.remove();
        });
    });

    function sembunyikanSurveyMhs(id) {
        if (confirm('Apakah Anda yakin ingin menyembunyikan riwayat survei ini dari daftar Anda?')) {
            // 1. Kunci ID ke memori lokal browser
            let studentHiddenSurveys = JSON.parse(localStorage.getItem('student_hidden_surveys') || "[]");
            if (!studentHiddenSurveys.includes(id)) {
                studentHiddenSurveys.push(id);
                localStorage.setItem('student_hidden_surveys', JSON.stringify(studentHiddenSurveys));
            }
            
            // 2. Animasi menghilang mulus
            let card = document.getElementById(`student-survey-card-${id}`);
            if (card) {
                card.style.transition = "all 0.3s ease";
                card.style.opacity = "0";
                card.style.transform = "scale(0.95)";
                setTimeout(() => card.remove(), 300);
            }
        }
    }
</script>
@endsection