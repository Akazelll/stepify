<x-app-layout>
    <div class="p-6 sm:p-10 max-w-3xl mx-auto">

        <div class="mb-6">
            <a href="{{ route('tutorials.index') }}"
                class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-[#14B8A6] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Master Tutorial
            </a>
        </div>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#020617] tracking-tight">Buat Tutorial Baru</h1>
            <p class="text-slate-500 mt-2 text-sm">Persiapkan kerangka presentasi untuk mata kuliah Anda. Detail langkah
                dapat ditambahkan setelah ini.</p>
        </div>

        <div class="bg-white rounded-3xl p-6 sm:p-10 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.04)] border border-slate-100">
            <form action="{{ route('tutorials.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="title" class="block text-sm font-bold text-[#020617] mb-2">Judul Tutorial <span
                            class="text-[#EC4899]">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="Contoh: Pengenalan Routing Laravel 11"
                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] placeholder-slate-400 focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none @error('title') border-[#EC4899] focus:border-[#EC4899] focus:ring-[#EC4899]/10 @enderror"
                        required autofocus>

                    @error('title')
                        <p class="mt-2 text-xs text-[#EC4899] flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="kode_matkul" class="block text-sm font-bold text-[#020617] mb-2">Mata Kuliah <span
                            class="text-[#EC4899]">*</span></label>

                    @if (!empty($makulData))
                        <div class="relative">
                            <select name="kode_matkul" id="kode_matkul"
                                class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] bg-white focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none appearance-none @error('kode_matkul') border-[#EC4899] @enderror"
                                required>
                                <option value="" disabled {{ old('kode_matkul') ? '' : 'selected' }}>-- Pilih Mata
                                    Kuliah --</option>
                                @foreach ($makulData as $makul)
                                    <option value="{{ $makul['kdmk'] }}"
                                        {{ old('kode_matkul') == $makul['kdmk'] ? 'selected' : '' }}>
                                        {{ $makul['kdmk'] }} - {{ $makul['nama'] }}
                                    </option>
                                @endforeach
                            </select>

                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    @else
                        <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 flex gap-3">
                            <div class="text-amber-500 mt-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-amber-800">Gagal Memuat Mata Kuliah</p>
                                <p class="text-xs text-amber-700 mt-1">Data dari Webservice API tidak dapat ditarik.
                                    Silakan <a href="{{ route('login') }}" class="underline font-bold">login ulang</a>
                                    untuk memperbarui sesi, atau pastikan server API eksternal menyala.</p>
                            </div>
                        </div>
                    @endif

                    @error('kode_matkul')
                        <p class="mt-2 text-xs text-[#EC4899]">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="creator_email" class="block text-sm font-bold text-[#020617] mb-2">Email Kreator</label>
                    <div class="relative opacity-90">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <input type="email" id="creator_email" value="{{ session('user_email') }}"
                            class="w-full rounded-xl border border-slate-200 pl-11 pr-4 py-3 text-sm text-slate-500 bg-slate-100 cursor-not-allowed focus:outline-none"
                            disabled>
                    </div>
                    <p class="text-xs text-slate-500 mt-2 font-medium">Email ini otomatis terisi dari sesi Anda dan
                        tidak dapat diubah.</p>
                </div>

                <div class="divider pt-2 mb-0"></div>

                <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-2">
                    <a href="{{ route('tutorials.index') }}"
                        class="w-full sm:w-auto px-6 py-3 text-sm font-semibold text-slate-500 hover:text-[#020617] bg-transparent hover:bg-slate-100 rounded-xl transition-all text-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-[#14B8A6] px-8 py-3 text-sm font-bold text-white shadow-[0_4px_12px_rgba(20,184,166,0.25)] hover:bg-[#0f9688] hover:shadow-[0_6px_16px_rgba(20,184,166,0.35)] transition-all hover:-translate-y-0.5">
                        Simpan & Buat Tutorial
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>

            </form>
        </div>

    </div>
</x-app-layout>
