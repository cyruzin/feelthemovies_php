<?php

class RecommendationsTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Recommendation::class, 50)->create()->each(function ($a) {
            $a->genres()->attach(App\Genre::all()->random()->id);
            $a->keywords()->attach(App\Keyword::all()->random()->id);
        });
    }

}
