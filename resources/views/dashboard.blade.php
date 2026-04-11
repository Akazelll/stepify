<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-base-content leading-tight flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
            </svg>
            {{ __('Dashboard Master Tutorial') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body">
                    
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="card-title text-xl">
                            Daftar Mata Kuliah
                            <div class="badge badge-neutral">API Service</div>
                        </h3>
                    </div>
                    
                    @php
                        $rawToken = \Illuminate\Support\Facades\Session::get('refreshToken');
                        $cleanToken = trim(str_replace('"', '', $rawToken));

                        $response = \Illuminate\Support\Facades\Http::withHeaders([
                            'Authorization' => 'Bearer ' . $cleanToken,
                            'Accept'        => 'application/json',
                        ])->get('https://jwt-auth-eight-neon.vercel.app/getMakul');
                        
                        $makulData = $response->successful() ? $response->json('data') : [];
                    @endphp

                    @if(!empty($makulData))
                        {{-- STRUKTUR TABEL SESUAI PERMINTAAN DAISYUI --}}
                        <div class="overflow-x-auto rounded-box border border-base-200">
                            <table class="table table-zebra w-full">
                                <thead class="bg-base-200 text-base-content text-sm">
                                    <tr>
                                        <th></th> {{-- Kolom kosong untuk nomor --}}
                                        <th>Kode Mata Kuliah</th>
                                        <th>Nama Mata Kuliah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($makulData as $index => $makul)
                                        <tr class="hover">
                                            {{-- Menggunakan tag <th> untuk penomoran sesuai template DaisyUI --}}
                                            <th>{{ $index + 1 }}</th>
                                            <td>
                                                <div class="badge badge-primary badge-outline font-semibold">
                                                    {{ $makul['kdmk'] }}
                                                </div>
                                            </td>
                                            <td class="font-medium text-base-content">
                                                {{ $makul['nama'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div role="alert" class="alert alert-error shadow-sm mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <div>
                                <h3 class="font-bold">Gagal memuat data!</h3>
                                <div class="text-sm">Tidak dapat terhubung ke Webservice. Silakan coba <a href="{{ route('login') }}" class="underline font-bold hover:text-white">login ulang</a>.</div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>