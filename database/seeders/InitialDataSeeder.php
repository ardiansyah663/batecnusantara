<?php

namespace Database\Seeders;

use App\Models\BudayaKategori;
use App\Models\Halaman;
use App\Models\Pengaturan;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Data awal. Aman dijalankan ulang: memakai firstOrCreate sehingga
 * isi yang sudah diedit admin tidak tertimpa.
 *
 *   php artisan db:seed --class=InitialDataSeeder
 */
class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        // Role. "admin" = super_admin dari Shield; kurator diatur izinnya di Fase 3.
        Role::firstOrCreate(['name' => 'kurator', 'guard_name' => 'web']);

        // Kategori budaya awal (slug 'sejarah' dipakai oleh halaman /budaya/sejarah)
        $kategori = [
            ['nama' => 'Ritual Adat', 'slug' => 'ritual', 'urutan' => 1],
            ['nama' => 'Cerita Rakyat', 'slug' => 'cerita', 'urutan' => 2],
            ['nama' => 'Musik Tradisional', 'slug' => 'musik', 'urutan' => 3],
            ['nama' => 'Sejarah & Filosofi', 'slug' => 'sejarah', 'urutan' => 4],
        ];
        foreach ($kategori as $k) {
            BudayaKategori::firstOrCreate(['slug' => $k['slug']], $k + ['status' => 'aktif']);
        }

        // Dua halaman tetap (isi awal sementara, diedit admin di Kelola Halaman)
        Halaman::firstOrCreate(['kunci' => 'tentang'], [
            'judul' => 'Tentang BaTeCNusantara',
            'isi' => '<p>Isi halaman Tentang akan diisi melalui Admin Panel.</p>',
        ]);
        Halaman::firstOrCreate(['kunci' => 'kebijakan-privasi'], [
            'judul' => 'Kebijakan Privasi',
            'isi' => '<p>Isi Kebijakan Privasi akan diisi melalui Admin Panel.</p>',
        ]);

        // Pengaturan bawaan
        $pengaturan = [
            'nama_situs' => 'BaTeCNusantara',
            'tagline' => 'Bayan Technology and Culture Nusantara',
            'hero_judul' => 'Jelajahi Budaya Masyarakat Bayan',
            'hero_subjudul' => 'Dokumentasi ritual adat, cerita rakyat, musik, dan tenun Bayan, Lombok Utara.',
            'hero_tombol_1' => 'Jelajahi Budaya',
            'hero_tombol_2' => 'Lihat Paket Tour',
            'pengantar_teks' => '',
            'tentang_web_judul' => 'Tentang Web Ini',
            'tentang_web_teks' => '',
            'footer_teks' => '',
            'footer_alamat' => '',
            'footer_email' => '',
            'footer_wa' => '',
            'footer_jam' => '',
            'footer_tautan' => '[]',
            'hak_cipta' => '© BaTeCNusantara',
            'sosmed_instagram' => '',
            'sosmed_facebook' => '',
            'sosmed_youtube' => '',
            'sosmed_tiktok' => '',
            'wa_admin' => '',
            'wa_template_admin' => 'Halo Admin, saya {nama} ingin memesan paket {paket} (kode {kode}) untuk tanggal {tanggal}.',
            'wa_template_mitra' => 'Halo, ada wisatawan {nama} untuk paket {paket} pada {tanggal} pukul {jam} (kode {kode}).',
            'chat_aktif' => '1',
            'chat_label' => 'Tanya BaTeCNusantara',
            'chat_sapaan' => 'Halo! Silakan pilih kontak di bawah ini.',
            'chat_pesan_awal' => 'Halo, saya ingin bertanya tentang BaTeCNusantara.',
        ];
        foreach ($pengaturan as $kunci => $nilai) {
            Pengaturan::firstOrCreate(['kunci' => $kunci], ['nilai' => $nilai]);
        }
    }
}
