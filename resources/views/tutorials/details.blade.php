<x-app-layout>
    <div class="p-6 sm:p-10 max-w-7xl mx-auto">

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

        <div
            class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-6 border-b border-slate-200 pb-8">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-mono font-bold bg-[#0EA5E9]/10 text-[#0EA5E9] border border-[#0EA5E9]/20">
                        {{ $tutorial->kode_matkul }}
                    </span>
                    <span class="text-sm font-medium text-slate-500">Manajemen Konten</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-[#020617] tracking-tight">{{ $tutorial->title }}
                </h1>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <button onclick="copyToClipboard('{{ url('/presentation/' . $tutorial->url_presentasi) }}')"
                    class="inline-flex items-center justify-center rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 hover:border-[#14B8A6] hover:text-[#14B8A6] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    Salin Tautan
                </button>
                <a href="/presentation/{{ $tutorial->url_presentasi }}" target="_blank"
                    class="inline-flex items-center justify-center rounded-xl bg-[#14B8A6]/10 text-[#14B8A6] border border-[#14B8A6]/20 px-4 py-2.5 text-sm font-bold hover:bg-[#14B8A6] hover:text-white transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Lihat Presentasi
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
                    <h3 class="text-sm font-bold text-[#020617]">Pembaruan Berhasil!</h3>
                    <p class="text-sm text-slate-600 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

            <div class="lg:col-span-4 sticky top-24">
                <div
                    class="bg-white rounded-3xl p-6 sm:p-8 shadow-[0_4px_24px_-6px_rgba(0,0,0,0.05)] border border-slate-100">
                    <h3 class="font-bold text-lg text-[#020617] flex items-center gap-2 mb-6">
                        <div
                            class="w-8 h-8 rounded-full bg-[#14B8A6]/10 text-[#14B8A6] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        Tambah Langkah
                    </h3>

                    <form action="{{ route('tutorial.details.store', $tutorial->id) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-[#020617] mb-1.5">Teks /
                                Penjelasan</label>
                            <textarea name="text" rows="3"
                                class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] placeholder-slate-400 focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none resize-none"
                                placeholder="Tuliskan instruksi langkah di sini..."></textarea>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-[#020617] mb-1.5 flex justify-between items-center">
                                Kode Program
                                <span
                                    class="text-[10px] font-normal text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>
                            <textarea name="code" rows="3"
                                class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] bg-[#F8FAFC] font-mono placeholder-slate-400 focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none resize-none"
                                placeholder="echo 'Hello World';"></textarea>
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-[#020617] mb-1.5 flex justify-between items-center">
                                Gambar Ilustrasi
                                <span
                                    class="text-[10px] font-normal text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#0EA5E9]/10 file:text-[#0EA5E9] hover:file:bg-[#0EA5E9]/20 cursor-pointer border border-slate-200 rounded-xl bg-white focus:outline-none focus:border-[#14B8A6] transition-all" />
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-[#020617] mb-1.5 flex justify-between items-center">
                                Tautan Referensi
                                <span
                                    class="text-[10px] font-normal text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Opsional</span>
                            </label>
                            <input type="url" name="url" placeholder="https://..."
                                class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] placeholder-slate-400 focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none" />
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center rounded-xl bg-[#14B8A6] px-5 py-3.5 text-sm font-bold text-white shadow-[0_4px_12px_rgba(20,184,166,0.25)] hover:bg-[#0f9688] hover:shadow-[0_6px_16px_rgba(20,184,166,0.35)] transition-all hover:-translate-y-0.5">
                                Simpan Langkah Baru
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">

                @forelse($details as $detail)
                    <div
                        class="bg-white rounded-3xl p-6 sm:p-8 border {{ $detail->status == 'show' ? 'border-slate-100 shadow-[0_2px_16px_-4px_rgba(0,0,0,0.04)]' : 'border-dashed border-slate-300 opacity-80 bg-slate-50' }} group transition-all duration-300 hover:shadow-md">

                        <div id="view-mode-{{ $detail->id }}">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-slate-100 pb-4">

                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-[#020617] text-white flex items-center justify-center font-black text-lg shadow-sm">
                                        {{ $detail->order }}
                                    </div>

                                    @if ($detail->status == 'show')
                                        <div
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-[#14B8A6]/10 text-[#14B8A6] text-xs font-bold border border-[#14B8A6]/20">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#14B8A6]"></span> Publik
                                        </div>
                                    @else
                                        <div
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-[#EC4899]/10 text-[#EC4899] text-xs font-bold border border-[#EC4899]/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                            </svg>
                                            Draft Tertutup
                                        </div>
                                    @endif
                                </div>

                                <div
                                    class="flex items-center gap-2 opacity-100 lg:opacity-30 group-hover:opacity-100 transition-opacity duration-300">

                                    <button type="button" onclick="toggleEdit({{ $detail->id }})"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 bg-white text-blue-500 hover:text-white hover:border-blue-500 hover:bg-blue-500 transition-colors"
                                        title="Edit langkah">
                                        Edit
                                    </button>

                                    <form action="{{ route('tutorial.details.toggle', $detail->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if ($detail->status == 'show')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 bg-white text-slate-500 hover:text-amber-600 hover:border-amber-200 hover:bg-amber-50 transition-colors"
                                                title="Sembunyikan langkah">
                                                Sembunyikan
                                            </button>
                                        @else
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-[#14B8A6] bg-[#14B8A6] text-white hover:bg-[#0f9688] transition-colors"
                                                title="Publikasikan langkah">
                                                Publikasikan
                                            </button>
                                        @endif
                                    </form>

                                    <form action="{{ route('tutorial.details.destroy', $detail->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-slate-200 bg-white text-slate-500 hover:text-white hover:border-[#EC4899] hover:bg-[#EC4899] transition-colors"
                                            onclick="return confirm('Hapus langkah ini secara permanen?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="space-y-5">
                                @if ($detail->text)
                                    <p class="text-[#020617] text-base leading-relaxed whitespace-pre-line">
                                        {{ $detail->text }}</p>
                                @endif

                                @if ($detail->image)
                                    <div
                                        class="bg-slate-50 rounded-2xl p-3 border border-slate-100 flex justify-center">
                                        <img src="{{ asset('storage/' . $detail->image) }}"
                                            alt="Ilustrasi Step {{ $detail->order }}"
                                            class="rounded-xl max-h-[350px] object-contain shadow-sm">
                                    </div>
                                @endif

                                @if ($detail->code)
                                    <div
                                        class="relative rounded-xl overflow-hidden bg-[#282c34] shadow-inner border border-slate-800">
                                        <div class="flex items-center px-4 py-2 bg-black/40 border-b border-white/5">
                                            <div class="flex gap-1.5">
                                                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                            </div>
                                            <span class="ml-3 text-xs font-mono text-slate-400">Kode Program</span>
                                        </div>
                                        <div class="p-4 overflow-x-auto text-sm font-mono text-slate-300">
                                            <pre><code>{{ $detail->code }}</code></pre>
                                        </div>
                                    </div>
                                @endif

                                @if ($detail->url)
                                    <a href="{{ $detail->url }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-3 rounded-xl bg-[#0EA5E9]/5 border border-[#0EA5E9]/20 text-[#0EA5E9] hover:bg-[#0EA5E9]/10 transition-colors w-full sm:w-auto">
                                        <div class="p-1.5 bg-white rounded-lg shadow-sm text-[#0EA5E9]">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-semibold">Buka Tautan Referensi</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div id="edit-mode-{{ $detail->id }}" class="hidden mt-4">
                            <div class="flex items-center gap-2 mb-4">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-[#020617]">Edit Langkah {{ $detail->order }}</h4>
                            </div>

                            <form action="{{ route('tutorial.details.update', $detail->id) }}" method="POST"
                                enctype="multipart/form-data"
                                class="space-y-4 border border-slate-100 bg-slate-50 p-5 rounded-2xl">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-sm font-semibold text-[#020617] mb-1.5">Teks /
                                        Penjelasan</label>
                                    <textarea name="text" rows="3"
                                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none resize-none">{{ $detail->text }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-[#020617] mb-1.5">Kode
                                        Program</label>
                                    <textarea name="code" rows="3"
                                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] bg-white font-mono focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none resize-none">{{ $detail->code }}</textarea>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-semibold text-[#020617] mb-1.5 flex justify-between items-center">
                                        Gambar Ilustrasi Baru
                                        <span
                                            class="text-[10px] font-normal text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full ml-1">Abaikan
                                            jika tidak ingin diubah</span>
                                    </label>
                                    <input type="file" name="image" accept="image/*"
                                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0EA5E9]/10 file:text-[#0EA5E9] hover:file:bg-[#0EA5E9]/20 cursor-pointer border border-slate-200 rounded-xl bg-white focus:outline-none focus:border-[#14B8A6] transition-all" />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-[#020617] mb-1.5">Tautan
                                        Referensi</label>
                                    <input type="url" name="url" value="{{ $detail->url }}"
                                        placeholder="https://..."
                                        class="w-full rounded-xl border-slate-200 px-4 py-3 text-sm text-[#020617] focus:border-[#14B8A6] focus:ring-4 focus:ring-[#14B8A6]/10 transition-all outline-none" />
                                </div>

                                <div
                                    class="pt-3 flex flex-col sm:flex-row items-center justify-end gap-3 border-t border-slate-200 mt-2">
                                    <button type="button" onclick="toggleEdit({{ $detail->id }})"
                                        class="w-full sm:w-auto px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-800 bg-transparent hover:bg-slate-200 rounded-xl transition-all">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-blue-500 px-5 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-blue-600 transition-all">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                @empty
                    <div
                        class="bg-white rounded-3xl border border-dashed border-slate-200 p-12 flex flex-col items-center justify-center text-center h-full min-h-[400px]">
                        <div
                            class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#020617] mb-2">Belum Ada Instruksi</h3>
                        <p class="text-slate-500 max-w-sm">Mulai tambahkan teks, gambar, atau kode program melalui
                            formulir di sebelah kiri layar.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('✅ Berhasil! Tautan presentasi disalin ke clipboard.');
                }).catch(err => {
                    alert('❌ Gagal menyalin tautan.');
                });
            } else {
                let textArea = document.createElement("textarea");
                textArea.value = text;
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    alert('✅ Berhasil! Tautan presentasi disalin ke clipboard.');
                } catch (err) {
                    alert('❌ Gagal menyalin tautan.');
                }
                textArea.remove();
            }
        }

        // FUNGSI BARU UNTUK TOGGLE EDIT
        function toggleEdit(id) {
            const viewMode = document.getElementById('view-mode-' + id);
            const editMode = document.getElementById('edit-mode-' + id);

            if (viewMode.classList.contains('hidden')) {
                // Tampilkan mode View, Sembunyikan mode Edit
                viewMode.classList.remove('hidden');
                editMode.classList.add('hidden');
            } else {
                // Sembunyikan mode View, Tampilkan mode Edit
                viewMode.classList.add('hidden');
                editMode.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
