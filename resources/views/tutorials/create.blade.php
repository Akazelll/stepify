<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 text-base-content">
            {{-- Tombol Back --}}
            <a href="{{ route('tutorials.index') }}" class="btn btn-ghost btn-circle btn-sm hover:bg-base-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            </a>
            <h2 class="font-bold text-2xl leading-tight">
                {{ __('Tambah Master Tutorial Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="card bg-base-100 shadow-xl border border-base-200 text-base-content">
                <div class="card-body">
                    
                    <h3 class="card-title text-lg border-b border-base-300 pb-3 mb-4">Informasi Dasar Tutorial</h3>

                    <form action="{{ route('tutorials.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text font-bold">Judul Tutorial <span class="text-error">*</span></span>
                            </label>
                            {{-- PERBAIKAN: Tambah bg-base-200 text-base-content agar kontras di Dark Mode --}}
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Instalasi Laravel 11 untuk Pemula" 
                                class="input input-bordered w-full bg-base-100 text-base-content placeholder-base-content/50 focus:bg-base-200 @error('title') input-error @enderror" required autofocus />
                            
                            @error('title')
                                <label class="label"><span class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full mb-4">
                            <label class="label">
                                <span class="label-text font-bold">Mata Kuliah <span class="text-error">*</span></span>
                                <span class="label-text-alt badge badge-neutral badge-sm">Data API</span>
                            </label>
                            {{-- PERBAIKAN: Tambah bg-base-100 text-base-content --}}
                            <select name="kode_matkul" class="select select-bordered w-full bg-base-100 text-base-content focus:bg-base-200 @error('kode_matkul') select-error @enderror" required>
                                <option value="" disabled selected>-- Pilih Mata Kuliah --</option>
                                
                                @if(!empty($makulData))
                                    @foreach($makulData as $makul)
                                        <option value="{{ $makul['kdmk'] }}" {{ old('kode_matkul') == $makul['kdmk'] ? 'selected' : '' }}>
                                            {{ $makul['kdmk'] }} - {{ $makul['nama'] }}
                                        </option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Gagal memuat data API (Coba refresh token/login ulang)</option>
                                @endif
                            </select>

                            @error('kode_matkul')
                                <label class="label"><span class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control w-full mb-6">
                            <label class="label">
                                <span class="label-text font-bold">Email Creator / Dosen <span class="text-error">*</span></span>
                            </label>
                            {{-- PERBAIKAN: Tambah bg-base-100 text-base-content --}}
                            <input type="email" name="creator_email" value="{{ old('creator_email') ?? 'aprilyani.safitri@gmail.com' }}" placeholder="email@contoh.com" 
                                class="input input-bordered w-full bg-base-100 text-base-content placeholder-base-content/50 focus:bg-base-200 @error('creator_email') input-error @enderror" required />
                            
                            @error('creator_email')
                                <label class="label"><span class="label-text-alt text-error font-medium">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-3 mt-2 border-t border-base-300 pt-5">
                            <a href="{{ route('tutorials.index') }}" class="btn btn-ghost text-base-content">Batal</a>
                            <button type="submit" class="btn btn-primary text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                                Simpan Tutorial
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>