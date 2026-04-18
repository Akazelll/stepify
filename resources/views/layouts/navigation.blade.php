<aside
    class="w-64 bg-[#FFFFFF] border-r border-slate-200 hidden md:flex flex-col justify-between h-full shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-10">

    <div>
        <div class="h-20 flex items-center px-8 border-b border-slate-100">
            <a href="{{ route('dashboard') }}"
                class="text-2xl font-bold tracking-tight text-[#14B8A6] flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4" />
                    <polyline points="14 2 14 8 20 8" />
                    <path d="M3 15h6v2H3z" />
                    <path d="M3 11h6v2H3z" />
                </svg>
                Stepify
            </a>
        </div>

        <nav class="px-4 py-6 space-y-1.5">
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#14B8A6]/10 text-[#14B8A6] font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('tutorials.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 {{ request()->routeIs('tutorials.*') ? 'bg-[#14B8A6]/10 text-[#14B8A6] font-semibold' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                </svg>
                Master Tutorial
            </a>
        </nav>
    </div>

    <div class="p-4 border-t border-slate-100">
        <div class="dropdown dropdown-top w-full">
            @php
                $name = Auth::user()->name ?? 'Kreator';
                $initials = strtoupper(substr($name, 0, 1));
            @endphp

            <div tabindex="0" role="button"
                class="flex items-center gap-3 w-full p-2 rounded-xl hover:bg-slate-50 transition-colors cursor-pointer border border-transparent hover:border-slate-200">
                <div
                    class="w-9 h-9 rounded-full bg-[#0EA5E9]/10 text-[#0EA5E9] flex items-center justify-center font-bold text-sm">
                    {{ $initials }}
                </div>
                <div class="flex-1 overflow-hidden text-left">
                    <p class="text-sm font-semibold text-[#020617] truncate">{{ $name }}</p>
                    <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email ?? 'Dosen' }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </div>

            <ul tabindex="-1"
                class="dropdown-content menu shadow-[0_8px_30px_rgb(0,0,0,0.08)] bg-white rounded-xl w-full mb-2 border border-slate-100 p-2">
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="p-0 m-0 w-full">
                        @csrf
                        <button type="submit"
                            class="w-full text-left text-[#EC4899] hover:bg-[#EC4899]/10 hover:text-[#EC4899] rounded-lg px-4 py-2 font-medium flex items-center justify-between transition-colors">
                            Keluar Aplikasi
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>
