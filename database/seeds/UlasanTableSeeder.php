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
        foreach (User::all() as $item) {
            $user = User::whereNotIn('id', [$item->id])->get()->pluck('id');
            $review = Review::create([
                'user_id' => rand($user->min(), $user->max()),
                'proyek_id' => rand(\App\Model\Project::min('id'), \App\Model\Project::max('id')),
                'deskripsi' => $faker->paragraph,
                'bintang' => rand(1, 10)
            ]);


            $find_user = \App\Model\Bio::where('user_id', $review->user_id)->first();
            if ($find_user != null) {
                $find_user->update([
                    'total_bintang_klien' => $find_user->total_bintang_klien + $review->bintang
                ]);
            }
        }
    }
}
