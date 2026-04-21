<x-app-layout>
    <div class="p-6 sm:p-10 max-w-5xl mx-auto">

        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#020617] tracking-tight">Master Tutorial</h1>
                <p class="text-slate-500 mt-1.5 text-sm">Kelola semua modul presentasi dan materi pembelajaran Anda.</p>
            </div>
            <div>
                <a href="{{ route('tutorials.create') }}"
                    class="inline-flex items-center justify-center rounded-xl bg-[#14B8A6] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0f9688] hover:shadow-md transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Tutorial Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-8 p-4 rounded-xl bg-[#14B8A6]/10 border border-[#14B8A6]/20 flex items-start gap-3">
                <div class="text-[#14B8A6] mt-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[#020617]">Berhasil!</h3>
                    <p class="text-sm text-slate-600 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="space-y-4">
            @forelse ($tutorials as $tutorial)
                <div
                    class="bg-white rounded-2xl p-5 sm:p-6 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 flex flex-col lg:flex-row justify-between gap-6 transition-all hover:border-slate-200 hover:shadow-md group">

                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-mono font-semibold bg-[#0EA5E9]/10 text-[#0EA5E9] border border-[#0EA5E9]/20">
                                {{ $tutorial->kode_matkul }}
                            </span>
                            <span class="text-xs font-medium text-slate-400 flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $tutorial->created_at->diffForHumans() }}
                            </span>
                        </div>

                        <h2
                            class="text-xl font-bold text-[#020617] group-hover:text-[#14B8A6] transition-colors mb-1.5">
                            {{ $tutorial->title }}
                        </h2>

                        <p class="text-sm text-slate-500 flex items-center gap-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $tutorial->creator_email }}
                        </p>

                        <div class="flex flex-wrap items-center gap-3 mt-4">
                            <div
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-100 text-xs">
                                <span class="font-semibold text-slate-600">Live:</span>
                                <a href="{{ route('presentation.index', $tutorial->url_presentasi) }}" target="_blank"
                                    class="text-[#0EA5E9] hover:underline truncate max-w-[120px] sm:max-w-[200px]">
                                    /{{ $tutorial->url_presentasi }}
                                </a>
                                <button
                                    onclick="navigator.clipboard.writeText('{{ route('presentation.index', $tutorial->url_presentasi) }}'); alert('URL Presentasi Disalin!')"
                                    class="text-slate-400 hover:text-[#14B8A6]" title="Salin Link">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>

                            <div
                                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-slate-50 border border-slate-100 text-xs">
                                <span class="font-semibold text-slate-600">PDF:</span>
                                <a href="{{ route('presentation.finished', $tutorial->url_final) }}" target="_blank"
                                    class="text-[#EC4899] hover:underline truncate max-w-[120px] sm:max-w-[200px]">
                                    /{{ $tutorial->url_final }}
                                </a>
                                <button
                                    onclick="navigator.clipboard.writeText('{{ route('presentation.finished', $tutorial->url_final) }}'); alert('URL PDF Disalin!')"
                                    class="text-slate-400 hover:text-[#EC4899]" title="Salin Link">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end gap-2 border-t lg:border-t-0 lg:border-l border-slate-100 pt-4 lg:pt-0 lg:pl-6">
                        <a href="{{ route('tutorial.details.index', $tutorial->id) }}"
                            class="inline-flex items-center justify-center rounded-xl bg-white border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 hover:border-slate-300 transition-all flex-1 lg:flex-none text-center">
                            Kelola Detail
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        <form action="{{ route('tutorials.destroy', $tutorial->id) }}" method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus Master Tutorial ini beserta seluruh detailnya?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-white border border-slate-200 px-3 py-2 text-slate-400 hover:text-white hover:bg-[#EC4899] hover:border-[#EC4899] transition-colors"
                                title="Hapus Tutorial">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div
                    class="bg-white rounded-3xl border border-dashed border-slate-200 p-12 flex flex-col items-center justify-center text-center">
                    <div
                        class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-[#020617] mb-2">Belum Ada Tutorial</h3>
                    <p class="text-slate-500 max-w-sm mb-6">Mulai bagikan pengetahuan Anda dengan membuat master
                        tutorial pertama untuk kelas Anda.</p>
                    <a href="{{ route('tutorials.create') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-[#14B8A6] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0f9688] transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Tutorial Baru
                    </a>
                </div>
            @endforelse
        </div>

        @if ($tutorials->hasPages())
            <div class="mt-8">
                {{ $tutorials->links() }}
            </div>
        @endif

    </div>
</x-app-layout>
