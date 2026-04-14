@props(['title'])

<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">

    <style>
        .slide-in {
            animation: slideIn 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px) scale(0.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        .mockup-code pre { padding-top: 0; padding-bottom: 0; }
        .hljs { background: transparent !important; padding: 1rem !important; }
    </style>
</head>
<body class="bg-base-200 min-h-screen flex flex-col font-sans antialiased text-base-content">

    {{ $slot }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    
    {{ $scripts ?? '' }}

</body>
</html>