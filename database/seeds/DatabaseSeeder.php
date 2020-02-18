<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             KategoriTableSeeder::class,
             SubKategoriTableSeeder::class,
             PovinsiTableSeeder::class,
             KotaTableSeeder::class,
             UserTableSeeder::class,
             ProductTableSeeder::class,
             ServiceTableSeeder::class,
             UlasanPekerjaTableSeeder::class,
             UlasanTableSeeder::class
         ]);
    }
}
