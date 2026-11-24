<nav x-data="{ open: false }" class="bg-[#0b4377] border-b border-[#00aeef]/30 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-18 py-3">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-white/10 border border-white/20 flex items-center justify-center text-[#00aeef] group-hover:bg-[#00aeef] group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                    <div>
                        <span class="block text-sm font-extrabold text-white tracking-wide uppercase">
                            CNFM Olof Palme
                        </span>
                        <span class="block text-[11px] font-semibold text-[#00aeef]">
                            Promoción de Egresados
                        </span>
                    </div>
                </a>

                <div class="hidden sm:flex sm:items-center sm:ms-10 sm:space-x-2">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('dashboard') || request()->routeIs('graduates.group') ? 'bg-white/15 text-white border border-white/20' : 'text-slate-200 hover:text-white hover:bg-white/10' }} transition-all">
                        Grupos y Egresados
                    </a>
                    <a href="{{ route('graduates.import.create') }}" class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('graduates.import.create') ? 'bg-white/15 text-white border border-white/20' : 'text-slate-200 hover:text-white hover:bg-white/10' }} transition-all">
                        Subir Listado Excel
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <div class="text-right pr-2 border-r border-white/15">
                    <p class="text-xs font-bold text-white">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-[#00aeef]">{{ Auth::user()->email }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-xl bg-[#e91e63] hover:bg-[#c2185b] text-white text-xs font-bold uppercase tracking-wider shadow-sm transition-all gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-white hover:bg-white/10 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#083259] border-t border-white/10 px-4 pt-3 pb-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('dashboard') || request()->routeIs('graduates.group') ? 'text-white bg-white/15' : 'text-slate-200' }}">
            Grupos y Egresados
        </a>
        <a href="{{ route('graduates.import.create') }}" class="block px-4 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider {{ request()->routeIs('graduates.import.create') ? 'text-white bg-white/15' : 'text-slate-200' }}">
            Subir Listado Excel
        </a>

        <div class="pt-3 border-t border-white/10 flex items-center justify-between">
            <div>
                <div class="font-bold text-xs text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-[11px] text-[#00aeef]">{{ Auth::user()->email }}</div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center px-3.5 py-2 rounded-xl bg-[#e91e63] text-white text-xs font-bold uppercase tracking-wider gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Cerrar Sesión</span>
                </button>
            </form>
        </div>
    </div>
</nav>