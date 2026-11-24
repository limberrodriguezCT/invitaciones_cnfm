<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-[#0b4377] leading-tight">
                    Gestión de Promoción de Egresados
                </h2>
                <p class="text-xs font-bold text-[#00aeef] uppercase tracking-wider mt-0.5">
                    Centro Nacional de Formación de Maestras y Maestros
                </p>
            </div>

            <a href="{{ route('graduates.import.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#0b4377] hover:bg-[#083259] text-white text-xs font-bold uppercase tracking-wider rounded-xl shadow-sm transition-all gap-2">
                <svg class="w-4 h-4 text-[#00aeef]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <span>Importar Nuevo Grupo</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-600 p-5 rounded-r-2xl shadow-sm flex items-start space-x-3.5">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-extrabold text-emerald-900 uppercase tracking-wide">Operación Exitosa</p>
                        <p class="text-sm font-medium text-emerald-800 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Indicadores Globales -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 border-b-4 border-b-[#0b4377] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Egresados</p>
                        <p class="text-3xl font-black text-[#0b4377] mt-1">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[#0b4377]/10 flex items-center justify-center text-[#0b4377]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 border-b-4 border-b-[#00aeef] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Asistencia Confirmada</p>
                        <p class="text-3xl font-black text-[#00aeef] mt-1">{{ $stats['confirmados'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[#00aeef]/10 flex items-center justify-center text-[#00aeef]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 border-b-4 border-b-[#e91e63] flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Pendientes por Confirmar</p>
                        <p class="text-3xl font-black text-[#e91e63] mt-1">{{ $stats['pendientes'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-[#e91e63]/10 flex items-center justify-center text-[#e91e63]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Sección de Grupos Creados en Cards -->
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h3 class="text-lg font-extrabold text-[#0b4377]">Grupos Registrados</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Selecciona un grupo para visualizar a sus egresados, verificar confirmaciones y copiar los enlaces de invitación.</p>
                    </div>
                    <span class="px-3.5 py-1 rounded-full bg-slate-200/70 text-slate-700 text-xs font-bold">
                        {{ $groups->count() }} {{ $groups->count() === 1 ? 'Grupo' : 'Grupos' }}
                    </span>
                </div>

                @if($groups->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($groups as $group)
                            <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-200/80 hover:border-[#00aeef]/50 transition-all duration-300 flex flex-col justify-between overflow-hidden group">
                                <div>
                                    <div class="h-1.5 bg-gradient-to-r from-[#0b4377] via-[#00aeef] to-[#e91e63]"></div>
                                    <div class="p-6">
                                        <div class="flex items-center justify-between gap-2 mb-4">
                                            <span class="px-3 py-1 rounded-lg bg-[#0b4377]/10 text-[#0b4377] font-mono text-xs font-extrabold tracking-wide">
                                                {{ $group['codigo_grupo'] }}
                                            </span>
                                            <span class="text-xs font-extrabold text-[#00aeef]">
                                                {{ $group['porcentaje'] }}% Confirmado
                                            </span>
                                        </div>

                                        <h4 class="text-base font-extrabold text-slate-900 leading-snug line-clamp-2 min-h-[2.75rem]">
                                            {{ $group['carrera'] }}
                                        </h4>

                                        <!-- Barra de Progreso -->
                                        <div class="mt-5">
                                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                                <div class="bg-gradient-to-r from-[#0b4377] to-[#00aeef] h-2 rounded-full transition-all duration-500" style="width: {{ $group['porcentaje'] }}%"></div>
                                            </div>
                                        </div>

                                        <!-- Contadores del Grupo -->
                                        <div class="grid grid-cols-3 gap-2 mt-5 pt-4 border-t border-slate-100 text-center">
                                            <div class="p-2 rounded-xl bg-slate-50">
                                                <p class="text-[10px] font-bold uppercase text-slate-400">Total</p>
                                                <p class="text-base font-black text-[#0b4377] mt-0.5">{{ $group['total'] }}</p>
                                            </div>
                                            <div class="p-2 rounded-xl bg-emerald-50/70">
                                                <p class="text-[10px] font-bold uppercase text-emerald-600">Confirmados</p>
                                                <p class="text-base font-black text-emerald-700 mt-0.5">{{ $group['confirmados'] }}</p>
                                            </div>
                                            <div class="p-2 rounded-xl bg-amber-50/70">
                                                <p class="text-[10px] font-bold uppercase text-amber-600">Pendientes</p>
                                                <p class="text-base font-black text-amber-700 mt-0.5">{{ $group['pendientes'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-6 pb-6">
                                    <a href="{{ route('graduates.group', $group['codigo_grupo']) }}" class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl bg-slate-900 group-hover:bg-[#0b4377] text-white text-xs font-bold uppercase tracking-wider transition-colors gap-2">
                                        <span>Ver Listado del Grupo</span>
                                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-2xl p-12 text-center border border-slate-100 shadow-sm">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <h4 class="text-base font-bold text-slate-700">Aún no existen grupos creados</h4>
                        <p class="text-sm text-slate-500 mt-1 mb-5">Dirígete a la sección de carga para importar tu primer listado oficial en formato Excel.</p>
                        <a href="{{ route('graduates.import.create') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-[#0b4377] hover:bg-[#083259] text-white text-xs font-bold uppercase tracking-wider transition-all gap-2">
                            <span>Ir a Subir Listado Excel</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>