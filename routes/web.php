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
$router->get('/products', 'ProductsController@index');
$router->get('/products/{id}', 'ProductsController@show');
$router->post('/products/create', 'ProductsController@store');
$router->post('/products/update/{id}', 'ProductsController@update');
$router->delete('/products/delete/{id}', 'ProductsController@destroy');

$router->get('/manufacturers', 'ManufacturesController@index');
$router->get('/manufacturers/{id}', 'ManufacturesController@show');
$router->post('/manufacturers/create', 'ManufacturesController@store');
$router->post('/manufacturers/update/{id}', 'ManufacturesController@update');
$router->delete('/manufacturers/delete/{id}', 'ManufacturesController@destroy');

$router->get('/sales', 'salesController@index');
$router->get('/sales/{id}', 'salesController@show');
$router->post('/sales/create', 'salesController@store');
$router->post('/sales/update/{id}', 'salesController@update');
$router->delete('/sales/delete/{id}', 'salesController@destroy');

$router->get('/sales_items', 'salesItemController@index');
$router->get('/sales_items/{id}', 'salesItemController@show');
$router->post('/sales_items/create', 'salesItemController@store');
$router->post('/sales_items/update/{id}', 'salesItemController@update');
$router->delete('/sales_items/delete/{id}', 'salesItemController@destroy');



$router->get('/', function () use ($router) {
    return $router->app->version();
});
