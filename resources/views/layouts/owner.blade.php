<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StayFind Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "background": "#f8f9ff",
                        "primary": "#4648d4",
                        "primary-container": "#6063ee",
                        "on-primary": "#ffffff",
                        "on-surface": "#0b1c30",
                        "on-surface-variant": "#464554",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#eff4ff",
                        "surface-container-high": "#dce9ff",
                        "outline-variant": "#c7c4d7",
                        "tertiary-fixed": "#ffdadb",
                        "on-tertiary-fixed-variant": "#92002a",
                        "primary-fixed": "#e1e0ff",
                        "on-primary-fixed-variant": "#2f2ebe",
                        "secondary-fixed": "#6ffbbe",
                        "on-secondary-fixed-variant": "#005236",
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
    </style>
    <style>
    /* Mencegah kedipan putih saat berpindah halaman */
    html {
        background-color: #f8f9ff;
    }
    body {
        opacity: 0;
        transition: opacity 0.2s ease-in-out;
    }
    body.page-loaded {
        opacity: 1;
    }
</style>

<script>
    // Begitu dokumen selesai dimuat, tampilkan halaman secara halus
    document.addEventListener("DOMContentLoaded", function() {
        document.body.classList.add('page-loaded');
    });

    // Efek memudar halus saat user mengklik menu lain (sebelum berpindah url)
    window.addEventListener('beforeunload', function() {
        document.body.classList.remove('page-loaded');
    });
</script>
</head>
<body class="bg-background text-on-surface antialiased">

    <div class="flex min-h-screen p-md gap-lg">
        @include('components.sidebar')

        <div class="flex-grow ml-[300px] min-h-screen flex flex-col gap-md">
            @include('components.navbar')
            @include('components.alert')
            
            <main class="flex-grow">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>