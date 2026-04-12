<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tutorial->title }} - Live Presentation</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .slide-in {
            animation: slideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Mempercantik scrollbar untuk blok kode */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-base-200 via-base-100 to-base-200 min-h-screen flex flex-col font-sans antialiased text-base-content selection:bg-primary selection:text-white">

    <div
        class="sticky top-0 z-50 bg-base-100/80 backdrop-blur-lg border-b border-base-200 shadow-sm transition-all duration-300">
        <div class="max-w-5xl mx-auto navbar px-4 sm:px-6 lg:px-8 h-20">
            <div class="flex-1 flex flex-col items-start justify-center overflow-hidden">
                <div class="flex items-center gap-2 mb-1">
                    <span class="badge badge-primary badge-sm font-bold">{{ $tutorial->kode_matkul }}</span>
                    <span class="text-xs text-base-content/60 font-medium truncate"><svg
                            xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 inline mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>{{ $tutorial->creator_email }}</span>
                </div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-base-content truncate w-full tracking-tight">
                    {{ $tutorial->title }}</h1>
            </div>

            @if (count($details) > 0)
                <div class="flex-none ml-4">
                    <div class="px-4 py-2 bg-primary/10 rounded-xl border border-primary/20 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span class="text-lg font-bold text-primary"><span id="current-step-display">1</span> <span
                                class="text-sm font-medium text-primary/60">/ {{ count($details) }}</span></span>
                    </div>
                </div>
            @endif
        </div>

        @if (count($details) > 0)
            <progress id="top-progress"
                class="progress progress-primary w-full h-1.5 absolute bottom-0 translate-y-full bg-transparent"
                value="1" max="{{ count($details) }}"></progress>
        @endif
    </div>

    <div class="flex-grow flex flex-col justify-center items-center p-4 sm:p-6 lg:p-10 w-full">
        <div class="max-w-4xl w-full relative">

            @forelse($details as $index => $detail)
                <div class="step-slide {{ $index == 0 ? 'block slide-in' : 'hidden' }}"
                    data-index="{{ $index }}">
                    <div
                        class="card bg-base-100 shadow-[0_20px_50px_rgba(8,_112,_184,_0.07)] border border-base-200 rounded-3xl overflow-hidden">
                        <div class="card-body p-6 sm:p-10 lg:p-12">

                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-2xl bg-primary text-primary-content font-black text-xl shadow-lg shadow-primary/30">
                                    {{ $detail->order }}
                                </div>
                                <h2 class="text-2xl sm:text-3xl font-extrabold text-base-content/90 tracking-tight">
                                    Instruksi Langkah</h2>
                            </div>

                            <div class="divider mt-0 mb-6 before:bg-base-200 after:bg-base-200"></div>

                            @if ($detail->text)
                                <div class="prose prose-lg max-w-none text-base-content/80 leading-relaxed mb-8">
                                    <p class="whitespace-pre-line">{{ $detail->text }}</p>
                                </div>
                            @endif

                            @if ($detail->image)
                                <div class="mb-8 group">
                                    <div
                                        class="bg-base-200/50 p-2 sm:p-4 rounded-3xl border border-base-300 transition-all duration-300 hover:border-primary/30 hover:shadow-md flex justify-center">
                                        <img src="{{ asset('storage/' . $detail->image) }}"
                                            alt="Ilustrasi Langkah {{ $detail->order }}"
                                            class="rounded-2xl max-h-[450px] object-contain shadow-sm">
                                    </div>
                                </div>
                            @endif

                            @if ($detail->code)
                                <div class="mb-8">
                                    <div
                                        class="flex items-center justify-between bg-neutral text-neutral-content px-4 py-2 rounded-t-2xl border-b border-white/10">
                                        <div class="flex gap-1.5">
                                            <div class="w-3 h-3 rounded-full bg-error/80"></div>
                                            <div class="w-3 h-3 rounded-full bg-warning/80"></div>
                                            <div class="w-3 h-3 rounded-full bg-success/80"></div>
                                        </div>
                                        <span class="text-xs font-mono text-neutral-content/60">Source Code</span>
                                    </div>
                                    <div class="mockup-code rounded-t-none rounded-b-2xl shadow-xl w-full">
                                        <pre data-prefix=">" class="text-success"><code>{{ $detail->code }}</code></pre>
                                    </div>
                                </div>
                            @endif

                            @if ($detail->url)
                                <div
                                    class="alert bg-blue-50/50 border border-blue-200 text-blue-900 rounded-2xl flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between p-5 mt-4">
                                    <div class="flex items-start gap-3">
                                        <div class="p-2 bg-blue-100 rounded-xl text-blue-600 mt-0.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-lg">Referensi Tambahan</h3>
                                            <p class="text-sm text-blue-700/80">Pelajari lebih lanjut mengenai materi
                                                ini melalui tautan berikut.</p>
                                        </div>
                                    </div>
                                    <a href="{{ $detail->url }}" target="_blank"
                                        class="btn btn-primary btn-sm sm:btn-md shadow-md shadow-primary/20 text-white w-full sm:w-auto">
                                        Buka Tautan
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @empty
                <div class="card bg-base-100 shadow-xl border border-base-200 rounded-3xl p-10 text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-24 h-24 bg-warning/10 rounded-full flex items-center justify-center text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Belum Ada Materi</h2>
                    <p class="text-base-content/60">Tutorial ini belum memiliki detail langkah yang dipublikasikan oleh
                        kreator.</p>
                </div>
            @endforelse

            @if (count($details) > 0)
                <div class="flex flex-col-reverse sm:flex-row justify-between items-center mt-8 gap-4 px-2">
                    <button id="btn-prev" onclick="changeStep(-1)"
                        class="btn btn-ghost hover:bg-base-200 border border-transparent hover:border-base-300 w-full sm:w-40 rounded-xl"
                        disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        Sebelumnya
                    </button>

                    <button id="btn-next" onclick="changeStep(1)"
                        class="btn btn-primary w-full sm:w-auto sm:min-w-[12rem] rounded-xl shadow-lg shadow-primary/30 text-white transition-all hover:-translate-y-0.5">
                        Langkah Selanjutnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            @endif

        </div>
    </div>

    <script>
        let currentStep = 0;
        const slides = document.querySelectorAll('.step-slide');
        const totalSteps = slides.length;

        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        const stepDisplay = document.getElementById('current-step-display');
        const topProgress = document.getElementById('top-progress');

        function changeStep(direction) {
            // Animasi keluar
            slides[currentStep].classList.remove('slide-in');
            slides[currentStep].style.opacity = '0';

            setTimeout(() => {
                slides[currentStep].classList.remove('block');
                slides[currentStep].classList.add('hidden');
                slides[currentStep].style.opacity = ''; // Reset inline style

                // Hitung index baru
                currentStep += direction;

                // Animasi masuk
                slides[currentStep].classList.remove('hidden');
                slides[currentStep].classList.add('block', 'slide-in');

                // Update UI Indicator
                stepDisplay.innerText = currentStep + 1;
                if (topProgress) topProgress.value = currentStep + 1;

                updateButtons();

                // Scroll to top of card smoothly
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }, 150); // Waktu transisi sedikit tertunda agar halus
        }

        function updateButtons() {
            // Status Tombol Sebelumnya
            if (currentStep === 0) {
                btnPrev.setAttribute('disabled', 'true');
                btnPrev.classList.add('opacity-50');
            } else {
                btnPrev.removeAttribute('disabled');
                btnPrev.classList.remove('opacity-50');
            }

            // Status Tombol Selanjutnya
            if (currentStep === totalSteps - 1) {
                btnNext.innerHTML =
                    'Selesai Tutorial <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
                btnNext.classList.remove('btn-primary', 'shadow-primary/30');
                btnNext.classList.add('btn-success', 'shadow-success/30', 'text-white');
                btnNext.onclick = function() {
                    alert('🎉 Selamat! Anda telah menyelesaikan seluruh materi tutorial ini.');
                    // Opsional: Redirect ke halaman selesai
                    // window.location.href = '/finished/{{ $tutorial->url_final }}';
                };
            } else {
                btnNext.innerHTML =
                    'Langkah Selanjutnya <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
                btnNext.classList.remove('btn-success', 'shadow-success/30');
                btnNext.classList.add('btn-primary', 'shadow-primary/30');
                btnNext.onclick = function() {
                    changeStep(1);
                };
            }
        }

        // Inisialisasi awal
        if (totalSteps > 0) {
            updateButtons();
            if (topProgress) topProgress.value = 1;
        }
    </script>

</body>

</html>
