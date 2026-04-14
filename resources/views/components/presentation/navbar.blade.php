@props(['tutorial', 'totalSteps'])

<div class="navbar bg-base-100 shadow-sm sticky top-0 z-50 px-4 lg:px-8 border-b border-base-300">
    <div class="navbar-start w-2/3 sm:w-3/4">
        <div class="flex flex-col overflow-hidden">
            <div class="flex items-center gap-2 mb-1">
                <span class="badge badge-primary badge-sm font-bold">{{ $tutorial->kode_matkul }}</span>
                <span class="badge badge-error badge-sm gap-1 animate-pulse font-bold text-white">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span> LIVE
                </span>
            </div>
            <h1 class="text-lg sm:text-xl font-bold truncate">{{ $tutorial->title }}</h1>
            <span class="text-xs opacity-60 flex items-center gap-1 truncate">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                {{ $tutorial->creator_email }}
            </span>
        </div>
    </div>

    <div class="navbar-end w-1/3 sm:w-1/4 flex justify-end gap-2 sm:gap-4">
        <button onclick="window.open('{{ url('/finished/' . $tutorial->url_final) }}', '_blank')" class="btn btn-sm btn-outline btn-error shadow-sm hidden sm:inline-flex">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            Cetak PDF
        </button>
        
        <button onclick="window.open('{{ url('/finished/' . $tutorial->url_final) }}', '_blank')" class="btn btn-sm btn-circle btn-outline btn-error sm:hidden" title="Cetak PDF">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
        </button>

        @if ($totalSteps > 0)
            <div class="badge badge-outline badge-lg font-bold p-3 sm:p-4 shadow-sm bg-base-100">
                <span class="text-primary mr-1" id="current-step-display">1</span> / {{ $totalSteps }}
            </div>
        @endif
    </div>

    @if ($totalSteps > 0)
        <progress id="top-progress" class="progress progress-primary w-full absolute bottom-0 translate-y-full left-0 bg-base-200 h-1" value="1" max="{{ $totalSteps }}"></progress>
    @endif
</div>