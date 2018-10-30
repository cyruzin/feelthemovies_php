<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    echo 'Feel the Movies API v1.0';
});

$router->post('/auth', 'AuthController@index');

$router->group(['prefix' => '/v1', 'middleware' => 'auth'], function () use ($router) {

    // Users Routes
    $router->get('/users', 'UserController@index');
    $router->get('/user/{id}', 'UserController@show');
    $router->post('/user', 'UserController@store');
    $router->put('/user/{id}', 'UserController@update');
    $router->delete('/user/{id}', 'UserController@delete');

    // Recommendations Routes
    $router->get('/recommendations', 'RecommendationController@index');
    $router->get('/recommendation/{id}', 'RecommendationController@show');
    $router->post('/recommendation', 'RecommendationController@store');
    $router->put('/recommendation/{id}', 'RecommendationController@update');
    $router->delete('/recommendation/{id}', 'RecommendationController@delete');

    // Recommendation Items Routes
    $router->get('/recommendation_items/{id}', 'RecommendationItemController@index');
    $router->get('/recommendation_item/{id}', 'RecommendationItemController@show');
    $router->post('/recommendation_item', 'RecommendationItemController@store');
    $router->put('/recommendation_item/{id}', 'RecommendationItemController@update');
    $router->delete('/recommendation_item/{id}', 'RecommendationItemController@delete');

    // Genres Routes
    $router->get('/genres', 'GenreController@index');
    $router->get('/genre/{id}', 'GenreController@show');
    $router->post('/genre', 'GenreController@store');
    $router->put('/genre/{id}', 'GenreController@update');
    $router->delete('/genre/{id}', 'GenreController@delete');

    // Keywords Routes
    $router->get('/keywords', 'KeywordController@index');
    $router->get('/keyword/{id}', 'KeywordController@show');
    $router->post('/keyword', 'KeywordController@store');
    $router->put('/keyword/{id}', 'KeywordController@update');
    $router->delete('/keyword/{id}', 'KeywordController@delete');

    // Sources Routes
    $router->get('/sources', 'SourceController@index');
    $router->get('/source/{id}', 'SourceController@show');
    $router->post('/source', 'SourceController@store');
    $router->put('/source/{id}', 'SourceController@update');
    $router->delete('/source/{id}', 'SourceController@delete');

    // Search Routes
    $router->get('/search_recommendation', 'SearchController@recommendation');
    $router->get('/search_user', 'SearchController@user');
    $router->get('/search_genre', 'SearchController@genre');
    $router->get('/search_keyword', 'SearchController@keyword');
    $router->get('/search_source', 'SearchController@source');

});