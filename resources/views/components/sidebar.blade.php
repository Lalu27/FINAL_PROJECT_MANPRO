<aside class="w-72 bg-white border border-slate-200/60 p-4 fixed h-[calc(100vh-32px)] z-40 ml-4 rounded-2xl shadow-sm flex flex-col justify-between">
    <div class="space-y-6">
        <!-- Header Logo -->
        <div class="flex items-center gap-2 px-2">
            <div class="p-1.5 bg-[#004ac6] text-white rounded-lg flex items-center justify-center shadow-md shadow-blue-100">
                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">night_shelter</span>
            </div>
            <span class="text-sm font-black text-[#004ac6] uppercase tracking-tight">StayFind</span>
        </div>

        <!-- User Profile Card -->
        <div class="px-4 py-2 bg-slate-50 rounded-xl border border-slate-100 flex flex-col">
            @auth
                <span class="text-xs font-bold text-slate-700 truncate">{{ auth()->user()->nama }}</span>
                <span class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mt-0.5">{{ auth()->user()->role }}</span>
            @endauth
        </div>

        <!-- Navigation Menus -->
        <nav class="flex flex-col gap-1 overflow-y-auto hide-scrollbar max-h-[calc(100vh-240px)]">
            
            @auth
                {{-- ==================== MENU SISI USER LOGIN ==================== --}}
                @if(auth()->user()->role === 'admin')
                    <!-- Menu Admin -->
                    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Menu Admin</p>
                    
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('admin.dashboard')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">dashboard</span> <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('admin.owners.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('admin.owners.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('admin.owners.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">badge</span> <span>Manage Owners</span>
                    </a>
                    
                    <a href="{{ route('admin.properties.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('admin.properties.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('admin.properties.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">maps_home_work</span> <span>Manage Properties</span>
                    </a>

                    <a href="{{ route('admin.users.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('admin.users.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">manage_accounts</span> <span>Manage Users</span>
                    </a>

                    <a href="{{ route('admin.moderation.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('admin.moderation.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('admin.moderation.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">rate_review</span> <span>Manage Reviews</span>
                    </a>

                @elseif(auth()->user()->role === 'owner')
                    <!-- Menu Owner -->
                    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Menu Owner</p>
                    <a href="{{ route('owner.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('owner.dashboard') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('owner.dashboard')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">monitoring</span> <span>Dashboard</span>
                    </a>
                    <a href="{{ route('owner.properties.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('owner.properties.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('owner.properties.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">holiday_village</span> <span>Daftar Kost</span>
                    </a>
                    <a href="{{ route('owner.bookings.index') }}" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('owner.bookings.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('owner.bookings.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-base">receipt_long</span> <span>Permintaan Booking</span>
                        </div>
                    </a>
                    <a href="{{ route('owner.reports.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('owner.reports.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('owner.reports.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">payments</span> <span>Laporan Keuangan</span>
                    </a>
                    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 mt-3">Ulasan & Kunjungan</p>
                    <a href="{{ route('owner.surveys.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('owner.surveys.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('owner.surveys.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">calendar_month</span> <span>Jadwal Survei</span>
                    </a>
                    <a href="{{ route('owner.reviews.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('owner.reviews.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('owner.reviews.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">star</span> <span>Ulasan Kost</span>
                    </a>

                @elseif(auth()->user()->role === 'mahasiswa')
                    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 mt-2">Menu Mahasiswa</p>
                    
                    <a href="{{ route('mahasiswa.dashboard') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('mahasiswa.dashboard')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">space_dashboard</span> <span>Dashboard</span>
                    </a>
                    <a href="{{ route('mahasiswa.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('mahasiswa.index') || request()->routeIs('mahasiswa.show') || request()->routeIs('mahasiswa.bookings.create') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('mahasiswa.index') || request()->routeIs('mahasiswa.show') || request()->routeIs('mahasiswa.bookings.create')) 
                            <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> 
                        @endif
                        <span class="material-symbols-outlined text-base">travel_explore</span> <span>Jelajahi Kost</span>
                    </a>
                    
                    <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1 mt-3">Riwayat & Aktivitas</p>
                    
                    <a href="{{ route('mahasiswa.bookings.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('mahasiswa.bookings.index') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('mahasiswa.bookings.index')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">receipt_long</span> <span>Riwayat Booking</span>
                    </a>
                    <a href="{{ route('mahasiswa.surveys.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('mahasiswa.surveys.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('mahasiswa.surveys.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">calendar_month</span> <span>Survei Lokasi</span>
                    </a>
                    <a href="{{ route('mahasiswa.reviews.index') }}" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-black uppercase tracking-wider hover:bg-slate-50 relative {{ request()->routeIs('mahasiswa.reviews.*') ? 'bg-blue-50 text-[#004ac6]' : 'text-slate-400' }}">
                        @if(request()->routeIs('mahasiswa.reviews.*')) <div class="absolute left-0 top-1 bottom-1 w-1 bg-[#004ac6] rounded-r-lg"></div> @endif
                        <span class="material-symbols-outlined text-base">star</span> <span>Ulasan Saya</span>
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