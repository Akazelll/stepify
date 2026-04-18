@props(['tutorial', 'totalSteps'])

<header class="bg-white/90 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50 transition-all duration-300"
    id="presentation-navbar">
    <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">

        <div class="flex items-center gap-3 sm:gap-4 overflow-hidden">

            <button id="toggle-sidebar"
                class="p-2 -ml-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-[#020617] transition-colors focus:outline-none focus:ring-2 focus:ring-[#14B8A6]/30"
                title="Mode Fokus (Sembunyikan Sidebar)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>

            <div class="hidden sm:block h-6 w-px bg-slate-200"></div>

            <div class="flex flex-col justify-center">
                <div class="flex items-center gap-2 mb-0.5">
                    <span
                        class="text-[10px] font-bold uppercase tracking-wider text-[#0EA5E9]">{{ $tutorial->kode_matkul }}</span>
                    <span class="w-1 h-1 rounded-full bg-slate-300 hidden sm:block"></span>
                    <span
                        class="text-[10px] font-medium text-slate-500 truncate max-w-[120px] sm:max-w-xs hidden sm:block">
                        {{ $tutorial->creator_email }}
                    </span>
                </div>
                <h1
                    class="text-sm sm:text-base font-bold text-[#020617] leading-tight truncate max-w-[200px] sm:max-w-md lg:max-w-xl tracking-tight">
                    {{ $tutorial->title }}
                </h1>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-4 shrink-0">

            <div
                class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#EC4899]/10 text-[#EC4899] border border-[#EC4899]/20 text-[10px] font-bold uppercase tracking-wider">
                <span class="w-1.5 h-1.5 rounded-full bg-[#EC4899] animate-pulse"></span>
                Live
            </div>

            <button onclick="window.open('{{ url('/finished/' . $tutorial->url_final) }}', '_blank')"
                class="hidden sm:inline-flex items-center justify-center px-3 py-1.5 text-xs font-semibold rounded-lg bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-[#020617] hover:border-slate-300 transition-all shadow-sm"
                title="Cetak Versi PDF">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1.5 text-slate-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                PDF
            </button>

            <button onclick="window.open('{{ url('/finished/' . $tutorial->url_final) }}', '_blank')"
                class="sm:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 hover:text-[#020617] transition-colors"
                title="Cetak Versi PDF">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </button>

            <div class="h-6 w-px bg-slate-200"></div>

            <a href="{{ route('dashboard') }}"
                class="p-2 -mr-2 rounded-lg text-slate-400 hover:bg-[#EC4899]/10 hover:text-[#EC4899] transition-colors"
                title="Tutup Presentasi">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>

        </div>
    </div>

    @if ($totalSteps > 0)
        <div class="h-0.5 w-full bg-slate-100 absolute bottom-0 left-0 overflow-hidden">
            <div id="navbar-progress" class="h-full bg-[#14B8A6] transition-all duration-500 ease-out"
                style="width: 0%"></div>
        </div>
    @endif
</header>
