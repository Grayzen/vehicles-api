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


$router->group(['prefix' => 'api'], function () use ($router){
    $router->group(['middleware' => 'auth'], function () use ($router){
        $methodRoute = ['index' => 'get', 'store' => 'post', 'show' => 'get', 'update' => 'put', 'destroy' => 'delete'];
        $urlController = ['companies' => 'CompanyController', 'employees' => 'EmployeeController', 'vehicles' => 'VehicleController'];

        foreach ($urlController as $url => $controller) {
            foreach ($methodRoute as $method => $route) {
                if($method != 'index' && $method != 'store')
                    $router->$route($url.'/{id}', $controller.'@'.$method);
                else
                    $router->$route($url, $controller.'@'.$method);
            }
        }

        $router->post('me', 'AuthController@me');
        $router->post('logout', 'AuthController@logout');

    });

    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');
});
