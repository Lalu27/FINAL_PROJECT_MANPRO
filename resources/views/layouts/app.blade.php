<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - StayFind</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#f8f9ff] text-[#0b1c30] antialiased min-h-screen flex flex-col justify-between relative">

    @if(!auth()->check() || auth()->user()->role !== 'mahasiswa')
        <!-- 🌟 PERBAIKAN UTAMA NAVBAR: Menggunakan backdrop-blur modern, padding seimbang, dan z-index tinggi -->
        <nav class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50 shadow-sm transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 md:px-8 py-4 flex justify-between items-center">
                
                <!-- Logo Brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-[#004ac6] font-black tracking-wider text-base uppercase hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-xl">night_shelter</span> STAYFIND
                </a>
                
                <!-- Menu Navigasi Sisi Kanan -->
                <div class="flex items-center gap-8 text-xs font-bold text-slate-600">
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="{{ route('public.home') }}" class="hover:text-[#004ac6] transition-colors relative py-1 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-[#004ac6] hover:after:w-full after:transition-all {{ Request::routeIs('public.home') ? 'text-[#004ac6] after:w-full' : '' }}">Home</a>
                        <a href="{{ route('public.about') }}" class="hover:text-[#004ac6] transition-colors relative py-1 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-[#004ac6] hover:after:w-full after:transition-all {{ Request::routeIs('public.about') ? 'text-[#004ac6] after:w-full' : '' }}">Tentang Kami</a>
                    </div>
                    
                    <!-- Garis Pembatas Vertikal Mini -->
                    <span class="hidden sm:inline block w-px h-4 bg-slate-200"></span>

                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="bg-blue-50 text-[#004ac6] border border-blue-100/60 px-4 py-2.5 rounded-xl hover:bg-blue-100 hover:scale-[1.01] active:scale-[0.99] transition-all">Workspace Dashboard</a>
                        @else
                            <!-- Tombol Login (Sekarang Outline/Transparent Bergaya Transparan) -->
                            <a href="{{ route('login') }}" class="text-slate-700 hover:text-[#004ac6] px-4 py-2.5 rounded-xl border border-transparent hover:border-slate-100 hover:bg-slate-50 transition-all">Login</a>
                            
                            <!-- Tombol Daftar (Solid Utama dengan Efek Shadow Angkat) -->
                            <a href="{{ route('register') }}" class="bg-[#004ac6] text-white px-4 py-2.5 rounded-xl hover:bg-[#003bb0] hover:shadow-md hover:shadow-blue-200/80 hover:scale-[1.01] active:scale-[0.99] transition-all">Daftar Akun</a>
                        @endauth
                    </div>
                </div>

            </div>
        </nav>
    @endif

    <div class="flex flex-1 w-full relative">
        @auth
            @if(auth()->user()->role === 'mahasiswa')
                <div class="hidden lg:block">
                    @include('components.sidebar')
                </div>
            @endif
        @endauth

        <main class="flex-grow w-full {{ auth()->check() && auth()->user()->role === 'mahasiswa' ? 'lg:pl-[304px] pt-4' : '' }}">
            @yield('content')
        </main>
    </div>

    @if(!auth()->check() || auth()->user()->role !== 'mahasiswa')
        <footer class="bg-white border-t border-slate-100 py-6 text-center text-xs text-slate-400 font-medium w-full">
            &copy; {{ date('Y') }} StayFind Platform. All Rights Reserved. STT Terpadu Nurul Fikri.
        </footer>
    @endif

    <!-- Tombol WhatsApp Mengambang Aktif -->
    <a href="https://wa.me/6281234567890?text=Halo%20Helpdesk%20StayFind,%20saya%20butuh%20bantuan%20mengenai..." 
       target="_blank" 
       rel="noopener noreferrer" 
       class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-[#25D366] text-white rounded-full shadow-lg shadow-green-200/80 hover:bg-[#20ba5a] hover:scale-110 active:scale-95 transition-all duration-300 group cursor-pointer"
       title="Hubungi Helpdesk via WhatsApp">
        
        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.66.986 3.288 1.488 4.654 1.493 5.433-.002 9.85-4.42 9.853-9.857.002-2.633-1.02-5.107-2.879-6.968C16.357 1.961 13.882 1.94 11.99 1.94c-5.438 0-9.856 4.416-9.859 9.856-.002 1.753.465 3.14 1.39 4.708l-.927 3.385 3.463-.909zM16.9 14.39c-.27-.135-1.593-.786-1.84-.875-.246-.09-.425-.135-.605.135-.18.27-.696.875-.853 1.056-.157.18-.314.202-.584.067-.27-.135-1.138-.419-2.167-1.338-.802-.715-1.343-1.6-1.5-1.871-.157-.27-.017-.416.118-.551.121-.122.27-.315.405-.472.135-.157.18-.27.27-.45.09-.18.045-.337-.022-.472-.067-.135-.605-1.457-.828-1.995-.218-.523-.459-.453-.629-.462-.16-.008-.344-.01-.529-.01-.186 0-.489.07-.745.349-.256.278-.979.957-.979 2.335l.002.046c.006 1.3 1.014 2.541 1.155 2.73.14.189 1.938 2.96 4.695 4.15.656.283 1.168.452 1.569.579.66.21 1.261.18 1.736.11.529-.078 1.593-.652 1.817-1.25.225-.597.225-1.11.157-1.218-.067-.108-.247-.152-.517-.287z"/>
        </svg>

        <span class="absolute right-16 bg-gray-900 text-white text-[10px] font-bold uppercase tracking-wider px-2.5 py-1.5 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-200 shadow-md pointer-events-none">
            Butuh Bantuan?
        </span>
    </a>

</body>
</html>