@php
    // VARIABLES EDITABLES DEL EVENTO (Modificar cuando se definan fecha y hora)
    $fechaEvento   = 'Fecha por confirmar';
    $horaEvento    = 'Hora por confirmar';
    $lugarEvento   = 'Universidad Nacional Francisco Luis Espinoza, Recinto Universitario Dr. Alejandro Dávila Bolaños';
    $urlMapaApp    = 'https://maps.app.goo.gl/wSsojG8QCnjZ1dPX9';
    $urlMapaEmbed  = 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d297.81011594244666!2d-86.36506220994059!3d13.139588835063241!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f718d9329e42623%3A0x8ca94699ba2f2dad!2sUNFLEP%2C%20Universidad%20Nacional%20Luis%20Francisco%20Espinoza%20Pineda!5e1!3m2!1ses!2sni!4v1795534679025!5m2!1ses!2sni';
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Invitación de Promoción - {{ $graduate->nombre_completo }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b162c;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 174, 239, 0.18) 0%, transparent 45%),
                radial-gradient(circle at 90% 80%, rgba(233, 30, 99, 0.18) 0%, transparent 45%),
                url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M20 18h-2v-2h2v2zm-2 2v2h2v-2h-2zm2 2h2v-2h-2v2zm2-2v-2h-2v2h2z' fill='%231e293b' fill-opacity='0.6' fill-rule='evenodd'/%3E%3C/svg%3E");
        }

        .font-serif-display {
            font-family: 'Playfair Display', serif;
        }

        @keyframes fadeUpReveal {
            0% {
                opacity: 0;
                transform: translateY(28px) scale(0.98);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes popPassReveal {
            0% {
                opacity: 0;
                transform: scale(0.84) translateY(24px);
            }
            70% {
                opacity: 1;
                transform: scale(1.02) translateY(-4px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes shimmerBorder {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.45); }
            50% { box-shadow: 0 0 0 14px rgba(16, 185, 129, 0); }
        }

        .anim-card {
            animation: fadeUpReveal 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .anim-pass-modal {
            animation: popPassReveal 0.65s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .anim-delay-1 {
            opacity: 0;
            animation: fadeUpReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.2s forwards;
        }

        .anim-delay-2 {
            opacity: 0;
            animation: fadeUpReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.4s forwards;
        }

        .anim-delay-3 {
            opacity: 0;
            animation: fadeUpReveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.6s forwards;
        }

        .borde-luminoso {
            background: linear-gradient(90deg, #0b4377, #00aeef, #e91e63, #00aeef, #0b4377);
            background-size: 300% 300%;
            animation: shimmerBorder 6s ease infinite;
        }

        .borde-dorado-gala {
            background: linear-gradient(120deg, #00aeef, #f59e0b, #e91e63, #10b981, #00aeef);
            background-size: 300% 300%;
            animation: shimmerBorder 5s ease infinite;
        }

        .emblema-flotante {
            animation: floatSlow 4s ease-in-out infinite;
        }

        .sello-confirmado {
            animation: pulseGlow 2.2s infinite;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6 md:p-10 antialiased selection:bg-[#00aeef] selection:text-white">

    <main class="w-full max-w-3xl anim-card">
        <div class="p-[2px] rounded-3xl borde-luminoso shadow-[0_30px_80px_rgba(0,0,0,0.65)]">
            <div class="bg-white rounded-[22px] overflow-hidden relative">

                <header class="bg-gradient-to-br from-[#0b4377] via-[#0f172a] to-[#0b4377] px-6 py-10 md:px-12 text-center relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-64 h-64 rounded-full bg-[#00aeef]/10 blur-2xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 rounded-full bg-[#e91e63]/15 blur-2xl"></div>

                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-[#00aeef] mb-5 emblema-flotante shadow-lg">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                            </svg>
                        </div>

                        <p class="text-xs sm:text-sm font-bold uppercase tracking-[0.22em] text-[#00aeef]">
                            Centro Nacional de Formación de Maestras y Maestros
                        </p>
                        <p class="text-xs font-medium text-slate-300 mt-1">
                            Sede Centro Tecnológico Olof Palme
                        </p>

                        <div class="mt-6 inline-flex items-center px-4 py-1.5 rounded-full bg-white/10 border border-white/15">
                            <span class="text-[11px] font-bold uppercase tracking-[0.2em] text-white">
                                Acto Solemne de Promoción
                            </span>
                        </div>
                    </div>
                </header>

                <section class="px-6 py-10 md:px-14 md:py-12 text-center">
                    
                    <div class="anim-delay-1">
                        <p class="text-xs font-extrabold uppercase tracking-[0.25em] text-[#e91e63] mb-3">
                            Con orgullo celebramos la culminación de sus estudios
                        </p>

                        <h1 class="font-serif-display text-3xl sm:text-4xl md:text-5xl font-bold text-[#0b4377] leading-tight">
                            {{ $graduate->nombre_completo }}
                        </h1>

                        <div class="mt-3 flex flex-wrap items-center justify-center gap-2">
                            <span class="px-3 py-1 rounded-md bg-slate-100 text-slate-600 text-xs font-mono font-semibold">
                                Código: {{ $graduate->codigo }}
                            </span>
                            @if($graduate->grupo)
                                <span class="px-3 py-1 rounded-md bg-[#0b4377]/10 text-[#0b4377] text-xs font-mono font-semibold">
                                    Grupo: {{ $graduate->grupo }}
                                </span>
                            @endif
                        </div>

                        <p class="mt-6 text-sm sm:text-base text-slate-600 max-w-xl mx-auto leading-relaxed">
                            El Centro Nacional de Formación de Maestras y Maestros tiene el honor de invitarle a la ceremonia oficial de graduación por haber finalizado satisfactoriamente la carrera de:
                        </p>

                        <div class="mt-5 p-5 rounded-2xl bg-gradient-to-r from-slate-50 via-[#00aeef]/10 to-slate-50 border border-[#00aeef]/25">
                            <h2 class="text-lg sm:text-xl md:text-2xl font-extrabold text-[#0b4377] tracking-tight">
                                {{ $graduate->carrera }}
                            </h2>
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 gap-4 text-left anim-delay-2">
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start space-x-3.5">
                            <div class="w-10 h-10 rounded-xl bg-[#0b4377]/10 text-[#0b4377] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Fecha del Evento</p>
                                <p class="text-sm font-bold text-slate-800 mt-0.5">{{ $fechaEvento }}</p>
                            </div>
                        </div>

                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start space-x-3.5">
                            <div class="w-10 h-10 rounded-xl bg-[#00aeef]/15 text-[#0b4377] flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Hora de Inicio</p>
                                <p class="text-sm font-bold text-slate-800 mt-0.5">{{ $horaEvento }}</p>
                            </div>
                        </div>

                        <div class="sm:col-span-2 p-5 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-4">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex items-start space-x-3.5">
                                    <div class="w-10 h-10 rounded-xl bg-[#e91e63]/10 text-[#e91e63] flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Sede de la Ceremonia</p>
                                        <p class="text-sm font-bold text-slate-800 mt-0.5 leading-snug">{{ $lugarEvento }}</p>
                                    </div>
                                </div>

                                <a href="{{ $urlMapaApp }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-3.5 py-2 rounded-xl bg-white hover:bg-[#0b4377] text-[#0b4377] hover:text-white border border-slate-200 hover:border-[#0b4377] text-[11px] font-bold uppercase tracking-wider shadow-xs transition-all shrink-0 gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                    <span>Ampliar Mapa</span>
                                </a>
                            </div>

                            <div class="w-full h-64 sm:h-72 rounded-xl overflow-hidden border border-slate-200 shadow-inner bg-slate-200">
                                <iframe
                                    src="{{ $urlMapaEmbed }}"
                                    class="w-full h-full border-0"
                                    allowfullscreen=""
                                    loading="lazy"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    title="Ubicación de la Sede de Ceremonia">
                                </iframe>
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 pt-8 border-t border-slate-100 anim-delay-3">
                        @if(!$graduate->asistencia_confirmada)
                            <div id="confirmation-pending">
                                <p class="text-xs font-semibold text-slate-500 mb-4">
                                    Por favor, confirma tu participación para reservar tu lugar en el acto de promoción.
                                </p>
                                <button id="btn-confirmar" type="button" class="w-full sm:w-auto inline-flex items-center justify-center px-10 py-4 rounded-full bg-gradient-to-r from-[#e91e63] to-[#c2185b] hover:from-[#c2185b] hover:to-[#a3134b] text-white text-sm font-extrabold uppercase tracking-widest shadow-[0_12px_30px_rgba(233,30,99,0.4)] hover:shadow-[0_16px_35px_rgba(233,30,99,0.55)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span id="btn-confirmar-text">Confirmar Mi Asistencia</span>
                                </button>
                                <p id="confirmation-error" class="hidden text-xs font-bold text-[#e91e63] mt-3"></p>
                            </div>
                        @endif

                        <!-- Mensaje Confirmado en Página -->
                        <div id="confirmation-success" class="{{ $graduate->asistencia_confirmada ? 'block' : 'hidden' }} transition-all duration-500">
                            <div class="inline-flex flex-col items-center justify-center px-8 py-7 rounded-2xl bg-gradient-to-b from-emerald-50 to-white border-2 border-emerald-200 max-w-md mx-auto shadow-sm">
                                <div class="w-14 h-14 rounded-full bg-emerald-600 text-white flex items-center justify-center mb-3.5 shadow-md sello-confirmado">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <span class="px-3 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase tracking-widest mb-2">
                                    Pase Oficial Validado
                                </span>
                                <h3 class="text-lg font-extrabold text-[#0b4377] uppercase tracking-wide">
                                    Felicidades, Asistencia Confirmada
                                </h3>
                                <p class="text-xs text-slate-600 font-medium mt-1.5 leading-relaxed">
                                    Tu lugar ya se encuentra reservado oficialmente para la ceremonia de promoción. No es necesario volver a confirmar.
                                </p>
                                <p id="confirmed-timestamp" class="text-[11px] font-mono font-semibold text-emerald-700 mt-4 bg-emerald-50 px-4 py-1.5 rounded-full border border-emerald-200">
                                    Confirmado el: {{ $graduate->confirmado_en ? $graduate->confirmado_en->format('d/m/Y h:i A') : '' }}
                                </p>

                                <button type="button" onclick="openCelebrationModal()" class="mt-4 inline-flex items-center px-4 py-2 rounded-xl bg-[#0b4377] hover:bg-[#083259] text-white text-[11px] font-bold uppercase tracking-wider shadow-xs transition-all gap-2">
                                    <svg class="w-4 h-4 text-[#00aeef]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                    </svg>
                                    <span>Ver Credencial de Ingreso</span>
                                </button>
                            </div>
                        </div>
                    </div>

                </section>

                <footer class="bg-slate-50 px-6 py-4 border-t border-slate-100 text-center">
                    <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-widest">
                        Educación Técnica y Formación Docente de Calidad
                    </p>
                </footer>

            </div>
        </div>
    </main>

    <!-- Ventana Emergente Celebratoria de Alto Impacto UI/UX -->
    <div id="celebration-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-[#060d1b]/85 backdrop-blur-md">
        <div class="w-full max-w-md anim-pass-modal">
            <div class="p-[2.5px] rounded-3xl borde-dorado-gala shadow-[0_25px_70px_rgba(0,174,239,0.35)]">
                <div class="bg-gradient-to-b from-[#0b4377] via-[#0f172a] to-[#0b162c] rounded-[22px] text-white overflow-hidden relative">
                    <div class="absolute -top-20 -right-20 w-56 h-56 rounded-full bg-[#00aeef]/20 blur-2xl pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-20 w-56 h-56 rounded-full bg-[#e91e63]/20 blur-2xl pointer-events-none"></div>

                    <div class="p-7 sm:p-8 text-center relative z-10">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-400 text-white flex items-center justify-center mx-auto mb-4 shadow-lg sello-confirmado">
                            <svg class="w-9 h-9" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.6" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>

                        <span class="inline-block px-3.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-[10px] font-extrabold uppercase tracking-[0.22em] mb-2">
                            Registro Oficial Exitoso
                        </span>

                        <h2 class="font-serif-display text-2xl sm:text-3xl font-bold text-white leading-tight">
                            ¡Nos vemos en tu Graduación!
                        </h2>

                        <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                            Tu asistencia ha quedado registrada en el padrón oficial de egresados. Guarda una captura de tu pase digital.
                        </p>

                        <!-- Tarjeta Tipo Boleto / Credencial VIP -->
                        <div class="mt-6 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-5 text-left relative">
                            <div class="flex items-center justify-between border-b border-dashed border-white/20 pb-3 mb-3">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-widest text-[#00aeef]">Pase de Egresado</p>
                                    <p class="text-xs font-extrabold text-white mt-0.5">CNFM OLOF PALME</p>
                                </div>
                                <span class="px-2.5 py-1 rounded-lg bg-white/15 font-mono text-xs font-extrabold text-amber-300">
                                    {{ $graduate->codigo }}
                                </span>
                            </div>

                            <div class="space-y-2.5">
                                <div>
                                    <p class="text-[10px] uppercase tracking-wider text-slate-400">Protagonista</p>
                                    <p class="text-sm font-extrabold text-white leading-snug">{{ $graduate->nombre_completo }}</p>
                                </div>

                                <div>
                                    <p class="text-[10px] uppercase tracking-wider text-slate-400">Carrera</p>
                                    <p class="text-xs font-bold text-[#00aeef] leading-snug">{{ $graduate->carrera }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-2 pt-1">
                                    <div>
                                        <p class="text-[10px] uppercase tracking-wider text-slate-400">Grupo</p>
                                        <p class="text-xs font-mono font-bold text-slate-200">{{ $graduate->grupo ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] uppercase tracking-wider text-slate-400">Validado el</p>
                                        <p id="modal-confirmed-timestamp" class="text-[11px] font-mono font-bold text-emerald-300">
                                            {{ $graduate->confirmado_en ? $graduate->confirmado_en->format('d/m/Y h:i A') : '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="closeCelebrationModal()" class="mt-6 w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#00aeef] to-[#0284c7] hover:from-[#0284c7] hover:to-[#0369a1] text-white text-xs font-extrabold uppercase tracking-widest shadow-lg transition-all">
                            Continuar a mi Invitación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const yaConfirmado = @json($graduate->asistencia_confirmada);

        function lanzarCelebracion() {
            const colors = ['#0b4377', '#00aeef', '#e91e63', '#10b981', '#f59e0b'];
            confetti({
                particleCount: 85,
                angle: 60,
                spread: 70,
                origin: { x: 0, y: 0.7 },
                colors: colors,
                zIndex: 100
            });
            confetti({
                particleCount: 85,
                angle: 120,
                spread: 70,
                origin: { x: 1, y: 0.7 },
                colors: colors,
                zIndex: 100
            });
        }

        function openCelebrationModal() {
            const modal = document.getElementById('celebration-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            lanzarCelebracion();
        }

        function closeCelebrationModal() {
            const modal = document.getElementById('celebration-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            const successBox = document.getElementById('confirmation-success');
            if (successBox) {
                successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        document.getElementById('celebration-modal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeCelebrationModal();
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(lanzarCelebracion, 450);

            if (yaConfirmado) {
                const successBox = document.getElementById('confirmation-success');
                setTimeout(() => {
                    successBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 700);
            }
        });

        const btnConfirmar = document.getElementById('btn-confirmar');
        if (btnConfirmar) {
            btnConfirmar.addEventListener('click', function () {
                const btnText = document.getElementById('btn-confirmar-text');
                const errorText = document.getElementById('confirmation-error');

                btnConfirmar.disabled = true;
                btnConfirmar.classList.add('opacity-75', 'cursor-not-allowed');
                btnText.textContent = 'Registrando Confirmación...';
                errorText.classList.add('hidden');

                fetch('{{ route("invitation.confirm", $graduate) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(async response => {
                    const data = await response.json();
                    if (response.ok || response.status === 409) {
                        const pendingBox = document.getElementById('confirmation-pending');
                        if (pendingBox) {
                            pendingBox.remove();
                        }

                        const successBox = document.getElementById('confirmation-success');
                        document.getElementById('confirmed-timestamp').textContent = 'Confirmado el: ' + data.confirmado_en;
                        document.getElementById('modal-confirmed-timestamp').textContent = data.confirmado_en;

                        successBox.classList.remove('hidden');
                        successBox.classList.add('anim-card');

                        openCelebrationModal();
                    } else {
                        throw new Error('Error en la validación');
                    }
                })
                .catch(() => {
                    btnConfirmar.disabled = false;
                    btnConfirmar.classList.remove('opacity-75', 'cursor-not-allowed');
                    btnText.textContent = 'Confirmar Mi Asistencia';
                    errorText.textContent = 'No se pudo completar el registro. Verifica tu conexión e intenta nuevamente.';
                    errorText.classList.remove('hidden');
                });
            });
        }
    </script>
</body>
</html>