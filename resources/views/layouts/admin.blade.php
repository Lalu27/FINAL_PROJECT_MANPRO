<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Workspace - StayFind')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "background": "#f8f9fb", "primary": "#0058be", "primary-container": "#2170e4",
                        "on-primary": "#ffffff", "on-surface": "#191c1e", "on-surface-variant": "#424754",
                        "surface-container-lowest": "#ffffff", "surface-container-low": "#f3f4f6",
                        "surface-container-high": "#e7e8ea", "outline-variant": "#c2c6d6"
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
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