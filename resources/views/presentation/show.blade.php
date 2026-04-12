<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tutorial->title }} - Live Presentation</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-200 min-h-screen font-sans antialiased text-base-content">

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="text-5xl font-extrabold mb-4">{{ $tutorial->title }}</h1>
            <div class="flex justify-center gap-2">
                <span class="badge badge-primary badge-lg">{{ $tutorial->kode_matkul }}</span>
                <span class="badge badge-neutral badge-lg">By: {{ $tutorial->creator_email }}</span>
            </div>
        </div>

        <div class="space-y-8">
            @forelse($details as $detail)
                <div class="card bg-base-100 shadow-xl border border-base-300">
                    <div class="card-body">
                        
                        <h2 class="card-title text-2xl border-b pb-2 mb-4 text-primary">
                            Langkah {{ $detail->order }}
                        </h2>

                        @if($detail->text)
                            <p class="text-lg whitespace-pre-line mb-4">{{ $detail->text }}</p>
                        @endif

                        @if($detail->image)
                            <div class="my-4 flex justify-center">
                                <img src="{{ asset('storage/' . $detail->image) }}" alt="Step {{ $detail->order }}" class="rounded-xl max-h-96 object-contain border shadow-sm">
                            </div>
                        @endif

                        @if($detail->code)
                            <div class="mockup-code mt-4 mb-4 shadow-sm">
                                <pre><code>{{ $detail->code }}</code></pre>
                            </div>
                        @endif

                        @if($detail->url)
                            <div class="mt-2">
                                <a href="{{ $detail->url }}" target="_blank" class="btn btn-outline btn-primary btn-sm">Buka Link Referensi</a>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <div class="alert alert-warning shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span>Tutorial ini belum memiliki detail langkah-langkah.</span>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12 text-sm text-gray-500">
            Dibuat menggunakan <span class="font-bold">Stepify</span> &copy; {{ date('Y') }}
        </div>

    </div>

</body>
</html>