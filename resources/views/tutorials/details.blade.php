<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('tutorials.index') }}" class="btn btn-ghost btn-circle btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-base-content leading-tight">Manajemen Detail Tutorial</h2>
                <p class="text-sm text-gray-500">Mata Kuliah: {{ $tutorial->kode_matkul }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <div class="md:col-span-1">
                <div class="card bg-base-100 shadow-xl border border-base-200 sticky top-24">
                    <div class="card-body">
                        <h3 class="font-bold text-lg border-b pb-2 mb-3">Tambah Langkah Baru</h3>
                        
                        <form action="{{ route('tutorial.details.store', $tutorial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-control w-full mb-3">
                                <label class="label"><span class="label-text font-semibold">Teks / Penjelasan</span></label>
                                <textarea name="text" class="textarea textarea-bordered h-24 w-full" placeholder="Ketik penjelasan langkah di sini..."></textarea>
                            </div>

                            <div class="form-control w-full mb-3">
                                <label class="label"><span class="label-text font-semibold">Kode Program (Opsional)</span></label>
                                <textarea name="code" class="textarea textarea-bordered font-mono h-24 w-full" placeholder="<p>Hello World</p>"></textarea>
                            </div>

                            <div class="form-control w-full mb-3">
                                <label class="label"><span class="label-text font-semibold">Gambar (Opsional)</span></label>
                                <input type="file" name="image" class="file-input file-input-bordered file-input-sm w-full" accept="image/*" />
                            </div>

                            <div class="form-control w-full mb-4">
                                <label class="label"><span class="label-text font-semibold">Link / URL (Opsional)</span></label>
                                <input type="url" name="url" class="input input-bordered input-sm w-full" placeholder="https://..." />
                            </div>

                            <button type="submit" class="btn btn-primary w-full text-white">+ Tambah Step</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 space-y-4">
                
                @if(session('success'))
                    <div role="alert" class="alert alert-success shadow-sm">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <div class="pb-4 border-b-2 border-base-300">
                    <h1 class="text-4xl font-extrabold">{{ $tutorial->title }}</h1>
                    <a href="/presentation/{{ $tutorial->url_presentation }}" target="_blank" class="text-sm text-primary hover:underline mt-2 inline-block">🔗 Lihat Live Presentation</a>
                </div>

                @forelse($details as $detail)
                    <div class="card bg-base-100 shadow-sm border border-base-200 group">
                        <div class="card-body p-5">
                            <div class="flex justify-between items-start mb-2">
                                <div class="badge badge-neutral">Step {{ $detail->order }}</div>
                                
                                <form action="{{ route('tutorial.details.destroy', $detail->id) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-error btn-outline" onclick="return confirm('Hapus langkah ini?')">Hapus</button>
                                </form>
                            </div>

                            @if($detail->text)
                                <p class="text-base-content whitespace-pre-line">{{ $detail->text }}</p>
                            @endif

                            @if($detail->image)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $detail->image) }}" alt="Tutorial Step" class="rounded-xl max-h-64 object-cover border">
                                </div>
                            @endif

                            @if($detail->code)
                                <div class="mockup-code mt-4">
                                    <pre><code>{{ $detail->code }}</code></pre>
                                </div>
                            @endif

                            @if($detail->url)
                                <div class="mt-3">
                                    <a href="{{ $detail->url }}" target="_blank" class="btn btn-sm btn-outline btn-primary">Buka Referensi Link</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforelse

                @if($details->isEmpty())
                    <div class="text-center py-10 text-gray-400">
                        Belum ada langkah tutorial. Silakan tambah melalui form di samping.
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>