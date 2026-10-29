<div align="center">

# 🌿 BaTeCNusantara.id

**Portal dokumentasi dan eksplorasi budaya Bayan**
Ritual adat · Cerita rakyat · Musik tradisional · Sejarah & filosofi · Motif tenun · Paket wisata

![Status](https://img.shields.io/badge/status-perencanaan-orange?style=flat-square)
![Spesifikasi](https://img.shields.io/badge/spesifikasi-Revisi%206-blue?style=flat-square)
![Laravel](https://img.shields.io/badge/Laravel-Filament-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-Alpine.js-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)
![Lisensi](https://img.shields.io/badge/lisensi-belum_ditentukan-lightgrey?style=flat-square)

[Ruang Lingkup](#-ruang-lingkup) · [Fitur](#-fitur-utama) · [Teknologi](#-teknologi) · [Halaman](#-peta-halaman) · [Database](#-database) · [Keamanan](#-keamanan-dan-operasional) · [Instalasi](#-menjalankan-secara-lokal)

</div>

---

> 📌 **Status:** tahap perencanaan. Spesifikasi lengkap ada di [`docs/struktur-batecnusantara-rev6.md`](docs/struktur-batecnusantara-rev6.md) (Revisi 6 — Final). README ini hanya ringkasannya.

## 🎯 Ruang Lingkup

| | |
|---|---|
| 📚 **Dokumentasi budaya** | Ritual (linimasa interaktif), cerita rakyat, musik (galeri audio), sejarah & filosofi |
| 🧵 **Galeri motif tenun** | Katalog dokumentasi, **bukan toko**. Tautan marketplace eksternal bersifat opsional |
| 🧭 **Paket tour** | Mitra wisata, paket dengan timeline destinasi, pemesanan dengan konfirmasi manual via WhatsApp |
| 📰 **Berita & video** | Blog dinamis dan pustaka video berkategori |
| 🚫 **Di luar cakupan** | Marketplace dan etnomatematika (sudah ada di web lain) |
| 🌐 **Hosting** | Berjalan di subdomain, mis. `budaya.[domain-utama].id` |

## ✨ Fitur Utama

### 🏛️ Konten Budaya
- Konten per kategori dengan foto, audio, dan video (upload atau tautan YouTube), status draft/terbit.
- **Narasumber** dipilih lewat dropdown (boleh lebih dari satu per konten), punya foto, dan tampil di halaman detail semua budaya. Kontaknya privat.
- **Sejarah & Filosofi** berupa satu halaman tetap (`/budaya/sejarah`) yang memuat kontennya secara berurutan.

### 🧳 Paket Tour
- **Satu pesanan = satu orang**; rombongan mendaftar satu per satu.
- Paket dan harga selalu dibaca dari database saat submit, bukan dari formulir. Harga tersimpan di `harga_saat_pesan`.
- Alur: halaman sukses → hitung mundur 2 detik → WhatsApp admin terbuka dengan pesan terisi → admin konfirmasi manual → admin kirim WA ke tiap mitra (data minimal, tanpa nomor WA wisatawan).

### 🏠 Beranda (13 bagian)
Navigasi · hero · pengantar · angka terdokumentasi · tentang web + video loop · kategori budaya · konten pilihan · galeri tenun · paket unggulan · Kata Tokoh · testimoni · Supported by · footer.
Bagian yang kosong disembunyikan otomatis. Tombol chat WhatsApp mengambang tersedia di semua halaman publik.

### 🧩 Lainnya
- 📝 Halaman **Tentang** dan **Kebijakan Privasi** dapat diedit dari admin (dua halaman tetap).
- ♿ **Aksesibilitas** sebagai standar: teks `alt` gambar, kontras, navigasi keyboard, jeda carousel, `prefers-reduced-motion`.

## 🛠️ Teknologi

| Lapisan | Pilihan (usulan) |
|---|---|
| ⚙️ Backend | Laravel, dengan SoftDeletes untuk mitra dan paket |
| 🗂️ Panel admin | Filament |
| 🎨 Front-end | Blade + Tailwind CSS + Alpine.js |
| 🖥️ Server | VPS dengan Nginx |
| 💾 Backup | `spatie/laravel-backup` |
| 🖼️ Gambar | Intervention Image atau Spatie Media Library (WebP, sisi terpanjang maks. 1600 px) |

## 🗺️ Peta Halaman

<details open>
<summary><b>🌍 Halaman publik</b></summary>

| Rute | Isi |
|---|---|
| `/` | Beranda |
| `/budaya` | Eksplorasi budaya |
| `/budaya/sejarah` | Sejarah & Filosofi (satu halaman) |
| `/budaya/ritual`, `/budaya/cerita`, `/budaya/musik` | Daftar per kategori; detail di `/{kategori}/{slug}` |
| `/tenun`, `/tenun/{slug}` | Galeri dan detail motif tenun |
| `/paket-tour`, `/paket-tour/{slug}` | Daftar dan detail paket |
| `/paket-tour/{slug}/pesan` | Formulir pendaftaran |
| `/pemesanan/sukses` | Pendaftaran berhasil |
| `/berita`, `/berita/{slug}` | Berita/blog |
| `/video`, `/video/{slug}` | Pustaka video |
| `/tentang`, `/kontak`, `/kebijakan-privasi` | Halaman informasi |

</details>

<details>
<summary><b>🔐 Panel admin (<code>/admin</code>)</b></summary>

| Kelompok | Menu |
|---|---|
| Budaya | Kategori Budaya · Budaya · Narasumber · Motif Tenun |
| Paket tour | Mitra Wisata · Paket Wisata · Pesanan Paket |
| Beranda | Tokoh · Testimoni · Supported By · Kontak Chat |
| Berita & video | Berita · Kategori Berita · Video · Kategori Video |
| Sistem | Dashboard · Halaman · User Admin · Pengaturan Situs |

</details>

## 🗄️ Database

**26 tabel.** Relasi pentingnya:

```
paket_tour ──< paket_destinasi >── mitra_wisata
paket_tour ──< pesanan_tour ──< notifikasi_mitra >── mitra_wisata
konten_budaya >──< narasumber        (lewat konten_narasumber)
motif_tenun   >── narasumber         (opsional)
tokoh                                (berdiri sendiri, hanya untuk Beranda)
halaman                              (2 baris tetap lewat seeder: Tentang, Kebijakan Privasi)
```

> ℹ️ `tokoh` dan `narasumber` sengaja dipisah: tokoh hanya tampil di Beranda, narasumber dipakai di konten budaya dan motif tenun.

Skema lengkap ada di Bagian 4 dokumen spesifikasi.

## 👥 Peran Pengguna

| Peran | Akses (usulan) |
|---|---|
| 🛡️ **Admin** | Semua menu, termasuk paket tour, pesanan, user, halaman Tentang/Kebijakan Privasi, dan hapus narasumber |
| ✏️ **Kurator** | Konten (budaya, motif tenun, berita) serta tambah/ubah narasumber |

Pembagian peran masih berstatus usulan di dokumen spesifikasi.

## 🔒 Keamanan dan Operasional

- 💾 Backup database harian dan media mingguan, disimpan **di luar VPS**; uji pemulihan sebelum peluncuran.
- 🤖 Anti-spam formulir: honeypot, token sekali pakai, validasi format nomor WA dan tanggal. Tanpa pembatasan per IP dan tanpa captcha untuk saat ini.
- 🧼 Isi dari editor teks kaya (berita dan halaman) dibersihkan (sanitize HTML).
- ✅ Checkbox persetujuan data pribadi wajib dan divalidasi di server.
- 📤 Batas upload perlu disetel di tiga tempat: `upload_max_filesize` dan `post_max_size` (PHP), serta `client_max_body_size` (Nginx).

> ⚠️ **Ditunda:** pembatasan percobaan login admin dan 2FA. Sebelum peluncuran publik, minimal throttle login sebaiknya dipertimbangkan.

## 🚀 Menjalankan Secara Lokal

> Kode aplikasi belum dibuat, jadi langkah di bawah masih kerangka umum Laravel dan perlu disesuaikan setelah proyek diinisialisasi.

```bash
git clone <url-repo>
cd <nama-folder>
composer install
npm install
cp .env.example .env
php artisan key:generate
# atur koneksi database di .env
php artisan migrate --seed   # seeder membuat dua halaman tetap (Tentang, Kebijakan Privasi)
npm run dev
php artisan serve
```

## 🧭 Rencana Lanjutan

- [ ] Pembatasan login admin dan 2FA
- [ ] Kompresi video otomatis di server (ffmpeg lewat antrean; opsional, butuh CPU VPS yang cukup)
- [ ] Halaman profil narasumber (opsional)

## 📖 Dokumentasi

- 📄 [`docs/struktur-batecnusantara-rev6.md`](docs/struktur-batecnusantara-rev6.md): sitemap, modul admin, tampilan Beranda, alur pemesanan, skema database, upload media, backup, dan keputusan yang sudah ditetapkan.

## 📜 Lisensi

Belum ditentukan.
