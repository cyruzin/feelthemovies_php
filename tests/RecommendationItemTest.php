<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class RecommendationItemTest extends TestCase
{
    use DatabaseTransactions;

    protected $baseUrl = 'http://feelthemovies.test/api/v1';
    protected $api_token = 'UJUBBvsIhGHyHS3w1kvYcP1jTu4POVhV';

    public function testGetRecommendationItemBadRequest()
    {
        $this->json('GET', $this->baseUrl . '/recommendation_item/1777?api_token=' . $this->api_token)
            ->seeJson(['message' => 'An error occurred!'])
            ->seeStatusCode(500);
    }

    public function testUpdateRecommendationItemBadRequest()
    {
        $this->json('PUT', $this->baseUrl . '/recommendation_item/1777?api_token=' . $this->api_token, [
            'recommendation_id' => 17,
            'name' => 'Pedator',
            'year' => '2018-09-20',
            'overview' => 'He is back to hunt again!',
            'poster' => 'JqOivBMcxsQwE',
            'backdrop' => 'JqOivBMplKuItrEWQs',
            'trailer' => 'JqOivBMcmnbCXzasWEr',
            'commentary' => 'This is a great movie!',
            'sources' => [5, 1, 3]
        ])
            ->seeJson(['message' => 'An error occurred!'])
            ->seeStatusCode(500);
    }

    public function testDeleteRecommendationItemBadRequest()
    {
        $this->json('DELETE', $this->baseUrl . '/recommendation_item/1777?api_token=' . $this->api_token)
            ->seeJson(['message' => 'An error occurred!'])
            ->seeStatusCode(500);
    }

}