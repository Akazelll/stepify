@props(['detail', 'index'])

<div class="step-slide w-full max-w-3xl mx-auto {{ $index == 0 ? 'block slide-up-fade' : 'hidden' }}"
    data-index="{{ $index }}" id="step-{{ $index }}">

    <div
        class="bg-white rounded-2xl shadow-[0_4px_24px_-6px_rgba(0,0,0,0.04)] border border-slate-100 overflow-hidden mb-8 sm:mb-12">
        <div class="p-6 sm:p-10">

            <div class="flex items-center gap-4 mb-6">
                <div
                    class="w-10 h-10 rounded-xl bg-[#14B8A6]/10 text-[#14B8A6] flex items-center justify-center font-extrabold text-lg">
                    {{ $detail->order }}
                </div>
                <h2 class="text-2xl font-bold text-[#020617] tracking-tight">Instruksi Langkah</h2>
            </div>

            <div class="h-px w-full bg-slate-100 mb-6"></div>

            @if ($detail->text)
                <div class="prose prose-slate max-w-none mb-8 text-[15px] leading-relaxed text-slate-700">
                    <p class="whitespace-pre-line">{{ $detail->text }}</p>
                </div>
            @endif

            @if ($detail->image)
                <div class="mb-8 rounded-2xl bg-slate-50 p-3 sm:p-4 border border-slate-100 flex justify-center">
                    <img src="{{ asset('storage/' . $detail->image) }}" alt="Ilustrasi Langkah {{ $detail->order }}"
                        class="rounded-xl max-h-[400px] object-contain shadow-sm bg-white">
                </div>
            @endif

            @if ($detail->code)
                <div class="mb-8 rounded-xl overflow-hidden shadow-lg border border-slate-800">
                    <div class="flex items-center px-4 py-2.5 bg-[#0F172A] border-b border-white/10">
                        <div class="flex gap-1.5 shrink-0">
                            <div class="w-3 h-3 rounded-full bg-red-500/90"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500/90"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500/90"></div>
                        </div>
                        <span class="ml-4 text-xs font-mono text-slate-400">Kode Snippet</span>

                        <button onclick="copyCode(this, 'code-block-{{ $index }}')"
                            class="ml-auto flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition-colors text-xs font-medium border border-white/5 hover:border-white/10 focus:outline-none focus:ring-2 focus:ring-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 icon-copy" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span class="copy-text">Salin</span>
                        </button>
                    </div>
                    <div class="bg-[#0F172A] w-full overflow-x-auto text-sm font-mono text-slate-200">
                        <pre class="m-0"><code class="language-php" id="code-block-{{ $index }}">{{ $detail->code }}</code></pre>
                    </div>
                </div>
            @endif

            @if ($detail->url)
                <div
                    class="mt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-4 rounded-xl bg-[#EC4899]/5 border border-[#EC4899]/15">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white rounded-lg shadow-sm text-[#EC4899]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-[#020617]">Referensi Eksternal</h4>
                            <p class="text-xs text-slate-500 mt-0.5">Pelajari lebih lanjut mengenai materi ini melalui
                                tautan berikut.</p>
                        </div>
                    </div>
                    <a href="{{ $detail->url }}" target="_blank"
                        class="w-full sm:w-auto px-4 py-2 rounded-lg bg-white border border-slate-200 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#EC4899] hover:border-[#EC4899]/40 transition-all shadow-sm text-center inline-flex justify-center items-center gap-1.5">
                        Buka Tautan
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
