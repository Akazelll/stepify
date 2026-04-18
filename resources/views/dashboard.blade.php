<x-app-layout>
    <div class="p-6 sm:p-10 max-w-6xl mx-auto">
        
        <div class="mb-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#020617] tracking-tight">Selamat Datang, {{ explode(' ', Auth::user()->name ?? 'Kreator')[0] }}! 👋</h1>
                <p class="text-slate-500 mt-1.5 text-sm">Berikut adalah ringkasan kelas dan tutorial Anda hari ini.</p>
            </div>
            <div>
                <a href="{{ route('tutorials.create') ?? '#' }}" class="inline-flex items-center justify-center rounded-xl bg-[#14B8A6] px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#0f9688] hover:shadow-md transition-all duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Buat Tutorial
                </a>
            </div>
        </div>

        @php
            $totalTutorials = \App\Models\Tutorial::count() ?? 0;
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-[#14B8A6]/10 flex items-center justify-center text-[#14B8A6]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Tutorial</p>
                    <h4 class="text-2xl font-bold text-[#020617] mt-1">{{ $totalTutorials }}</h4>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-[#0EA5E9]/10 flex items-center justify-center text-[#0EA5E9]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Koneksi API Matkul</p>
                    <h4 class="text-xl font-bold text-[#020617] mt-1">Status Aktif</h4>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-[0_2px_12px_-4px_rgba(0,0,0,0.04)] border border-slate-100 flex items-center gap-5 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-14 h-14 rounded-2xl bg-[#EC4899]/10 flex items-center justify-center text-[#EC4899]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Akses Kredensial</p>
                    <h4 class="text-xl font-bold text-[#020617] mt-1">Terverifikasi</h4>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-[0_2px_20px_-4px_rgba(0,0,0,0.03)] border border-slate-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="text-lg font-bold text-[#020617]">Daftar Mata Kuliah</h3>
                    <p class="text-xs text-slate-500 mt-1">Data disinkronisasi langsung dari Webservice Institusi.</p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-[#14B8A6]/10 text-[#14B8A6]">
                    <span class="w-2 h-2 rounded-full bg-[#14B8A6] animate-pulse"></span>
                    Live Sync
                </span>
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

            <div class="p-0">
                @if(!empty($makulData))
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider w-16 text-center">#</th>
                                    <th class="px-8 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Kode Mata Kuliah</th>
                                    <th class="px-8 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Nama Mata Kuliah</th>
                                    <th class="px-8 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Status Data</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($makulData as $index => $makul)
                                    <tr class="hover:bg-slate-50/70 transition-colors duration-150 group">
                                        <td class="px-8 py-5 text-sm text-slate-400 text-center font-medium">{{ $index + 1 }}</td>
                                        <td class="px-8 py-5">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-mono font-semibold bg-[#0EA5E9]/10 text-[#0EA5E9] border border-[#0EA5E9]/20">
                                                {{ $makul['kdmk'] }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5">
                                            <p class="text-sm font-semibold text-[#020617]">{{ $makul['nama'] }}</p>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <span class="inline-flex items-center text-xs font-medium text-slate-400 group-hover:text-[#14B8A6] transition-colors duration-200">
                                                Tersedia
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="py-16 flex flex-col items-center justify-center text-center">
                        <div class="w-16 h-16 bg-[#EC4899]/10 text-[#EC4899] rounded-2xl flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-[#020617]">Sesi API Berakhir / Gagal Memuat</h3>
                        <p class="text-sm text-slate-500 mt-2 max-w-sm">Tidak dapat terhubung ke Webservice. Silakan coba <a href="{{ route('login') }}" class="text-[#0EA5E9] font-bold hover:underline">login ulang</a> untuk memperbarui token akses Anda.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>