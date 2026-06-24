@extends('layouts.app')

@section('title', 'Login - StayFind')

@section('content')
<!-- Konfigurasi Token Warna & Spacing Material 3 khusus Halaman Login -->
<script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "outline": "#767586",
                    "tertiary-container": "#dc2c4f",
                    "on-primary-fixed-variant": "#2f2ebe",
                    "surface-variant": "#d3e4fe",
                    "secondary-container": "#6cf8bb",
                    "background": "#f8f9ff",
                    "primary": "#4648d4",
                    "on-surface": "#0b1c30",
                    "on-secondary": "#ffffff",
                    "inverse-surface": "#213145",
                    "surface-container-highest": "#d3e4fe",
                    "surface-bright": "#f8f9ff",
                    "primary-fixed": "#e1e0ff",
                    "on-primary": "#ffffff",
                    "tertiary-fixed-dim": "#ffb2b7",
                    "on-primary-fixed": "#07006c",
                    "surface-tint": "#494bd6",
                    "secondary-fixed-dim": "#4edea3",
                    "on-error-container": "#93000a",
                    "secondary": "#006c49",
                    "surface-container-high": "#dce9ff",
                    "on-primary-container": "#fffbff",
                    "error": "#ba1a1a",
                    "surface-container": "#e5eeff",
                    "inverse-on-surface": "#eaf1ff",
                    "outline-variant": "#c7c4d7",
                    "on-tertiary-fixed": "#40000d",
                    "surface-container-lowest": "#ffffff",
                    "inverse-primary": "#c0c1ff",
                    "tertiary": "#b90538",
                    "error-container": "#ffdad6",
                    "primary-fixed-dim": "#c0c1ff",
                    "surface": "#f8f9ff",
                    "on-secondary-fixed-variant": "#005236",
                    "tertiary-fixed": "#ffdadb",
                    "on-tertiary-fixed-variant": "#92002a",
                    "primary-container": "#6063ee",
                    "on-surface-variant": "#464554",
                    "on-secondary-fixed": "#002113",
                    "on-tertiary-container": "#fffbff",
                    "on-secondary-container": "#00714d",
                    "secondary-fixed": "#6ffbbe",
                    "surface-dim": "#cbdbf5",
                    "on-background": "#0b1c30",
                    "on-error": "#ffffff",
                    "surface-container-low": "#eff4ff",
                    "on-tertiary": "#ffffff"
                },
                "borderRadius": {
                    "DEFAULT": "1rem",
                    "lg": "2rem",
                    "xl": "3rem",
                    "full": "9999px"
                },
                "spacing": {
                    "xs": "4px",
                    "md": "16px",
                    "xl": "32px",
                    "lg": "24px",
                    "base": "4px",
                    "container-max": "1280px",
                    "sm": "8px",
                    "gutter": "24px"
                }
            },
        },
    }
</script>

<style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    .login-card {
        box-shadow: 0px 4px 20px rgba(15, 23, 42, 0.05);
    }
    input:focus {
        box-shadow: 0 0 0 4px rgba(70, 72, 212, 0.1) !important;
    }
</style>

<div class="bg-background w-full min-h-[85vh] flex flex-col items-center justify-center p-xl">
    <main class="w-full max-w-[440px] flex flex-col gap-lg">
        
        <!-- Branding Header -->
        <header class="flex flex-col items-center gap-sm mb-2">
            <div class="flex items-center gap-xs">
                <span class="material-symbols-outlined text-primary text-[32px]">home_work</span>
                <h1 class="text-2xl font-extrabold text-primary tracking-tight">StayFind</h1>
            </div>
            <p class="text-sm text-on-surface-variant text-center px-6 text-gray-500">
                Temukan hunian terbaik untuk perjalanan studi Anda dengan mudah dan aman.
            </p>
        </header>

        <!-- Main Form Card -->
        <section class="bg-white login-card rounded-xl p-md md:p-lg border border-gray-100 shadow-xl">
            <div class="flex flex-col gap-md">
                <div class="flex flex-col gap-xs mb-2">
                    <h2 class="text-xl font-bold text-on-surface">Selamat Datang</h2>
                    <p class="text-xs text-on-surface-variant text-gray-400">Silakan masuk ke akun Anda</p>
                </div>

                <!-- Display Errors validasi backend -->
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2.5 rounded-lg text-xs">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <!-- Form Login -->
                <form action="{{ url('/login') }}" method="POST" class="flex flex-col gap-md space-y-3">
                    @csrf
                    
                    <!-- Email -->
                    <div class="flex flex-col gap-xs">
                        <label class="text-xs font-semibold text-on-surface-variant ml-1" for="email">Email</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pl-1">mail</span>
                            <input class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" id="email" name="email" value="{{ old('email') }}" placeholder="name@email.com" type="email" required/>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-xs">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-xs font-semibold text-on-surface-variant" for="password">Kata Sandi</label>
                            <a class="text-xs text-primary hover:underline font-medium" href="#">Lupa Kata Sandi?</a>
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pl-1">lock</span>
                            <input class="w-full pl-11 pr-11 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm" id="password" name="password" placeholder="••••••••" type="password" required/>
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-on-surface transition-colors pr-1 flex items-center" type="button" id="togglePasswordBtn">
                                <span class="material-symbols-outlined" id="visibilityIcon">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button type="submit" class="w-full bg-primary text-white py-3 px-4 rounded-lg font-bold shadow-md hover:bg-opacity-90 active:scale-[0.98] transition-all mt-4 text-sm">
                        Masuk
                    </button>
                </form>

                <!-- Divider -->
                <div class="flex items-center gap-md py-sm mt-3">
                    <div class="h-[1px] bg-gray-200 flex-1"></div>
                    <span class="text-[10px] text-gray-400 uppercase tracking-wider font-semibold mx-2">Atau masuk dengan</span>
                    <div class="h-[1px] bg-gray-200 flex-1"></div>
                </div>

                <!-- Social Login -->
                <button type="button" class="w-full flex items-center justify-center gap-2 bg-white border border-gray-200 py-3 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-all">
                    <svg class="w-4 h-4 mr-1 inline" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 1.2-4.53z" fill="#EA4335"></path>
                    </svg>
                    Google
                </button>
            </div>
        </section>

        <!-- Footer Link -->
        <footer class="flex justify-center items-center gap-xs text-sm text-gray-500 mt-2">
            Belum punya akun?&nbsp;
            <a class="text-primary font-bold hover:underline" href="{{ route('register') }}">Daftar di sini</a>
        </footer>
    </main>
</div>

<script>
    // Toggle Password Visibility
    const togglePasswordBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const visibilityIcon = document.getElementById('visibilityIcon');

    if (togglePasswordBtn) {
        togglePasswordBtn.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            visibilityIcon.innerText = type === 'password' ? 'visibility' : 'visibility_off';
        });
    }
</script>
@endsection