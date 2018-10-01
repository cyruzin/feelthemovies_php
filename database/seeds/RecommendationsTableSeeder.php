<?php

use Illuminate\Database\Seeder;

class RecommendationsTableSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Recommendation::class, 50)->create();
    }

}