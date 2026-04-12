<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tutorials.index') }}" class="btn btn-ghost btn-circle btn-sm hover:bg-base-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-base-content leading-tight">Manajemen Detail Tutorial</h2>
                <p class="text-sm text-gray-500">Mata Kuliah: {{ $tutorial->kode_matkul }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-1">
                <div class="card bg-base-100 shadow-xl border border-base-200 sticky top-24">
                    <div class="card-body p-5">
                        <h3 class="font-bold text-lg border-b border-base-300 pb-2 mb-3">Tambah Langkah Baru</h3>
                        
                        <form action="{{ route('tutorial.details.store', $tutorial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-control w-full mb-3">
                                <label class="label"><span class="label-text font-semibold">Teks / Penjelasan</span></label>
                                <textarea name="text" class="textarea textarea-bordered bg-base-100 text-base-content h-24 w-full focus:bg-base-200" placeholder="Ketik penjelasan langkah di sini..."></textarea>
                            </div>

                            <div class="form-control w-full mb-3">
                                <label class="label"><span class="label-text font-semibold">Kode Program (Opsional)</span></label>
                                <textarea name="code" class="textarea textarea-bordered bg-base-100 text-base-content font-mono h-24 w-full focus:bg-base-200" placeholder="<p>Hello World</p>"></textarea>
                            </div>

                            <div class="form-control w-full mb-3">
                                <label class="label"><span class="label-text font-semibold">Gambar (Opsional)</span></label>
                                <input type="file" name="image" class="file-input file-input-bordered file-input-sm w-full bg-base-100" accept="image/*" />
                            </div>

                            <div class="form-control w-full mb-5">
                                <label class="label"><span class="label-text font-semibold">Link / URL (Opsional)</span></label>
                                <input type="url" name="url" class="input input-bordered input-sm w-full bg-base-100 text-base-content" placeholder="https://..." />
                            </div>

                            <button type="submit" class="btn btn-primary w-full text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                Tambah Step
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-4">
                
                @if(session('success'))
                    <div role="alert" class="alert alert-success shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="pb-4 border-b-2 border-base-300">
                    <h1 class="text-4xl font-extrabold text-base-content">{{ $tutorial->title }}</h1>
                    
                    <div class="flex items-center gap-3 mt-4">
                        <a href="/presentation/{{ $tutorial->url_presentasi }}" target="_blank" class="btn btn-sm btn-primary text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Lihat Live Presentation
                        </a>
                        <button onclick="copyToClipboard('{{ url('/presentation/' . $tutorial->url_presentasi) }}')" class="btn btn-sm btn-outline btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                            Copy Share Link
                        </button>
                    </div>
                </div>

                @forelse($details as $detail)
                    <div class="card bg-base-100 shadow-sm border {{ $detail->status == 'show' ? 'border-success/50' : 'border-base-300 opacity-75' }} group transition-all duration-300">
                        <div class="card-body p-5">
                            
                            <div class="flex justify-between items-center mb-3 border-b border-base-200 pb-3">
                                <div class="flex items-center gap-2">
                                    <div class="badge badge-neutral badge-lg font-bold">Step {{ $detail->order }}</div>
                                    
                                    @if($detail->status == 'show')
                                        <div class="badge badge-success text-white badge-sm gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Dipublikasikan
                                        </div>
                                    @else
                                        <div class="badge badge-warning badge-sm gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                            Draft (Disembunyikan)
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    
                                    <form action="{{ route('tutorial.details.toggle', $detail->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if($detail->status == 'show')
                                            <button type="submit" class="btn btn-xs btn-warning btn-outline" title="Sembunyikan dari presentasi mahasiswa">Sembunyikan</button>
                                        @else
                                            <button type="submit" class="btn btn-xs btn-success text-white" title="Tampilkan ke presentasi publik">Publish Step</button>
                                        @endif
                                    </form>

                                    <form action="{{ route('tutorial.details.destroy', $detail->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-error btn-outline" onclick="return confirm('Hapus langkah ini secara permanen?')">Hapus</button>
                                    </form>
                                </div>
                            </div>

                            @if($detail->text)
                                <p class="text-base-content whitespace-pre-line leading-relaxed">{{ $detail->text }}</p>
                            @endif

                            @if($detail->image)
                                <div class="mt-4 bg-base-200 p-2 rounded-xl flex justify-center">
                                    <img src="{{ asset('storage/' . $detail->image) }}" alt="Tutorial Step" class="rounded-lg max-h-80 object-contain border border-base-300 shadow-sm">
                                </div>
                            @endif

                            @if($detail->code)
                                <div class="mockup-code mt-4 bg-neutral text-neutral-content shadow-md">
                                    <pre data-prefix=">"><code>{{ $detail->code }}</code></pre>
                                </div>
                            @endif

                            @if($detail->url)
                                <div class="mt-4">
                                    <a href="{{ $detail->url }}" target="_blank" class="btn btn-sm btn-outline btn-primary inline-flex gap-1">
                                        Buka Referensi Link
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-16 px-4 bg-base-100 rounded-box border border-base-200 border-dashed text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 text-base-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <h3 class="text-lg font-bold text-base-content mb-1">Belum ada langkah tutorial</h3>
                        <p class="text-sm">Silakan mulai dengan menambahkan langkah baru melalui form di samping.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            // Gunakan API modern jika tersedia dan berjalan di HTTPS
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('✅ Berhasil! Link presentasi disalin ke clipboard.');
                }).catch(err => {
                    alert('❌ Gagal menyalin link.');
                });
            } else {
                // Fallback khusus untuk lingkungan local/Laragon (tanpa HTTPS)
                let textArea = document.createElement("textarea");
                textArea.value = text;
                // Buat elemen tidak terlihat
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                try {
                    document.execCommand('copy');
                    alert('✅ Berhasil! Link presentasi disalin ke clipboard.');
                } catch (err) {
                    alert('❌ Gagal menyalin link.');
                }
                textArea.remove();
            }
        }
    </script>
</x-app-layout>