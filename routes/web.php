<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
$router->get('TestUser', ['middleware' => 'auth', function (Request $request) {
    //$user = Auth::user();

    return $request->user();

    //
}]);

$router->post('api/DirectLogin','AuthController@direct_login');
$router->post('api/ClientLogin','AuthController@client_login');

$router->post('UserInfo','AuthController@user_info_token');

$router->group(['prefix'=>'api','middleware'=>'auth'], function () use ($router) {
    $router->get('Posts','TestController@get_post_data');
    $router->post('Store','TestController@store_data');
    $router->get('UserInfo','TestController@user_info');
    $router->post('api/Logout','AuthController@logout');
});

$router->get('test_data','',[TestController::class,'get_post_data']);

// $router->get('profile', [
//     'as' => 'profile', 'uses' => 'TestController@get_post_data'
// ]);