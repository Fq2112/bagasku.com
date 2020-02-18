<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        foreach (User::where('role', \App\Support\Role::OTHER)->get() as $user) {
            \App\Model\Product::create([
                'user_id' => $user->id,
                'subkategori_id' => rand(\App\Model\SubKategori::min('id'), \App\Model\SubKategori::max('id')),
                'judul' => Factory::create()->jobTitle,
                'deskripsi' => '<p>' . $faker->paragraph . '</p>',
                'harga' => $faker->numerify('########'),
                'tautan' => $faker->imageUrl(),
            ]);
        }
    }
}
