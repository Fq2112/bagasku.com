<?php

use Illuminate\Database\Seeder;

class SubKategoriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub[] = [
            'Desain UI/UX Website',
            'Pembuatan Website Companny Profile',
            'Website E-commerce / Toko Online',
            'Pemeliharaan Situs Web (Shared Hosting)',
            'Pemeliharaan Situs Web (Situs Web VPS)',
            'Pembuatan Sistus Pribadi',
            'Perbaikan Bug Pada Website',
            'Slicing ke HTML',
            'Pengembangan Website Lainnya'
        ];

        $sub[] = [
            'Penulisan Artikel Bahasa Indonesia',
            'Penulisan Artikel Bahasa Inggris',
            'Penulisan Profile Perusahaan Bahasa Indonesia',
            'Penulisan Profile Perusahaan Bahasa Inggris',
            'Penulisan Deskripsi Produk Bahasa Indonesia',
            'Penulisan Deskripsi Produk Bahasa Inggris',
            'Deskripsi Produk',
            'Penulisan lainnya',
        ];

        $sub[] = [
            'Desain Kalender',
            'Desain Grafis Bulanan',
            'Desain Logo',
            'Desain Kemasan',
            'Desain Pamflet & Brosur',
            'Desain Surat Kertas Bisnis',
            'Desain katalog Profil Perusahaan',
            'Desain Spanduk Online',
        ];

        $sub[] = [
            'SEO (Search Engine Optimization)',
            'Manajemen Tampilan Media Sosial',
            'Aktivitas Merk',
            'SEM (Google Ads, Facebook Ads, Instagram Ads)',
            'Bisnis dan Pemasaran Lainnya',
        ];

        $sub[] = [
          'Penerjemah Bahasa Inggris ke Bahasa Indonesia (Atau sebaliknya)',
          'Penerjemah Bahasa Mandarin ke Bahasa Indonesia (Atau sebaliknya)',
          'Penerjemah Bahasa Korea ke Bahasa Indonesia (Atau sebaliknya)',
          'Penerjemah Bahasa Jepang ke Bahasa Indonesia (Atau sebaliknya)',
        ];

        $sub[] =[
            'Aplikasi Android',
            'Aplikasi IOS'
        ];

        $sub[] = [
            'Fotografi Makanan & Minuman',
            'Fotografi Katalog',
            'Fotografi Produk',
            'Fotografi Mode Busana',
            'Edit Foto',
            'Pembuatan Video',
            'Pembuatan Video Animasi',
            'Pekerjaan Fotografi lainnya',
            'Pekerjaan Video lainnya',
        ];

        $sub[]=[
            'Input Data di Microsoft Excel',
            'Input Data di Website',
            'Entry Data Lainnya',
        ];
        for ($i = 0; $i < count($sub); $i++) {
            foreach ($sub[$i] as $subs) {
                \App\Model\SubKategori::create([
                    'kategori_id' => $i + 1,
                    'nama' => $subs
                ]);
            }
        }

    }
}
