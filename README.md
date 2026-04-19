<div align="center">

<h1>Stepify</h1>

<p><strong>Platform presentasi web untuk membuat & membagikan tutorial terstruktur secara interaktif.</strong></p>

<br />

[![Build Status](https://img.shields.io/badge/build-passing-brightgreen?style=flat-square&logo=github)](#)
[![Version](https://img.shields.io/badge/version-1.0.0-blue?style=flat-square&logo=semver)](#)
[![License](https://img.shields.io/badge/license-MIT-green?style=flat-square)](LICENSE)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.4-777BB4?style=flat-square&logo=php&logoColor=white)](#)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](#)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen?style=flat-square)](https://github.com/akazelll/stepify/pulls)

<br />

[🚀 Live Demo](https://stepify.example.com) · [🐛 Laporkan Bug](https://github.com/akazelll/stepify/issues/new?template=bug_report.md) · [✨ Request Fitur](https://github.com/akazelll/stepify/issues/new?template=feature_request.md)

</div>

---

## 📑 Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Teknologi yang Digunakan](#️-teknologi-yang-digunakan)
- [Memulai](#-memulai)
  - [Prasyarat](#prasyarat)
  - [Instalasi](#instalasi)
  - [Konfigurasi](#konfigurasi)
- [Cara Penggunaan](#-cara-penggunaan)
- [Fitur Unggulan](#-fitur-unggulan)
- [Peta Jalan](#️-peta-jalan)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)
- [Kontak & Kredit](#-kontak--kredit)

---

## 📖 Tentang Proyek

**Stepify** adalah aplikasi *web-based presentation* yang dirancang untuk membantu kreator — mulai dari dosen, instruktur, hingga *developer* — dalam menyusun, mengelola, dan membagikan tutorial secara **bertahap dan terstruktur**.

Masalah yang diselesaikan: penyampaian materi teknis yang kerap tidak terorganisir. Stepify menyediakan antarmuka terstruktur di mana setiap langkah tutorial bisa berupa teks, gambar, blok kode dengan *syntax highlighting*, atau tautan eksternal — lalu dipresentasikan secara interaktif atau diekspor ke PDF.

<br />



---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi | Kegunaan |
|---|---|---|
| [![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net) | `>= 8.2` | Bahasa pemrograman utama |
| [![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com) | `11.x` | Framework backend (MVC, Auth, API) |
| [![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com) | `3.x` | Styling & komponen UI |
| [![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com) | `8.x` | Database relasional |
| [![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vitejs.dev) | `5.x` | Asset bundler frontend |
| [![Snappy PDF](https://img.shields.io/badge/Snappy_PDF-barryvdh-red?style=flat-square)](https://github.com/barryvdh/laravel-snappy) | `latest` | Ekspor dokumen ke PDF |

---

## 🚀 Memulai

Ikuti langkah-langkah berikut untuk menjalankan Stepify di lingkungan lokal Anda.

### Prasyarat

Pastikan seluruh dependensi berikut sudah terpasang sebelum memulai:

- **PHP** `>= 8.2` — [Panduan instalasi](https://www.php.net/manual/en/install.php)
- **Composer** — [getcomposer.org](https://getcomposer.org)
- **Node.js & NPM** `>= 18.x` — [nodejs.org](https://nodejs.org)
- **MySQL** `>= 8.x`
- **wkhtmltopdf** — [wkhtmltopdf.org](https://wkhtmltopdf.org/downloads.html) _(wajib untuk fitur ekspor PDF)_

### Instalasi

**1. Clone repositori**

```bash
git clone https://github.com/akazelll/stepify.git
cd stepify
```

**2. Instal dependensi PHP dan JavaScript**

```bash
# Instal package PHP via Composer
composer install

# Instal package JavaScript via NPM
npm install
```

### Konfigurasi

**3. Salin file environment**

```bash
cp .env.example .env
```

**4. Generate application key**

```bash
php artisan key:generate
```

**5. Sesuaikan konfigurasi di file `.env`**

```env
# ── Database ───────────────────────────────────────────
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=stepify_db
DB_USERNAME=root
DB_PASSWORD=

# ── PDF Generator (wkhtmltopdf) ────────────────────────
# Sesuaikan path sesuai OS Anda:
# Linux   : /usr/local/bin/wkhtmltopdf
# macOS   : /usr/local/bin/wkhtmltopdf  (via Homebrew)
# Windows : C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe
WKHTMLTOPDF_PATH=/usr/local/bin/wkhtmltopdf
```

**6. Jalankan migrasi database**

```bash
# Migrasi skema + isi data awal (seeder)
php artisan migrate --seed
```

**7. Jalankan server lokal**

```bash
# Terminal 1 — Backend Laravel
php artisan serve

# Terminal 2 — Frontend Vite (HMR aktif)
npm run dev
```

Aplikasi kini berjalan di **`http://localhost:8000`** 🎉

---

## 💻 Cara Penggunaan

### 1. Membuat Master Tutorial

Setelah login, navigasi ke **Dashboard → Manajemen Tutorial**, lalu buat entri baru dengan mengisi Judul dan Kode Mata Kuliah. Sistem akan otomatis men-*generate* `url_presentation` dan `url_finished`.

### 2. Menambahkan Langkah Tutorial

Masuk ke detail master tutorial, lalu tambahkan langkah-langkah secara berurutan. Setiap langkah mendukung empat tipe konten:

| Tipe | Deskripsi |
|---|---|
| `text` | Paragraf penjelasan biasa |
| `image` | Gambar/ilustrasi pendukung |
| `code` | Blok kode dengan *syntax highlighting* |
| `url` | Tautan ke sumber eksternal |

### 3. Akses Mode Presentasi & Ekspor PDF

```bash
# Mode presentasi publik — hanya langkah berstatus 'show'
GET /presentation/{slug}-{id}

# Mode selesai & ekspor PDF — semua langkah 'show' + 'hide'
GET /finished/{slug}-{id}
```

### 4. Konsumsi REST API

```bash
# Ambil daftar tutorial berdasarkan kode mata kuliah
GET /api/tutorials?kode_matkul=A11.64404
```

Contoh respons JSON:

```json
{
  "results": [
    {
      "kode_matkul": "A11.64404",
      "nama_matkul": "Pemrograman Web Lanjut",
      "judul": "Hello World dengan PHP",
      "url_presentation": "http://localhost:8000/presentation/hello-world-dengan-php-1",
      "url_finished":     "http://localhost:8000/finished/hello-world-dengan-php-1",
      "creator_email": "creator@example.com",
      "created_at": "2025-03-01 07:50:45",
      "updated_at": "2025-03-06 14:23:11"
    }
  ]
}
```

---

## ✨ Fitur Unggulan

- **Manajemen Konten Relasional** — Struktur *One-to-Many* antara Master Tutorial dan Detail Langkah yang fleksibel
- **Multi-Format Konten** — Dukungan penuh untuk teks, gambar, blok kode *(syntax highlighting)*, dan URL eksternal
- **Kontrol Visibilitas Langkah** — Status `show`/`hide` untuk menyembunyikan detail tertentu dari presentasi publik, namun tetap tampil di halaman *finished*
- **Mode Presentasi Interaktif** — Tampilan layar penuh yang optimal untuk *live teaching* di kelas
- **Ekspor PDF Otomatis** — Mengubah seluruh materi tutorial menjadi dokumen PDF secara dinamis via `wkhtmltopdf`
- **RESTful API** — Endpoint JSON siap dikonsumsi aplikasi eksternal, difilter berdasarkan kode mata kuliah

---

## 🗺️ Peta Jalan

- [x] Autentikasi pengguna via Laravel Breeze
- [x] CRUD Master Tutorial & Detail Tutorial
- [x] Integrasi `barryvdh/laravel-snappy` untuk ekspor PDF
- [x] Mode presentasi publik berbasis URL slug
- [x] REST API endpoint data tutorial
- [ ] Integrasi *webservice* eksternal untuk sinkronisasi nama mata kuliah otomatis
- [ ] Optimasi rendering PDF untuk blok kode panjang
- [ ] Fitur komentar/anotasi pada mode presentasi
- [ ] Dukungan tema presentasi (dark/light)

Lihat [open issues](https://github.com/akazelll/stepify/issues) untuk daftar lengkap usulan fitur dan laporan bug.

---

## 🤝 Kontribusi

Kontribusi sangat disambut! Untuk memulai:

1. **Fork** repositori ini
2. Buat branch fitur baru
   ```bash
   git checkout -b feature/nama-fitur-anda
   ```
3. Commit perubahan dengan pesan yang deskriptif
   ```bash
   git commit -m "feat: menambahkan nama-fitur-anda"
   ```
4. Push ke branch Anda
   ```bash
   git push origin feature/nama-fitur-anda
   ```
5. Buka **Pull Request** ke branch `main`

Sebelum berkontribusi, baca [CONTRIBUTING.md](CONTRIBUTING.md) untuk memahami standar penulisan kode dan proses review.

---

## 📄 Lisensi

Proyek ini didistribusikan di bawah **MIT License** — bebas digunakan, dimodifikasi, dan didistribusikan dengan tetap mencantumkan atribusi. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

---

## 📞 Kontak & Kredit

**Dibuat dan dikelola oleh:**

**akazelll** — [@akazelll](https://github.com/akazelll) · [email@example.com](mailto:email@example.com)

Punya pertanyaan atau ide? Buka [diskusi](https://github.com/akazelll/stepify/discussions) di repositori ini.

<br />

**Ucapan Terima Kasih:**

- [Laravel](https://laravel.com) — _The PHP Framework for Web Artisans_
- [Tailwind CSS](https://tailwindcss.com) — _A utility-first CSS framework_
- [barryvdh/laravel-snappy](https://github.com/barryvdh/laravel-snappy) — _PDF & Image generation_
- [Shields.io](https://shields.io) — _Badge generator_

---

<div align="center">
  <sub>Dibuat dengan ❤️ oleh <a href="https://github.com/akazelll">akazelll</a></sub>
</div>
