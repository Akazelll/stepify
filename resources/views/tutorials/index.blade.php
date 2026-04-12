<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-base-content leading-tight">
                {{ __('Manajemen Master Tutorial') }}
            </h2>
            <a href="{{ route('tutorials.create') }}" class="btn btn-primary btn-sm text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Tutorial
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Alert Notifikasi Sukses --}}
            @if (session('success'))
                <div role="alert" class="alert alert-success shadow-sm mb-5 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Kartu Tabel Utama --}}
            <div class="card bg-base-100 shadow-xl border border-base-200">
                <div class="card-body p-0">
                    <div class="overflow-x-auto rounded-box">
                        <table class="table table-zebra w-full">
                            <thead class="bg-base-200 text-base-content text-sm">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Tutorial</th>
                                    <th>Kode Matkul</th>
                                    <th>Creator Email</th>
                                    <th>URL Presentation</th>
                                    <th>URL PDF (Finished)</th>
                                    <th class="text-center w-48">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tutorials as $index => $item)
                                    <tr class="hover">
                                        <th>{{ $tutorials->firstItem() + $index }}</th>
                                        <td class="font-bold text-base">{{ $item->title }}</td>
                                        <td><span
                                                class="badge badge-neutral badge-outline font-semibold">{{ $item->kode_matkul }}</span>
                                        </td>
                                        <td>{{ $item->creator_email }}</td>

                                        <td>
                                            <a href="{{ route('presentation.show', $item->url_presentasi) }}"
                                                target="_blank"
                                                class="text-primary hover:text-primary-focus hover:underline text-sm inline-flex items-center gap-1 font-medium transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                Lihat Presentasi
                                            </a>
                                        </td>

                                        <td>
                                            @if ($item->url_final)
                                                <a href="{{ route('presentation.finished', $item->url_final) }}"
                                                    target="_blank"
                                                    class="text-error hover:text-red-700 hover:underline text-sm inline-flex items-center gap-1 font-bold transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                    Download PDF
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs italic">Belum ada URL</span>
                                            @endif
                                        </td>

                                        {{-- Kolom Aksi (Tombol Simetris) --}}
                                        <td>
                                            <div class="flex justify-center items-center flex-nowrap gap-2">

                                                {{-- Form untuk Tombol Detail (Agar sejajar sempurna dengan Form Hapus) --}}
                                                <form action="{{ route('tutorial.details.index', $item->id) }}"
                                                    method="GET" class="m-0 p-0 inline-flex">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-info text-white shadow-sm hover:shadow-md transition-shadow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                                        </svg>
                                                        Detail
                                                    </button>
                                                </form>

                                                {{-- Form Delete (Hapus) --}}
                                                <form action="{{ route('tutorials.destroy', $item->id) }}"
                                                    method="POST" class="m-0 p-0 inline-flex"
                                                    onsubmit="return confirm('Yakin ingin menghapus tutorial ini? Semua detail langkah di dalamnya juga akan terhapus secara permanen.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-error text-white shadow-sm hover:shadow-md transition-shadow">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- Tampilan Jika Data Masih Kosong --}}
                                    <tr>
                                        <td colspan="7" class="text-center py-10">
                                            <div class="flex flex-col items-center justify-center text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-12 w-12 mb-3 text-base-300" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="font-semibold text-lg text-base-content mb-1">Belum ada data
                                                    Master Tutorial.</p>
                                                <p class="text-sm">Silakan klik tombol "+ Tambah Tutorial" di pojok
                                                    kanan atas untuk memulai.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Pagination Links (Navigasi Halaman) --}}
                @if ($tutorials->hasPages())
                    <div class="p-4 border-t border-base-200 bg-base-50">
                        {{ $tutorials->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
