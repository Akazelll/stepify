<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Master Tutorial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">List Mata Kuliah (Dari API Webservice)</h3>
                    
                    @php
                        // Ambil dan bersihkan token
                        $rawToken = \Illuminate\Support\Facades\Session::get('refreshToken');
                        $cleanToken = trim(str_replace('"', '', $rawToken));

                        // Tembak API dengan header manual persis seperti Postman
                        $response = \Illuminate\Support\Facades\Http::withHeaders([
                            'Authorization' => 'Bearer ' . $cleanToken,
                            'Accept'        => 'application/json',
                        ])->get('https://jwt-auth-eight-neon.vercel.app/getMakul');
                        
                        $makulData = $response->successful() ? $response->json('data') : [];
                    @endphp

                    @if(!empty($makulData))
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Kode Mata Kuliah</th>
                                        <th>Nama Mata Kuliah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($makulData as $makul)
                                        <tr>
                                            <td><span class="badge badge-primary">{{ $makul['kdmk'] }}</span></td>
                                            <td>{{ $makul['nama'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <span>Gagal memuat data dari Webservice. Silakan coba login ulang.</span>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>