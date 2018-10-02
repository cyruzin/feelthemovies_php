<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('GenresTableSeeder');
        $this->call('KeywordsTableSeeder');
        $this->call('SourcesTableSeeder');
        $this->call('RecommendationsTableSeeder');
        $this->call('RecommendationItemsTableSeeder');
    }
}
