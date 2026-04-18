<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stepify') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Menerapkan font ke seluruh body */
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="font-sans antialiased text-[#020617] bg-[#F1F5F9]">
    
    <div class="flex h-screen overflow-hidden">
        
        @include('layouts.navigation')

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="md:hidden bg-white border-b border-slate-200 p-4 flex justify-between items-center">
                <span class="font-bold text-xl text-[#14B8A6]">Stepify</span>
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F1F5F9]">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>