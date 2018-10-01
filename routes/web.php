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
    return $router->app->version();
});

$router->group(['prefix' => 'api/v1', 'middleware' => 'auth'], function () use ($router) {

    $router->get('/users', 'UserController@index');
    $router->get('/user/{id}', 'UserController@show');
    $router->post('/user', 'UserController@store');
    $router->put('/user/{id}', 'UserController@update');
    $router->delete('/user/{id}', 'UserController@delete');

    $router->get('/recommendations', 'RecommendationController@index');
    $router->get('/recommendation/{id}', 'RecommendationController@show');
    $router->post('/recommendation', 'RecommendationController@store');
    $router->put('/recommendation/{id}', 'RecommendationController@update');
    $router->delete('/recommendation/{id}', 'RecommendationController@delete');

    $router->get('/recommendation_items/{id}', 'RecommendationItemController@show');
    $router->post('/recommendation_items', 'RecommendationItemController@store');
    $router->put('/recommendation_items/{id}', 'RecommendationItemController@update');
    $router->delete('/recommendation_items/{id}', 'RecommendationItemController@delete');

});