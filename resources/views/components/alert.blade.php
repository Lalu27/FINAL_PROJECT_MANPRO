@if(session('success'))
    <div class="mb-6 p-4 text-sm text-green-700 bg-green-50 rounded-xl border border-green-100 font-semibold flex items-center gap-2">
        <span class="material-symbols-outlined text-base">check_circle</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 text-sm text-red-700 bg-red-50 rounded-xl border border-red-100 font-semibold space-y-1">
        @foreach($errors->all() as $error)
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-base">error</span>
                <span>{{ $error }}</span>
            </div>
        @endforeach
    </div>
@endif