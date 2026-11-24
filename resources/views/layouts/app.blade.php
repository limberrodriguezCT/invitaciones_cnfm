<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Panel de Promoción - CNFM</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900 selection:bg-[#00aeef] selection:text-white">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white border-b border-slate-200/80 shadow-xs">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="bg-white border-t border-slate-200/80 py-5 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400 font-medium">
                    <span>Centro Nacional de Formación de Maestras y Maestros</span>
                    <span>Sede Centro Tecnológico Olof Palme</span>
                </div>
            </footer>
        </div>
    </body>
</html>