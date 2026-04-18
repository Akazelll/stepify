@props(['title'])

<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">

    <style>
        /* Menerapkan Font dan Warna Dasar SaaS */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F1F5F9;
            /* Latar Belakang Abu-abu Lembut */
            color: #020617;
            /* Teks Utama Gelap */
        }

        /* Animasi Kustom untuk Kemunculan Langkah (Live Feel) */
        .slide-up-fade {
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes slideUpFade {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Desain Scrollbar Elegan ala MacOS/Notion */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        /* Penyesuaian Estetika Blok Kode */
        .mockup-code {
            background-color: #0F172A !important;
        }

        /* Latar belakang gelap khusus */
        .mockup-code pre {
            padding-top: 0;
            padding-bottom: 0;
        }

        .hljs {
            background: transparent !important;
            padding: 1.5rem !important;
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* Utilitas Transisi Halus untuk Mode Fokus */
        .layout-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body class="antialiased overflow-hidden selection:bg-[#14B8A6]/30 selection:text-[#0f9688]">

    {{ $slot }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

    {{ $scripts ?? '' }}

</body>

</html>
