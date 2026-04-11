<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-base-content leading-tight">
                {{ __('Manajemen Master Tutorial') }}
            </h2>
            <a href="{{ route('tutorials.create') }}" class="btn btn-primary btn-sm">
                + Tambah Tutorial
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div role="alert" class="alert alert-success shadow-sm mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

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
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tutorials as $index => $item)
                                    <tr class="hover">
                                        <th>{{ $tutorials->firstItem() + $index }}</th>
                                        <td class="font-bold">{{ $item->title }}</td>
                                        <td><span class="badge badge-neutral badge-outline">{{ $item->kode_matkul }}</span></td>
                                        <td>{{ $item->creator_email }}</td>
                                        <td>
                                            <a href="/presentation/{{ $item->url_presentation }}" target="_blank" class="text-primary hover:underline text-xs">
                                                /presentation/{{ Str::limit($item->url_presentation, 15) }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="flex justify-center gap-2">
                                                {{-- Tombol Detail (Untuk Step 5 nanti) --}}
                                                <button class="btn btn-sm btn-info text-white">Detail</button>
                                                
                                                {{-- Form Delete --}}
                                                <form action="{{ route('tutorials.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tutorial ini? Semua detail di dalamnya juga akan terhapus.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('tutorial.details.index', $item->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-gray-500">Belum ada data Master Tutorial. Silakan tambah baru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- Pagination Links --}}
                @if($tutorials->hasPages())
                    <div class="p-4 border-t border-base-200">
                        {{ $tutorials->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>