@extends('layouts.admin')

@section('title', 'Manage Owners - Admin')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

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

<div class="bg-[#f8f9ff] text-gray-900 pb-24 animate__animated animate__fadeIn">
    <main class="max-w-7xl mx-auto px-4 md:px-6 py-6 space-y-6">
        
        <section class="py-4">
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">Verifikasi Akun Owner</h2>
            <p class="text-sm text-gray-500 mt-1">Setujui atau tolak berkas pendaftaran pemilik kost baru secara aman.</p>
        </section>

        <section class="mb-8">
            <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden w-full">
                <table class="w-full text-left border-collapse table-fixed text-xs">
                    <thead>
                        <tr class="bg-slate-50 text-[10px] font-black uppercase tracking-wider text-slate-400 border-b border-slate-100">
                            <th class="p-4 pl-6 w-1/4">Nama Pemilik</th>
                            <th class="p-4 w-1/4">Email Akun</th>
                            <th class="p-4 w-1/5">Dokumen KTP</th>
                            <th class="p-4 pr-6 text-center w-1/4">Aksi Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">
                        @forelse($pendingOwners as $owner)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 pl-6 font-bold text-slate-800 truncate">{{ $owner->nama }}</td>
                                <td class="p-4 truncate">{{ $owner->email }}</td>
                                <td class="p-4">
                                    <a href="{{ asset('storage/' . $owner->foto_ktp_dokumen) }}" target="_blank" class="text-[#4648d4] font-bold hover:underline flex items-center gap-1 w-fit">
                                        <span class="material-symbols-outlined text-sm">visibility</span> Lihat KTP
                                    </a>
                                </td>
                                <td class="p-4 pr-6">
                                    <div class="flex justify-center items-center gap-2">
                                        <form action="{{ route('admin.owners.verify', $owner->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="approve" value="1">
                                            <button type="submit" class="px-3 py-1.5 bg-green-50 text-green-700 font-bold border border-green-200/40 rounded-xl hover:bg-green-100/80 transition-all cursor-pointer shadow-sm flex items-center gap-1">
                                                <span class="material-symbols-outlined text-xs">check_circle</span> Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.owners.verify', $owner->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="approve" value="0">
                                            <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-700 font-bold border border-red-200/40 rounded-xl hover:bg-red-100/80 transition-all cursor-pointer flex items-center gap-1">
                                                <span class="material-symbols-outlined text-xs">cancel</span> Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <div class="p-3 bg-slate-50 text-slate-300 rounded-full">
                                            <span class="material-symbols-outlined text-3xl">badge</span>
                                        </div>
                                        <p class="text-xs font-bold text-slate-400">Tidak ada antrean berkas verifikasi owner baru saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </main>
</div>
@endsection