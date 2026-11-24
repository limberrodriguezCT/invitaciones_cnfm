<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-extrabold text-[#0b4377]">Iniciar Sesión</h2>
        <p class="text-xs text-slate-500 mt-1">Ingresa tus credenciales institucionales para administrar el evento</p>
    </div>

    @if (session('status'))
        <div class="mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                Correo Electrónico
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@cnfm.edu.ni"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 focus:border-[#00aeef] focus:ring-2 focus:ring-[#00aeef]/20 transition-all outline-none">
            @error('email')
                <p class="mt-1.5 text-xs font-semibold text-[#e91e63]">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                Contraseña
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm text-slate-800 focus:border-[#00aeef] focus:ring-2 focus:ring-[#00aeef]/20 transition-all outline-none">
            @error('password')
                <p class="mt-1.5 text-xs font-semibold text-[#e91e63]">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-[#0b4377] focus:ring-[#00aeef]">
            <label for="remember_me" class="ml-2 text-xs font-medium text-slate-600 cursor-pointer">
                Mantener sesión activa
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#0b4377] to-[#13599b] hover:from-[#083259] hover:to-[#0b4377] text-white text-xs font-extrabold uppercase tracking-widest shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                <span>Ingresar al Panel</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </button>
        </div>
    </form>
</x-guest-layout>