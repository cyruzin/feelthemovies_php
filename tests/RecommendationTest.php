<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class RecommendationTest extends TestCase
{
    use DatabaseTransactions;

    protected $baseUrl = 'http://feelthemovies.test/api/v1';
    protected $api_token = '9I0rwhz1ewHN7ULLF273KTp9nxaIOKxF';
    
    public function testGetAllRecommendations()
    {
        $this->json('GET', $this->baseUrl . '/recommendations?api_token=' . $this->api_token)
            ->seeStatusCode(200);
    }

    public function testGetOneRecommendation()
    {
        $this->json('GET', $this->baseUrl . '/recommendation/1?api_token=' . $this->api_token)
            ->seeStatusCode(200);
    }

    public function testCreateRecommendation()
    {
        $this->json('POST', $this->baseUrl . '/recommendation?api_token=' . $this->api_token, [
            "title" => "Filmes trash!",
            "body" => "Segue a lista!",
            "poster" => "ahKPqFjTkaçPlZ",
            "backdrop" => "ahKPqFjTkaçPlZ",
            "genres" => [1, 2, 5],
            "keywords" => [2, 8, 3],
            "user_id" => 7,
            "api_token" => $this->api_token
        ])
            ->seeStatusCode(201);
    }

    public function testUpdateRecomendation()
    {
        $this->json('PUT', $this->baseUrl . '/recommendation/1?api_token=' . $this->api_token, [
            "title" => "Filmes da segunda guerra!",
            "body" => "Segue a lista!",
            "poster" => "ahKPqFjTkaçPlZ",
            "backdrop" => "ahKPqFjTkaçPlZ",
            "genres" => [1, 7, 5],
            "keywords" => [4, 8, 3],
            "user_id" => 7,
            "status" => 1,
            "api_token" => $this->api_token
        ])
            ->seeStatusCode(200);
    }

    public function testDeleteRecommendation()
    {
        $this->json('DELETE', $this->baseUrl . '/recommendation/1?api_token=' . $this->api_token)
            ->seeStatusCode(200);
    }
}