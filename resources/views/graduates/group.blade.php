<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="px-3 py-1 rounded-lg bg-[#0b4377] text-white font-mono text-xs font-extrabold tracking-wide shadow-xs">
                        {{ $grupo }}
                    </span>
                    <span class="text-xs font-bold text-[#00aeef] uppercase tracking-wider">
                        Detalle del Grupo
                    </span>
                </div>
                <h2 class="font-extrabold text-xl text-[#0b4377] leading-tight mt-1.5">
                    {{ $carrera }}
                </h2>
            </div>

            <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold uppercase tracking-wider transition-colors gap-2 shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Volver a Todos los Grupos</span>
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-600 p-4 rounded-r-2xl shadow-sm flex items-center justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm font-semibold text-emerald-900">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border-l-4 border-[#e91e63] p-4 rounded-r-2xl shadow-sm">
                    <p class="text-xs font-extrabold uppercase tracking-wider text-rose-900">No se pudieron guardar los cambios</p>
                    @foreach($errors->all() as $error)
                        <p class="text-sm font-medium text-rose-800 mt-1">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Bloque Estadístico -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-6">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 1.25rem;">
                    <!-- Total Integrantes -->
                    <div class="rounded-2xl p-5 bg-gradient-to-br from-slate-50 to-white border border-slate-200/80 border-b-4 border-b-[#0b4377] flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Integrantes del Grupo</p>
                            <p class="text-3xl font-black text-[#0b4377] mt-1">{{ $groupStats['total'] }}</p>
                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">Egresados activos</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-[#0b4377]/10 text-[#0b4377] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Confirmados -->
                    <div class="rounded-2xl p-5 bg-gradient-to-br from-emerald-50/40 to-white border border-emerald-200/70 border-b-4 border-b-emerald-500 flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-emerald-700/80">Asistencia Confirmada</p>
                            <div class="flex items-baseline gap-2 mt-1">
                                <p class="text-3xl font-black text-emerald-600">{{ $groupStats['confirmados'] }}</p>
                                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-extrabold">
                                    {{ $groupStats['porcentaje'] }}%
                                </span>
                            </div>
                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">Lugares reservados</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Pendientes -->
                    <div class="rounded-2xl p-5 bg-gradient-to-br from-rose-50/40 to-white border border-rose-200/70 border-b-4 border-b-[#e91e63] flex items-center justify-between">
                        <div>
                            <p class="text-[11px] font-bold uppercase tracking-wider text-rose-700/80">Pendientes por Confirmar</p>
                            <p class="text-3xl font-black text-[#e91e63] mt-1">{{ $groupStats['pendientes'] }}</p>
                            <p class="text-[11px] font-medium text-slate-500 mt-0.5">Sin respuesta aún</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-[#e91e63]/10 text-[#e91e63] flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Barra de Progreso del Grupo -->
                <div class="pt-2">
                    <div class="flex items-center justify-between text-xs font-bold mb-2">
                        <span class="text-slate-500 uppercase tracking-wider">Progreso de Confirmación del Grupo</span>
                        <span class="text-[#0b4377]">{{ $groupStats['confirmados'] }} de {{ $groupStats['total'] }} participantes ({{ $groupStats['porcentaje'] }}%)</span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-[#0b4377] via-[#00aeef] to-emerald-500 rounded-full transition-all duration-500" style="width: {{ $groupStats['porcentaje'] }}%"></div>
                    </div>
                </div>
            </div>

            <!-- Tabla Completa del Grupo -->
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
                <div class="bg-gradient-to-r from-[#0b4377] to-[#13599b] px-6 py-4 flex items-center justify-between">
                    <span class="text-xs font-bold uppercase tracking-widest text-white">
                        Listado Oficial de Invitaciones Personalizadas
                    </span>
                    <span class="bg-white/15 text-white px-3.5 py-1 rounded-full text-xs font-semibold">
                        {{ $groupStats['confirmados'] }} / {{ $groupStats['total'] }} Confirmados
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Código</th>
                                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nombre del Egresado</th>
                                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Estado</th>
                                <th class="px-5 py-3.5 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Confirmación</th>
                                <th class="px-5 py-3.5 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-100">
                            @foreach($students as $student)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-5 py-4 whitespace-nowrap text-xs font-bold text-slate-600 font-mono">
                                        {{ $student->codigo }}
                                        @if($student->caso_especial)
                                            <span class="ml-1.5 px-2 py-0.5 text-[10px] font-bold bg-slate-200 text-slate-700 rounded">Especial</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-sm font-semibold text-slate-900">
                                        {{ $student->nombre_completo }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        @if($student->asistencia_confirmada)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                                Confirmada
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 gap-1.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Pendiente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-xs text-slate-500">
                                        {{ $student->confirmado_en ? $student->confirmado_en->format('d/m/Y h:i A') : 'Sin registrar' }}
                                    </td>
                                    <td class="px-5 py-4 whitespace-nowrap text-right text-xs font-medium space-x-1.5">
                                        <button type="button"
                                            onclick="openEditModal(this)"
                                            data-url="{{ route('graduates.update', $student) }}"
                                            data-codigo="{{ $student->codigo }}"
                                            data-nombre="{{ $student->nombre_completo }}"
                                            data-carrera="{{ $student->carrera }}"
                                            data-grupo="{{ $student->grupo }}"
                                            data-confirmado="{{ $student->asistencia_confirmada ? '1' : '0' }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white border border-amber-200/80 hover:border-amber-500 font-bold rounded-lg transition-colors gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            <span>Editar</span>
                                        </button>

                                        <button type="button" onclick="copyLink('{{ route('invitation.show', $student) }}', this)" class="inline-flex items-center px-3 py-1.5 bg-slate-100 hover:bg-[#00aeef] text-slate-700 hover:text-white font-bold rounded-lg transition-colors gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                            </svg>
                                            <span>Copiar Enlace</span>
                                        </button>

                                        <a href="{{ route('invitation.show', $student) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-[#0b4377]/10 hover:bg-[#0b4377] text-[#0b4377] hover:text-white font-bold rounded-lg transition-colors gap-1">
                                            <span>Abrir</span>
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal de Edición y Confirmación Manual -->
    <div id="edit-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-950/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-200 w-full max-w-lg overflow-hidden transform transition-all">
            <div class="h-1.5 bg-gradient-to-r from-[#0b4377] via-[#00aeef] to-[#e91e63]"></div>

            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-extrabold text-[#0b4377]">Editar Datos y Asistencia</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Actualiza la información o confirma manualmente al egresado.</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="p-2 rounded-xl text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="edit-form" method="POST" action="" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="edit-codigo" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Código Único</label>
                        <input id="edit-codigo" name="codigo" type="text" required class="w-full rounded-xl border-slate-300 focus:border-[#00aeef] focus:ring-[#00aeef] text-sm font-mono font-semibold uppercase">
                    </div>

                    <div>
                        <label for="edit-grupo" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Grupo</label>
                        <input id="edit-grupo" name="grupo" type="text" class="w-full rounded-xl border-slate-300 focus:border-[#00aeef] focus:ring-[#00aeef] text-sm font-mono font-semibold uppercase">
                    </div>
                </div>

                <div>
                    <label for="edit-nombre" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Nombre Completo del Egresado</label>
                    <input id="edit-nombre" name="nombre_completo" type="text" required class="w-full rounded-xl border-slate-300 focus:border-[#00aeef] focus:ring-[#00aeef] text-sm font-semibold uppercase">
                </div>

                <div>
                    <label for="edit-carrera" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Carrera</label>
                    <input id="edit-carrera" name="carrera" type="text" required class="w-full rounded-xl border-slate-300 focus:border-[#00aeef] focus:ring-[#00aeef] text-sm font-semibold uppercase">
                </div>

                <div class="pt-1">
                    <label for="edit-asistencia" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Estado de Asistencia</label>
                    <select id="edit-asistencia" name="asistencia_confirmada" class="w-full rounded-xl border-slate-300 focus:border-[#00aeef] focus:ring-[#00aeef] text-sm font-bold text-slate-800">
                        <option value="1">Asistencia Confirmada (Reservar lugar)</option>
                        <option value="0">Pendiente por Confirmar</option>
                    </select>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl border border-slate-200 text-xs font-bold uppercase tracking-wider text-slate-600 hover:bg-slate-50 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0b4377] hover:bg-[#083259] text-white text-xs font-extrabold uppercase tracking-wider shadow-sm transition-colors">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function copyLink(url, button) {
            navigator.clipboard.writeText(url).then(() => {
                const span = button.querySelector('span');
                const originalText = span.textContent;
                span.textContent = 'Enlace Copiado';
                button.classList.remove('bg-slate-100', 'text-slate-700');
                button.classList.add('bg-emerald-600', 'text-white');

                setTimeout(() => {
                    span.textContent = originalText;
                    button.classList.remove('bg-emerald-600', 'text-white');
                    button.classList.add('bg-slate-100', 'text-slate-700');
                }, 2000);
            });
        }

        function openEditModal(button) {
            const modal = document.getElementById('edit-modal');
            document.getElementById('edit-form').action = button.dataset.url;
            document.getElementById('edit-codigo').value = button.dataset.codigo || '';
            document.getElementById('edit-grupo').value = button.dataset.grupo || '';
            document.getElementById('edit-nombre').value = button.dataset.nombre || '';
            document.getElementById('edit-carrera').value = button.dataset.carrera || '';
            document.getElementById('edit-asistencia').value = button.dataset.confirmado;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal() {
            const modal = document.getElementById('edit-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('edit-modal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</x-app-layout>