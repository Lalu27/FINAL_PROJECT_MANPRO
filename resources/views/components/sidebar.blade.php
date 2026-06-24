<div class="md:hidden fixed top-4 left-4 z-50">
    <button onclick="toggleSidebar()" class="p-2 bg-white border border-slate-200 rounded-xl shadow-sm flex items-center justify-center">
        <span class="material-symbols-outlined text-slate-700">menu</span>
    </button>
</div>

<aside id="sidebar" class="w-72 bg-white border border-slate-200/60 p-4 fixed h-[calc(100vh-32px)] z-40 md:ml-4 rounded-2xl shadow-sm hidden md:flex flex-col justify-between transition-all duration-300 left-0 top-4 max-md:h-screen max-md:rounded-none max-md:top-0 max-md:ml-0">
    
    <div class="md:hidden absolute top-4 right-4">
        <button onclick="toggleSidebar()" class="text-slate-400 hover:text-slate-600">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <div class="space-y-6">
        <div class="flex items-center gap-2 px-2">
            <div class="p-1.5 bg-[#004ac6] text-white rounded-lg flex items-center justify-center shadow-md shadow-blue-100">
                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">night_shelter</span>
            </div>
            <span class="text-sm font-black text-[#004ac6] uppercase tracking-tight">StayFind</span>
        </div>

        <div class="px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 flex flex-col">
            @auth
                <span class="text-xs font-bold text-slate-700 truncate">{{ auth()->user()->nama }}</span>
                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mt-0.5">{{ auth()->user()->role }}</span>
            @endauth
        </div>

        <nav class="flex flex-col gap-1 overflow-y-auto hide-scrollbar max-h-[calc(100vh-240px)]">
            @auth
                @if(auth()->user()->role === 'admin')
                    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Menu Admin</p>
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('admin.dashboard')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">dashboard</span> <span>Dashboard</span>
                    </a>
                    @endif
            @endauth
        </nav>
    </div>

    <div class="pt-4 border-t border-slate-100">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider text-red-600 hover:bg-red-50 transition-all cursor-pointer">
                    <span class="material-symbols-outlined text-base">logout</span> <span>Logout</span>
                </button>
            </form>
        @endauth
    </div>
</aside>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.remove('hidden');
            sidebar.classList.add('flex', 'max-md:w-full', 'max-md:z-50'); // Buat full screen di HP jika dibuka
        } else {
            sidebar.classList.add('hidden');
            sidebar.classList.remove('flex', 'max-md:w-full', 'max-md:z-50');
        }
    }
</script>