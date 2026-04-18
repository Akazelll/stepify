<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $tutorial->title }} - Modul PDF</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

    <style>
        /* === BASE STYLE === */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #020617;
            /* Teks Utama Gelap */
            line-height: 1.6;
            font-size: 13px;
            margin: 0;
            padding: 20px 30px;
            background-color: #ffffff;
        }

        /* === KOP / HEADER DOKUMEN === */
        .header {
            margin-bottom: 40px;
            padding-bottom: 25px;
            border-bottom: 2px solid #F1F5F9;
            /* Abu-abu lembut */
        }

        .header-meta {
            margin-bottom: 15px;
        }

        .badge-matkul {
            display: inline-block;
            background-color: #E0F2FE;
            /* Biru muda transparan */
            color: #0EA5E9;
            /* Biru Sekunder */
            border: 1px solid #BAE6FD;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .title {
            font-size: 28px;
            font-weight: 800;
            margin: 10px 0;
            color: #020617;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .subtitle {
            font-size: 13px;
            color: #64748B;
            margin: 5px 0;
        }

        /* === KARTU LANGKAH (STEP CONTAINER) === */
        .step-container {
            margin-bottom: 30px;
            page-break-inside: avoid;
            /* Wajib untuk PDF agar kartu tidak terpotong beda halaman */
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            background-color: #ffffff;
        }

        /* HEADER LANGKAH */
        .step-header {
            background-color: #F8FAFC;
            /* Abu-abu sangat terang */
            padding: 15px 20px;
            border-bottom: 1px solid #E2E8F0;
            border-radius: 12px 12px 0 0;
        }

        .step-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .step-number {
            display: inline-block;
            background-color: #020617;
            color: #ffffff;
            width: 28px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            border-radius: 6px;
            font-weight: 800;
            font-size: 14px;
            margin-right: 10px;
        }

        .step-title {
            font-size: 16px;
            font-weight: 800;
            color: #020617;
            vertical-align: middle;
        }

        .status-draft {
            background-color: #FDF2F8;
            /* Latar Pink Lembut */
            color: #EC4899;
            /* Pink Aksen */
            border: 1px solid #FBCFE8;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* KONTEN BODY */
        .step-body {
            padding: 20px;
        }

        .step-text {
            margin-bottom: 18px;
            white-space: pre-wrap;
            color: #334155;
            font-size: 13.5px;
        }

        /* BLOK GAMBAR */
        .step-image {
            text-align: center;
            margin: 20px 0;
            background-color: #F8FAFC;
            padding: 15px;
            border: 1px solid #F1F5F9;
            border-radius: 8px;
        }

        .step-image img {
            max-width: 100%;
            max-height: 350px;
            border-radius: 6px;
        }

        /* BLOK KODE PROGRAM */
        .code-wrapper {
            margin-bottom: 18px;
            border-radius: 8px;
            background-color: #0F172A;
            /* Latar Gelap Khas Developer */
            border: 1px solid #1E293B;
            overflow: hidden;
        }

        .code-header {
            background-color: #020617;
            padding: 8px 15px;
            border-bottom: 1px solid #1E293B;
            color: #94A3B8;
            font-size: 11px;
            font-weight: 600;
            font-family: "SFMono-Regular", Consolas, monospace;
        }

        .step-code {
            color: #F8FAFC;
            padding: 15px;
            font-family: "SFMono-Regular", Consolas, "Liberation Mono", Menlo, monospace;
            font-size: 12px;
            white-space: pre-wrap;
            word-wrap: break-word;
            /* Wajib agar kode tidak keluar kertas PDF */
            margin: 0;
        }

        /* TAUTAN REFERENSI (URL) */
        .step-url {
            background-color: #FDF2F8;
            /* Latar Pink Sangat Lembut */
            padding: 14px 18px;
            border: 1px solid #FBCFE8;
            border-radius: 8px;
            font-size: 12.5px;
            word-wrap: break-word;
            color: #BE185D;
            margin-top: 10px;
        }

        .step-url strong {
            color: #9D174D;
            display: block;
            margin-bottom: 2px;
        }

        .step-url a {
            color: #EC4899;
            /* Pink Aksen */
            font-weight: 600;
            text-decoration: none;
        }

        /* FOOTER PDF */
        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
            font-size: 11px;
            color: #94A3B8;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="header-meta">
            <span class="badge-matkul">{{ $tutorial->kode_matkul }}</span>
        </div>
        <h1 class="title">{{ $tutorial->title }}</h1>
        <table style="width: 100%; margin-top: 15px;">
            <tr>
                <td style="width: 60%;">
                    <p class="subtitle"><strong>Kreator:</strong> {{ $tutorial->creator_email }}</p>
                </td>
                <td style="width: 40%; text-align: right;">
                    <p class="subtitle"><strong>Diekspor pada:</strong> {{ date('d F Y') }}</p>
                </td>
            </tr>
        </table>
    </div>

    @forelse($details as $detail)
        <div class="step-container">

            <div class="step-header">
                <table>
                    <tr>
                        <td style="width: 80%; text-align: left;">
                            <span class="step-number">{{ $detail->order }}</span>
                            <span class="step-title">Instruksi Langkah</span>
                        </td>
                        <td style="width: 20%; text-align: right;">
                            @if ($detail->status === 'hide')
                                <span class="status-draft">Draft (Hidden)</span>
                            @endif
                        </td>
                    </tr>
                </table>
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
                    <div class="code-wrapper">
                        <div class="code-header">Source Code Snippet</div>
                        <pre class="step-code">{{ $detail->code }}</pre>
                    </div>
                @endif

                @if ($detail->url)
                    <div class="step-url">
                        <strong>Tautan Referensi Eksternal:</strong>
                        <a href="{{ $detail->url }}" target="_blank">{{ $detail->url }}</a>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div
            style="text-align: center; padding: 50px 20px; color: #64748B; background: #F8FAFC; border-radius: 12px; border: 1px dashed #CBD5E1;">
            <p style="font-size: 16px; font-weight: 800; margin-bottom: 5px; color: #020617;">Belum Ada Materi</p>
            <p>Data instruksi untuk tutorial ini belum dibuat oleh pengajar.</p>
        </div>
    @endforelse

    <div class="footer">
        Dihasilkan secara otomatis oleh sistem <strong>Stepify</strong> &copy; {{ date('Y') }}
    </div>

</body>

</html>
