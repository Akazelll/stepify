<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tutorial: {{ $tutorial->title }}</title>
    <style>
        /* BASE STYLE: Bersih dan Modern menggunakan font sistem bawaan OS */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #1f2937;
            /* Teks abu-abu gelap agar tidak terlalu kontras di mata */
            line-height: 1.6;
            font-size: 13px;
            margin: 0;
            padding: 15px 25px;
            background-color: #ffffff;
        }

        /* HEADER: Rapi dengan warna aksen Indigo */
        .header {
            text-align: center;
            padding-bottom: 20px;
            margin-bottom: 30px;
            border-bottom: 2px solid #e5e7eb;
        }

        .title {
            font-size: 26px;
            font-weight: 800;
            margin: 0 0 8px 0;
            color: #1e3a8a;
            /* Indigo gelap */
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 13px;
            color: #6b7280;
            margin: 4px 0;
        }

        /* CONTAINER LANGKAH (STEP): Desain Kartu (Card) */
        .step-container {
            margin-bottom: 25px;
            page-break-inside: avoid;
            /* Mencegah terpotong di halaman PDF baru */
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            /* Sudut melengkung modern */
            background-color: #ffffff;
        }

        /* HEADER LANGKAH */
        .step-header {
            background-color: #f8fafc;
            padding: 12px 16px;
            border-bottom: 1px solid #e5e7eb;
            border-radius: 8px 8px 0 0;
            border-left: 4px solid #3b82f6;
            /* Garis aksen biru di kiri */
            font-size: 16px;
            font-weight: bold;
            color: #0f172a;
        }

        /* BADGE DRAFT: Gaya "Pill" modern */
        .status-draft {
            background-color: #fef3c7;
            color: #d97706;
            padding: 3px 10px;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            float: right;
            margin-top: 2px;
        }

        /* KONTEN BODY (Dalam Kartu) */
        .step-body {
            padding: 16px;
        }

        .step-text {
            margin-bottom: 15px;
            white-space: pre-wrap;
            text-align: justify;
            color: #374151;
        }

        /* CODE BLOCK: Gaya Dark Mode ala VS Code */
        .step-code {
            background-color: #1e293b;
            /* Biru sangat gelap */
            color: #f8fafc;
            padding: 16px;
            border-radius: 6px;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, monospace;
            font-size: 12px;
            white-space: pre-wrap;
            word-wrap: break-word;
            margin-bottom: 15px;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }

        /* IMAGE: Sudut melengkung dan shadow tipis */
        .step-image {
            text-align: center;
            margin: 20px 0;
            background-color: #f3f4f6;
            padding: 10px;
            border-radius: 6px;
        }

        .step-image img {
            max-width: 100%;
            max-height: 400px;
            border-radius: 4px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        /* URL LINK: Desain Alert Box Biru */
        .step-url {
            background-color: #eff6ff;
            padding: 12px 16px;
            border: 1px solid #bfdbfe;
            border-radius: 6px;
            font-size: 12px;
            word-wrap: break-word;
            color: #1e40af;
        }

        .step-url a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 11px;
            color: #9ca3af;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1 class="title">{{ $tutorial->title }}</h1>
        <p class="subtitle">Kode Mata Kuliah: <strong style="color: #374151;">{{ $tutorial->kode_matkul }}</strong></p>
        <p class="subtitle">Disusun Oleh: <strong style="color: #374151;">{{ $tutorial->creator_email }}</strong></p>
        <p class="subtitle" style="margin-top: 8px; font-size: 11px;">Dicetak pada: {{ date('d F Y') }}</p>
    </div>

    @forelse($details as $detail)
        <div class="step-container">
            <div class="step-header">
                Langkah {{ $detail->order }}
                @if ($detail->status === 'hide')
                    <span class="status-draft">Draft</span>
                @endif
            </div>

            <div class="step-body">
                @if ($detail->text)
                    <div class="step-text">{{ $detail->text }}</div>
                @endif

                @if ($detail->image)
                    <div class="step-image">
                        <img src="{{ public_path('storage/' . $detail->image) }}"
                            alt="Ilustrasi Langkah {{ $detail->order }}">
                    </div>
                @endif

                @if ($detail->code)
                    <div class="step-code">{{ $detail->code }}</div>
                @endif

                @if ($detail->url)
                    <div class="step-url">
                        <span style="margin-right: 5px;">🔗</span>
                        <strong>Referensi Tambahan:</strong> <a href="{{ $detail->url }}"
                            target="_blank">{{ $detail->url }}</a>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div
            style="text-align: center; padding: 60px 20px; color: #9ca3af; background: #f9fafb; border-radius: 8px; border: 1px dashed #d1d5db;">
            <p style="font-size: 16px; font-weight: bold; margin-bottom: 5px; color: #6b7280;">Belum ada langkah
                tutorial</p>
            <p>Data langkah (step) untuk tutorial ini belum ditambahkan oleh pembuat.</p>
        </div>
    @endforelse

    <div class="footer">
        Dihasilkan oleh <strong>Sistem Stepify</strong> &copy; {{ date('Y') }}
    </div>

</body>

</html>
