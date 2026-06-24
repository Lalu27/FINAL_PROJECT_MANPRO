@extends('layouts.mahasiswa')
@section('title', 'Pesan Internal')

@section('content')
<div class="bg-white border border-slate-200/60 rounded-2xl shadow-sm h-[500px] flex overflow-hidden">
    <!-- Log Chat Area -->
    <div class="flex-grow flex flex-col justify-between p-4 bg-slate-50/50">
        <div class="space-y-3 overflow-y-auto pr-2">
            @forelse($chats as $chat)
                <div class="flex flex-col {{ $chat->sender_id === auth()->id() ? 'items-end' : 'items-start' }}">
                    <div class="max-w-xs p-3 rounded-2xl text-xs font-medium {{ $chat->sender_id === auth()->id() ? 'bg-[#004ac6] text-white rounded-br-none' : 'bg-white border border-slate-200 text-slate-700 rounded-bl-none' }}">
                        {{ $chat->pesan }}
                    </div>
                </div>
            @empty
                <p class="text-center text-xs text-slate-400 pt-12">Mulai percakapan dengan pemilik kost terkait ketersediaan kamar.</p>
            @endforelse
        </div>

        <!-- Input Box -->
        <form action="{{ route('mahasiswa.messages.store') }}" method="POST" class="mt-4 flex gap-2">
            @csrf
            <!-- ID Receiver dilempar otomatis via query data dummy -->
            <input type="hidden" name="receiver_id" value="2"> 
            <input type="text" name="pesan" required placeholder="Tulis pesan pertanyaan kamu di sini..." class="flex-grow px-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:border-[#004ac6] bg-white">
            <button type="submit" class="bg-[#004ac6] text-white px-4 rounded-xl flex items-center justify-center cursor-pointer hover:bg-[#003bb0]"><span class="material-symbols-outlined text-sm">send</span></button>
        </form>
    </div>
</div>
@endsection