<x-presentation.layout :title="$tutorial->title . ' - Live Presentation'">

    <x-presentation.navbar :tutorial="$tutorial" :totalSteps="count($details)" />

    <div class="flex-grow flex flex-col justify-center items-center p-4 sm:p-6 lg:p-10 w-full">
        <div class="max-w-4xl w-full relative">

            @forelse($details as $index => $detail)
                <x-presentation.step-card :detail="$detail" :index="$index" />
            @empty
                <div class="hero bg-base-100 rounded-box shadow-lg border border-base-200">
                    <div class="hero-content text-center py-16">
                        <div class="max-w-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-warning mb-4"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <h1 class="text-3xl font-bold">Belum Ada Materi</h1>
                            <p class="py-4 opacity-70">Tutorial ini belum memiliki detail langkah yang dipublikasikan
                                oleh kreator.</p>
                        </div>
                    </div>
                </div>
            @endforelse

            @if (count($details) > 0)
                <div class="flex flex-col-reverse sm:flex-row justify-between items-center mt-6 gap-3">
                    <button id="btn-prev" onclick="changeStep(-1)" class="btn btn-outline w-full sm:w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Sebelumnya
                    </button>
                    <button id="btn-next" onclick="changeStep(1)"
                        class="btn btn-primary w-full sm:w-auto sm:min-w-[12rem] shadow-md">
                        Langkah Selanjutnya
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            @endif

        </div>
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
                const iconSvg = btnElement.querySelector('.icon-copy');
                const originalIconHtml = iconSvg.outerHTML;

                const successUI = () => {
                    copyTextSpan.innerText = 'Copied!';
                    btnElement.classList.add('!text-success');
                    iconSvg.outerHTML =
                        `<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 icon-copy" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>`;

                    setTimeout(() => {
                        btnElement.querySelector('.copy-text').innerText = 'Copy';
                        btnElement.classList.remove('!text-success');
                        btnElement.querySelector('.icon-copy').outerHTML = originalIconHtml;
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
                textArea.style.top = "0";
                textArea.style.left = "0";
                textArea.style.position = "fixed";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    if (document.execCommand('copy')) successCallback();
                } catch (err) {}
                document.body.removeChild(textArea);
            }

            // 3. Logika Navigasi Slide
            const tutorialId = "{{ $tutorial->id }}";
            const slides = document.querySelectorAll('.step-slide');
            const totalSteps = slides.length;
            let currentStep = 0;

            const savedStep = localStorage.getItem(`tutorial_step_${tutorialId}`);
            if (savedStep !== null && parseInt(savedStep) < totalSteps) {
                currentStep = parseInt(savedStep);
            }

            const btnPrev = document.getElementById('btn-prev');
            const btnNext = document.getElementById('btn-next');
            const stepDisplay = document.getElementById('current-step-display');
            const topProgress = document.getElementById('top-progress');

            function initSlider() {
                if (totalSteps > 0) {
                    slides.forEach(slide => slide.classList.add('hidden'));
                    slides[currentStep].classList.remove('hidden');
                    slides[currentStep].classList.add('block', 'slide-in');
                    updateUI();
                }
            }

            function changeStep(direction) {
                slides[currentStep].classList.remove('slide-in');
                slides[currentStep].style.opacity = '0';

                setTimeout(() => {
                    slides[currentStep].classList.remove('block');
                    slides[currentStep].classList.add('hidden');
                    slides[currentStep].style.opacity = '';

                    currentStep += direction;
                    localStorage.setItem(`tutorial_step_${tutorialId}`, currentStep);

                    slides[currentStep].classList.remove('hidden');
                    slides[currentStep].classList.add('block', 'slide-in');

                    updateUI();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }, 150);
            }

            function updateUI() {
                if (stepDisplay) stepDisplay.innerText = currentStep + 1;
                if (topProgress) topProgress.value = currentStep + 1;

                currentStep === 0 ? btnPrev.classList.add('btn-disabled') : btnPrev.classList.remove('btn-disabled');

                if (currentStep === totalSteps - 1) {
                    btnNext.innerHTML = 'Langkah Selesai ✓';
                    btnNext.classList.replace('btn-primary', 'btn-disabled');
                    btnNext.onclick = null;
                } else {
                    btnNext.innerHTML =
                        'Langkah Selanjutnya <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>';
                    btnNext.classList.remove('btn-disabled');
                    btnNext.classList.add('btn-primary');
                    btnNext.onclick = () => changeStep(1);
                }
            }

            initSlider();

            // 4. Auto Refresh Sesuai Spesifikasi (15 Detik)
            setInterval(() => {
                localStorage.setItem(`tutorial_step_${tutorialId}`, currentStep);
                window.location.reload();
            }, 15000);
        </script>
    </x-slot>

</x-presentation.layout>
