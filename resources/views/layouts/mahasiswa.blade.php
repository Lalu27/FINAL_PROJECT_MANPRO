<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StayFind Dashboard')</title>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
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
</head>
<body class="bg-background text-on-surface antialiased overflow-x-hidden min-h-screen">

    <div class="flex p-4 gap-6 max-w-[1440px] mx-auto relative">
        
        <div class="w-72 shrink-0 hidden md:block">
            @include('components.sidebar')
        </div>

        <div class="flex-1 min-w-0 min-h-screen flex flex-col gap-4">
            @include('components.navbar')
            @include('components.alert')
            
            <main class="flex-grow w-full">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>