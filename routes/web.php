<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api', 'middleware' => ['cors']], function () use ($router) {
    $router->get('debug',       ['uses' => 'CompanyController@showAll']);
    $router->get('name/{name}', ['uses' => 'CompanyController@getByName']);
});
