<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory;
use App\Model\Review;
class UlasanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');
        $arr = array("3.5", "4", "4.5", "5");
        foreach (User::all() as $item) {
            $user = User::whereNotIn('id', [$item->id])->get()->pluck('id');
            Review::create([
                'user_id' => rand($user->min(), $user->max()),
                'proyek_id' => rand(\App\Model\Project::min('id'), \App\Model\Project::max('id')),
                'deskripsi' => $faker->paragraph,
                'bintang' => $arr[array_rand($arr)]
            ]);
        }
    }
}
