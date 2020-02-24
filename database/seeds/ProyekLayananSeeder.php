<?php

use Illuminate\Database\Seeder;

class ProyekLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $i = 0;
        $klien_ids = [];
        $client = \App\User::where('role', \App\Support\Role::OTHER)->take(10)->get();
        foreach ($client as $klien) {
            \App\Model\Project::create([
                'user_id' => $klien->id,
                'judul' => \Faker\Factory::create()->jobTitle,
                'deskripsi' => '<p>' . $faker->paragraph . '</p>',
                'waktu_pengerjaan' => rand(1, 10),
                'harga' => $faker->numerify('########'),
                'pribadi' => false,
                'subkategori_id' => rand(\App\Model\SubKategori::min('id'), \App\Model\SubKategori::max('id'))
            ]);

            \App\Model\Project::create([
                'user_id' => $klien->id,
                'judul' => \Faker\Factory::create()->jobTitle,
                'deskripsi' => '<p>' . $faker->paragraph . '</p>',
                'waktu_pengerjaan' => rand(1, 10),
                'harga' => $faker->numerify('########'),
                'pribadi' => false,
                'subkategori_id' => rand(\App\Model\SubKategori::min('id'), \App\Model\SubKategori::max('id'))
            ]);

            $klien_ids[$i] = $klien->id;
            $i = $i + 1;
        }

        $pekerja = \App\User::where('role', \App\Support\Role::OTHER)
            ->whereNotIn('id', $klien_ids)->get();

        $arr_pekerja = $pekerja->pluck('id')->toArray();
        $arr_rate = ["3.5", "4", "4.5", "5"];
        foreach (\App\Model\Project::all() as $proyek) {
            $pengerjaan = \App\Model\Pengerjaan::create([
                'user_id' => $arr_pekerja[array_rand($arr_pekerja)],
                'proyek_id' => $proyek->id,
                'selesai' => true,
                'tautan' => $faker->imageUrl(),
            ]);

            \App\Model\Pembayaran::create([
                'proyek_id' => $proyek->id,
            ]);

            $review_klien = \App\Model\Review::create([
                'user_id' => $pengerjaan->user_id,
                'proyek_id' => $proyek->id,
                'deskripsi' => $faker->paragraph,
                'bintang' => $arr_rate[array_rand($arr_rate)]
            ]);
            $proyek->get_user->get_bio->update([
                'total_bintang_klien' => $proyek->get_user->get_bio->total_bintang_klien + $review_klien->bintang
            ]);

            $review_pekerja = \App\Model\ReviewWorker::create([
                'user_id' => $proyek->user_id,
                'proyek_id' => $proyek->id,
                'deskripsi' => $faker->paragraph,
                'bintang' => $arr_rate[array_rand($arr_rate)]
            ]);
            $pengerjaan->get_user->get_bio->update([
                'total_bintang_pekerja' => $pengerjaan->get_user->get_bio->total_bintang_pekerja + $review_pekerja->bintang
            ]);
        }

        foreach ($pekerja as $row) {
            $service = \App\Model\Services::create([
                'user_id' => $row->id,
                'subkategori_id' => rand(\App\Model\SubKategori::min('id'), \App\Model\SubKategori::max('id')),
                'harga' => $faker->numerify('########'),
                'deskripsi' => '<p>' . $faker->paragraph . '</p>',
                'hari_pengerjaan' => rand(1, 30),
                'judul' => \Faker\Factory::create()->jobTitle,
            ]);

            $pengeraanLayanan = \App\Model\PengerjaanLayanan::create([
                'service_id' => $service->id,
                'user_id' => rand(1, 10),
                'selesai' => true,
                'tautan' => $faker->imageUrl()
            ]);

            \App\Model\PembayaranLayanan::create([
                'service_id' => $service->id,
                'jumlah_pembayaran' => $service->harga
            ]);

            \App\Model\UlasanService::create([
                'user_id' => $pengeraanLayanan->user_id,
                'pengerjaan_layanan_id' => $pengeraanLayanan->id,
                'deskripsi' => '<p>' . $faker->paragraph . '</p>',
                'bintang' => $arr_rate[array_rand($arr_rate)]
            ]);
        }
    }
}
