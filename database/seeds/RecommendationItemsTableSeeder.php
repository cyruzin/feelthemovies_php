<?php

use Illuminate\Database\Seeder;

class RecommendationItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\RecommendationItem::class, 100)->create()->each(function ($a) {
            $a->sources()->attach(App\Source::all()->random()->id);
        });
    }
}
