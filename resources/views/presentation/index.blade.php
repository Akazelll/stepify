<x-presentation.layout :title="$tutorial->title . ' - Live Presentation'">

    <x-presentation.navbar :tutorial="$tutorial" :totalSteps="count($details)" :isFinished="$isFinished" />

    <div class="flex h-[calc(100vh-4rem)] w-full relative overflow-hidden">

        <aside id="presentation-sidebar"
            class="w-72 shrink-0 bg-white border-r border-slate-200 h-full overflow-y-auto transition-all duration-300 z-10 hidden md:block">
            <div class="p-6">
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-5">Navigasi Langkah</h3>

                <ul class="space-y-1.5 relative before:absolute before:inset-y-0 before:left-3.5 before:w-px before:bg-slate-100"
                    id="sidebar-step-list">
                    @foreach ($details as $index => $detail)
                        <li class="relative">
                            <button onclick="scrollToStep({{ $index }})" id="sidebar-btn-{{ $index }}"
                                class="flex items-center gap-3 w-full p-2 rounded-lg transition-all duration-200 text-left group">

                                <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 bg-white border-2 transition-colors z-10"
                                    id="sidebar-indicator-{{ $index }}">
                                    <span class="text-[10px] font-bold"
                                        id="sidebar-num-{{ $index }}">{{ $detail->order }}</span>
                                </div>

                                <span class="text-sm font-medium truncate w-full"
                                    title="Langkah {{ $detail->order }}">Langkah {{ $detail->order }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <main id="presentation-main"
            class="flex-1 h-full overflow-y-auto bg-[#F1F5F9] relative transition-all duration-300 scroll-smooth">
            <div class="max-w-4xl mx-auto py-10 px-4 sm:px-8 pb-40" id="step-container">

                @forelse($details as $index => $detail)
                    <x-presentation.step-card :detail="$detail" :index="$index" />
                @empty
                    <div
                        class="bg-white rounded-3xl border border-dashed border-slate-200 p-12 flex flex-col items-center justify-center text-center mt-10 shadow-sm">
                        <div
                            class="w-20 h-20 bg-amber-50 text-amber-400 rounded-full flex items-center justify-center mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-[#020617] mb-2">Belum Ada Materi</h1>
                        <p class="text-slate-500 max-w-sm">Tutorial ini belum memiliki detail langkah yang
                            dipublikasikan oleh dosen pengajar.</p>
                    </div>
                @endforelse

                @if (count($details) > 0)
                    <div class="mt-8 flex justify-center opacity-100 transition-opacity duration-500"
                        id="next-step-container">
                        <button onclick="revealNextStep()"
                            class="inline-flex items-center justify-center rounded-full bg-white border border-slate-200 px-8 py-4 text-sm font-bold text-[#14B8A6] shadow-[0_2px_12px_-4px_rgba(0,0,0,0.05)] hover:shadow-md hover:border-[#14B8A6]/40 transition-all hover:-translate-y-0.5 group">
                            Tampilkan Langkah Selanjutnya
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 ml-2 text-slate-400 group-hover:text-[#14B8A6] transition-colors"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                            </svg>
                        </button>
                    </div>
                @endif

                <div id="end-tutorial-indicator"
                    class="hidden mt-16 text-center opacity-0 transition-opacity duration-1000">
                    <div class="inline-flex flex-col items-center justify-center">
                        <div
                            class="w-14 h-14 bg-[#14B8A6]/10 text-[#14B8A6] rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#020617]">Materi Selesai</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-xs">Anda telah menyelesaikan seluruh instruksi pada
                            presentasi ini.</p>
                        {{-- Tombol PDF di sini telah dihapus agar hanya ada di Navbar --}}
                    </div>
                </div>

            </div>
        </main>
    </div>

    <x-slot name="scripts">
        <script>
            // 1. Inisialisasi Syntax Highlighter
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('pre code').forEach((el) => {
                    hljs.highlightElement(el);
                });
            });

            // 2. Fungsi Copy Code
            function copyCode(btnElement, targetId) {
                const codeBlock = document.getElementById(targetId);
                const textToCopy = codeBlock.innerText || codeBlock.textContent;

                const copyTextSpan = btnElement.querySelector('.copy-text');
                const originalText = copyTextSpan.innerText;

                const successUI = () => {
                    copyTextSpan.innerText = 'Disalin!';
                    btnElement.classList.add('!text-[#14B8A6]', '!border-[#14B8A6]/50', '!bg-[#14B8A6]/10');
                    setTimeout(() => {
                        copyTextSpan.innerText = originalText;
                        btnElement.classList.remove('!text-[#14B8A6]', '!border-[#14B8A6]/50', '!bg-[#14B8A6]/10');
                    }, 2000);
                };

                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(textToCopy).then(successUI).catch(() => fallbackCopyTextToClipboard(
                        textToCopy, successUI));
                } else {
                    fallbackCopyTextToClipboard(textToCopy, successUI);
                }
            }

            function fallbackCopyTextToClipboard(text, successCallback) {
                var textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-9999px";
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    if (document.execCommand('copy')) successCallback();
                } catch (err) {}
                document.body.removeChild(textArea);
            }

            // 3. State & Variabel Presentasi
            const tutorialId = "{{ $tutorial->id }}";
            const totalSteps = {{ count($details) }};
            const isFinished = {{ $isFinished ? 'true' : 'false' }};

            // Perbaikan: Selalu mulai dari step 0 saat halaman dibuka
            let currentStep = 0;
            localStorage.setItem(`tutorial_step_${tutorialId}`, currentStep);

            // 4. Inisialisasi Tampilan Awal
            function initPresentation() {
                if (totalSteps > 0) {
                    const stepEl = document.getElementById('step-0');
                    if (stepEl) {
                        stepEl.classList.remove('hidden');
                        stepEl.classList.add('block');
                    }
                    updateUI();
                }
            }

            // 5. Fungsi Memunculkan Langkah Baru (Live Feel)
            function revealNextStep() {
                if (currentStep < totalSteps - 1) {
                    currentStep++;
                    localStorage.setItem(`tutorial_step_${tutorialId}`, currentStep);

                    const stepEl = document.getElementById('step-' + currentStep);
                    if (stepEl) {
                        stepEl.classList.remove('hidden');
                        stepEl.classList.add('block', 'slide-up-fade');

                        setTimeout(() => {
                            stepEl.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }, 50);
                    }
                    updateUI();
                }
            }

            // 6. Fungsi Klik Sidebar untuk Gulir Manual
            window.scrollToStep = function(index) {
                if (index <= currentStep) {
                    const stepEl = document.getElementById('step-' + index);
                    if (stepEl) stepEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            // 7. Perbarui Antarmuka (Sidebar, Progress Bar & End Indicator)
            function updateUI() {
                const progressEl = document.getElementById('navbar-progress');
                if (progressEl && totalSteps > 0) {
                    const percent = ((currentStep + 1) / totalSteps) * 100;
                    progressEl.style.width = percent + '%';
                }

                for (let i = 0; i < totalSteps; i++) {
                    const btn = document.getElementById('sidebar-btn-' + i);
                    const indicator = document.getElementById('sidebar-indicator-' + i);
                    const num = document.getElementById('sidebar-num-' + i);

                    if (!btn || !indicator || !num) continue;

                    if (i === currentStep) {
                        btn.className =
                            "flex items-center gap-3 w-full p-2 rounded-lg transition-all duration-200 text-left group bg-[#14B8A6]/10";
                        indicator.className =
                            "w-7 h-7 rounded-full flex items-center justify-center shrink-0 bg-white border-2 transition-colors z-10 border-[#14B8A6] shadow-[0_0_8px_rgba(20,184,166,0.4)]";
                        num.className = "text-[10px] font-bold text-[#14B8A6]";
                    } else if (i < currentStep) {
                        btn.className =
                            "flex items-center gap-3 w-full p-2 rounded-lg transition-all duration-200 text-left group hover:bg-slate-50 cursor-pointer";
                        indicator.className =
                            "w-7 h-7 rounded-full flex items-center justify-center shrink-0 bg-slate-50 border-2 transition-colors z-10 border-slate-200 group-hover:border-[#14B8A6]/50";
                        num.className = "text-[10px] font-bold text-slate-500 group-hover:text-[#14B8A6]";
                    } else {
                        btn.className =
                            "flex items-center gap-3 w-full p-2 rounded-lg transition-all duration-200 text-left group opacity-40 cursor-not-allowed";
                        indicator.className =
                            "w-7 h-7 rounded-full flex items-center justify-center shrink-0 bg-white border-2 transition-colors z-10 border-slate-100";
                        num.className = "text-[10px] font-bold text-slate-300";
                    }
                }

                const nextBtnContainer = document.getElementById('next-step-container');
                const endIndicator = document.getElementById('end-tutorial-indicator');

                if (currentStep >= totalSteps - 1) {
                    if (nextBtnContainer) nextBtnContainer.style.display = 'none';
                    if (endIndicator) {
                        endIndicator.classList.remove('hidden');
                        setTimeout(() => endIndicator.classList.remove('opacity-0'), 100);
                    }
                }
            }

            const toggleBtn = document.getElementById('toggle-sidebar');
            const sidebar = document.getElementById('presentation-sidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('md:block');
                    sidebar.classList.toggle('hidden');
                });
            }

            initPresentation();

            // 8. Auto-Refresh Sinkronisasi Layar (Tetap simpan state saat ini sebelum refresh)
            setInterval(() => {
                localStorage.setItem(`tutorial_step_${tutorialId}`, currentStep);
                window.location.reload();
            }, 15000);
        </script>
    </x-slot>
</x-presentation.layout>
