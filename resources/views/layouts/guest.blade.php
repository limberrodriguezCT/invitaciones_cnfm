<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Acceso Administrativo - CNFM</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
                background-color: #0b162c;
                background-image: 
                    radial-gradient(circle at 15% 20%, rgba(0, 174, 239, 0.16) 0%, transparent 45%),
                    radial-gradient(circle at 85% 80%, rgba(233, 30, 99, 0.16) 0%, transparent 45%),
                    url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 18h-2v-2h2v2zm-2 2v2h2v-2h-2zm2 2h2v-2h-2v2zm2-2v-2h-2v2h2z' fill='%231e293b' fill-opacity='0.6' fill-rule='evenodd'/%3E%3C/svg%3E");
            }

            @keyframes fadeSlideUp {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .anim-login-card {
                animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            }
        </style>
    </head>
    <body class="antialiased text-slate-900 selection:bg-[#00aeef] selection:text-white">
        <div class="min-h-screen flex flex-col justify-center items-center p-6">
            <div class="w-full sm:max-w-md anim-login-card">
                <div class="text-center mb-8">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-[#00aeef] shadow-lg mb-4">
                        <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                    <h1 class="text-sm font-extrabold uppercase tracking-[0.2em] text-[#00aeef]">
                        Centro Nacional de Formación
                    </h1>
                    <p class="text-xs font-medium text-slate-300 mt-1">
                        de Maestras y Maestros - Sede Olof Palme
                    </p>
                </div>

                <div class="bg-white rounded-3xl shadow-[0_25px_70px_rgba(0,0,0,0.6)] overflow-hidden border border-white/10">
                    <div class="h-2 bg-gradient-to-r from-[#0b4377] via-[#00aeef] to-[#e91e63]"></div>
                    <div class="px-8 py-9">
                        {{ $slot }}
                    </div>
                </div>

                <p class="text-center text-[11px] font-medium text-slate-400 uppercase tracking-widest mt-6">
                    Sistema de Gestión de Invitaciones y Promoción
                </p>
            </div>
        </div>
    </body>
</html>