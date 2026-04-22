@props(['tutorial', 'totalSteps', 'isFinished' => false])

<header id="presentation-navbar"
    class="sticky top-0 z-50 w-full bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-sm transition-all duration-300">

    <div class="flex items-center justify-between h-16 px-4 mx-auto max-w-screen-2xl sm:px-6 lg:px-8">

        {{-- Kiri: Navigasi & Informasi Tutorial --}}
        <div class="flex items-center flex-1 min-w-0 gap-3 sm:gap-4">

            {{-- Hamburger Toggle Button Refactored --}}
            <button id="toggle-sidebar"
                class="flex-shrink-0 inline-flex items-center justify-center w-10 h-10 -ml-1 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-[#14B8A6]/40 active:scale-90 transition-all duration-200"
                aria-label="Toggle navigation" title="Buka/Tutup Navigasi">
                {{-- Modern Balanced Hamburger Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            {{-- Divider Vertikal (Desktop Only) --}}
            <div class="hidden md:block w-px h-8 bg-slate-200/80 shrink-0"></div>

            {{-- Container Info Tutorial --}}
            <div class="flex flex-col justify-center min-w-0">
                <div class="flex items-center gap-2 mb-0.5">
                    <span
                        class="px-1.5 py-0.5 text-[9px] sm:text-[10px] font-bold uppercase tracking-widest text-[#0EA5E9] bg-[#0EA5E9]/5 rounded border border-[#0EA5E9]/10 shrink-0">
                        {{ $tutorial->kode_matkul }}
                    </span>
                    <span class="hidden sm:inline-block w-1 h-1 rounded-full bg-slate-300"></span>
                    <span class="hidden lg:block text-[10px] font-medium text-slate-400 truncate tracking-tight">
                        {{ $tutorial->creator_email }}
                    </span>
                </div>
                <h1 class="text-sm sm:text-base font-extrabold text-slate-900 leading-none truncate tracking-tight"
                    title="{{ $tutorial->title }}">
                    {{ $tutorial->title }}
                </h1>
            </div>
        </div>

        {{-- Kanan: Badge Live & Aksi PDF --}}
        <div class="flex items-center gap-3 shrink-0 pl-2">

            {{-- Indikator Live dengan Pulse Effect --}}
            <div
                class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-pink-50 border border-pink-100/50 text-[#EC4899] text-[10px] font-bold uppercase tracking-widest shadow-sm">
                <span class="relative flex w-2 h-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#EC4899] opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-[#EC4899]"></span>
                </span>
                <span class="hidden sm:inline">Live Presentation</span>
            </div>

            {{-- Tombol PDF Eksklusif --}}
            @if ($isFinished)
                <button onclick="window.open('{{ url('/finished/' . $tutorial->url_final) }}', '_blank')"
                    class="group inline-flex items-center justify-center gap-2 p-2 sm:px-4 sm:py-2 text-xs font-bold rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm hover:bg-[#EC4899] hover:text-white hover:border-[#EC4899] focus:outline-none focus:ring-2 focus:ring-[#EC4899]/40 active:scale-95 transition-all duration-200"
                    title="Cetak Versi PDF">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-4 h-4 transition-transform group-hover:-translate-y-0.5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span class="hidden md:inline">Cetak PDF</span>
                </button>
            @endif

        </div>
    </div>

    {{-- Progress Bar dengan Efek Glow --}}
    @if ($totalSteps > 0)
        <div class="absolute bottom-0 left-0 w-full h-[3px] bg-slate-100/50 overflow-hidden">
            <div id="navbar-progress"
                class="h-full bg-gradient-to-r from-[#14B8A6] to-[#0EA5E9] shadow-[0_0_8px_rgba(20,184,166,0.5)] transition-all duration-700 ease-in-out"
                style="width: 0%"></div>
        </div>
    @endif

</header>
