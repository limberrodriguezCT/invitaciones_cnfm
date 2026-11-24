<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-extrabold text-xl text-[#0b4377] leading-tight">
                    Importar Listado Oficial por Grupo
                </h2>
                <p class="text-xs font-bold text-[#00aeef] uppercase tracking-wider mt-0.5">
                    Carga de Padrón de Egresados INATEC
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider transition-colors gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Volver a Grupos</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('error') || $errors->any())
                <div class="bg-rose-50 border-l-4 border-[#e91e63] p-5 rounded-r-2xl shadow-sm flex items-start space-x-3.5">
                    <svg class="w-6 h-6 text-[#e91e63] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-extrabold text-rose-900 uppercase tracking-wide">Error al Procesar el Archivo</p>
                        @if(session('error'))
                            <p class="text-sm font-medium text-rose-800 mt-1">{{ session('error') }}</p>
                        @endif
                        @foreach($errors->all() as $error)
                            <p class="text-sm font-medium text-rose-800 mt-1">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="h-2 bg-gradient-to-r from-[#0b4377] via-[#00aeef] to-[#e91e63]"></div>

                <div class="p-8 md:p-10">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-14 h-14 rounded-2xl bg-[#0b4377]/10 text-[#0b4377] flex items-center justify-center shrink-0">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-extrabold text-[#0b4377]">Cargar Archivo Excel del Grupo</h3>
                            <p class="text-xs text-slate-500 mt-0.5">Formato compatible: Reporte oficial "LISTADO ESTUDIANTE/PROTAGONISTA POR GRUPO"</p>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 mb-8">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#0b4377] mb-2">Validaciones Automáticas Incluidas</p>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            El sistema extrae automáticamente el nombre de la carrera desde el encabezado <span class="font-bold text-slate-800">Evento:</span> y el identificador desde <span class="font-bold text-slate-800">Grupo:</span>. Asimismo, filtra únicamente participantes en estado <span class="font-bold text-slate-800">Activo</span>, asigna códigos a matrículas de caso especial y actualiza registros previos sin borrar confirmaciones de asistencia ya realizadas.
                        </p>
                    </div>

                    <form id="import-form" action="{{ route('graduates.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label for="archivo_excel" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                                Seleccionar Archivo (.xlsx, .xls o .csv)
                            </label>
                            <input id="archivo_excel" type="file" name="archivo_excel" accept=".xlsx,.xls,.csv" required class="block w-full text-sm text-slate-600 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:uppercase file:tracking-wider file:bg-[#0b4377] file:text-white hover:file:bg-[#083259] border-2 border-dashed border-slate-300 hover:border-[#00aeef] rounded-2xl p-3 cursor-pointer transition-colors">
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row items-center justify-end gap-3">
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto text-center px-6 py-3.5 rounded-xl border border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50 transition-colors">
                                Cancelar
                            </a>
                            <button id="btn-importar" type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-gradient-to-r from-[#0b4377] to-[#13599b] hover:from-[#083259] hover:to-[#0b4377] text-white text-xs font-extrabold uppercase tracking-widest rounded-xl shadow-md transition-all gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                <span id="btn-importar-text">Procesar y Guardar Grupo</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('import-form').addEventListener('submit', function () {
            const btn = document.getElementById('btn-importar');
            const text = document.getElementById('btn-importar-text');
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            text.textContent = 'Procesando Archivo...';
        });
    </script>
</x-app-layout>