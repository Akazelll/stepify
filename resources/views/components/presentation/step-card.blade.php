@props(['detail', 'index'])

<div class="step-slide hidden" data-index="{{ $index }}">
    <div class="card bg-base-100 shadow-xl border border-base-200 w-full">
        <div class="card-body p-6 sm:p-10 lg:p-12">

            <div class="flex items-center gap-4 mb-2">
                <div class="avatar placeholder">
                    <div class="bg-primary text-primary-content rounded-xl w-14 shadow-md font-bold text-2xl">
                        <span>{{ $detail->order }}</span>
                    </div>
                </div>
                <h2 class="card-title text-2xl sm:text-3xl font-extrabold">Instruksi Langkah</h2>
            </div>
            <div class="divider mt-0 mb-6"></div>

            @if ($detail->text)
                <div class="prose prose-lg max-w-none mb-8 opacity-90">
                    <p class="whitespace-pre-line">{{ $detail->text }}</p>
                </div>
            @endif

            @if ($detail->image)
                <div class="mb-8 flex justify-center">
                    <div class="p-2 border border-base-300 rounded-box bg-base-200/30">
                        <img src="{{ asset('storage/' . $detail->image) }}" alt="Langkah {{ $detail->order }}" class="rounded-xl max-h-[450px] object-contain shadow-sm">
                    </div>
                </div>
            @endif

            @if ($detail->code)
                <div class="mb-8 relative group">
                    <button 
                        onclick="copyCode(this, 'code-block-{{ $index }}')"
                        class="btn btn-sm absolute top-2 right-2 z-10 
                            opacity-70 hover:opacity-100 transition-all duration-300
                            bg-neutral-800/80 hover:bg-neutral-700 
                            text-gray-300 hover:text-white 
                            border border-white/10 hover:border-white/20
                            backdrop-blur-md rounded-lg shadow-sm"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 icon-copy text-current" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span class="copy-text">Copy</span>
                    </button>

                    <div class="mockup-code shadow-lg bg-[#282c34] pb-4">
                        <pre><code class="language-php" id="code-block-{{ $index }}">{{ $detail->code }}</code></pre>
                    </div>
                </div>
            @endif

            @if ($detail->url)
                <div class="alert alert-info shadow-md mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <div>
                        <h3 class="font-bold">Referensi Tambahan</h3>
                        <div class="text-sm">Pelajari lebih lanjut mengenai materi ini.</div>
                    </div>
                    <div class="flex-none sm:ml-auto w-full sm:w-auto mt-2 sm:mt-0">
                        <a href="{{ $detail->url }}" target="_blank" class="btn btn-sm btn-active btn-ghost bg-base-100/20 hover:bg-base-100/40 w-full">Buka Tautan</a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>