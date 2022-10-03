<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TestController;

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


$router->group(['prefix'=>'api'], function () use ($router) {
    $router->get('Posts','TestController@get_post_data');
    $router->get('Store','TestController@store_data');
});

$router->get('test_data','',[TestController::class,'get_post_data']);

// $router->get('profile', [
//     'as' => 'profile', 'uses' => 'TestController@get_post_data'
// ]);