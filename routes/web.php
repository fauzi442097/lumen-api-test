<?php

/** @var \Laravel\Lumen\Routing\Router $router */


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
    return view('welcome');
    // return $router->app->version();
});

$router->group(['prefix' => '/api/v1'], function () use ($router) {

    $router->post('/login', 'HomeController@login');

    $router->group(['middleware' => 'jwt.verify'], function () use ($router) {
        $router->get('/checkLogin', 'HomeController@checkLogin');
        $router->post('/logout', 'HomeController@logout');
    });

    $router->get('/barang', 'BarangController@index');
    $router->get('/barang/{id}', 'BarangController@show');
    $router->post('/barang', 'BarangController@store');
    $router->delete('/barang/{id}', 'BarangController@delete');
    $router->put('/barang', 'BarangController@update');

    $router->get('/users', 'UserController@index');
    $router->get('/users/{key}', 'UserController@show');
    $router->post('/users', 'UserController@store');
    $router->delete('/users/{key}', 'UserController@delete');
    $router->put('/users', 'UserController@update');

    $router->post('/integrations/register', 'AuthController@register');
    $router->post('/integrations/login', 'AuthController@login');

    $router->get('/denoms/filter', 'AuthController@filterData');
});
