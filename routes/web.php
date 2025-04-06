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
$router->put('/products/update/{id}', 'ProductsController@update');
$router->delete('/products/delete/{id}', 'ProductsController@destroy');

$router->get('/manufacturers', 'ManufacturerController@index');
$router->get('/manufacturers/{id}', 'ManufacturerController@show');
$router->post('/manufacturers/create', 'ManufacturerController@store');
$router->put('/manufacturers/update/{id}', 'ManufacturerController@update');
$router->delete('/manufacturers/delete/{id}', 'ManufacturerController@destroy');

$router->get('/sales', 'salesController@index');
$router->get('/sales/{id}', 'salesController@show');
$router->post('/sales/create', 'salesController@store');
$router->put('/sales/update/{id}', 'salesController@update');
$router->delete('/sales/delete/{id}', 'salesController@destroy');

$router->get('/sales_item', 'salesItemController@index');
$router->get('/sales_item/{id}', 'salesItemController@show');
$router->post('/sales_item/create', 'salesItemController@store');
$router->put('/sales_item/update/{id}', 'salesItemController@update');
$router->delete('/sales_item/delete/{id}', 'salesItemController@destroy');



$router->get('/', function () use ($router) {
    return $router->app->version();
});
