<?php

//Registre Dingo PI Router
$api = app('Dingo\Api\Routing\Router');

//Endpoints
$api->version('v1',['middleware' => ['cors','locale'],'namespace' => 'App\Http\Controllers'], function ($api) {

    //Publicly available methods
    $api->get('/locale/{lang}','LocaleController@index');
    $api->post('/auth','UserController@authenticate');
    $api->post('/register','UserController@register');

    $api->get('/bx_users','BX_UsersController@index');
    $api->get('/bx_users/{user_id}','BX_UsersController@show');
    $api->get('/bx_books','BX_BooksController@index');
    $api->get('/bx_books/{isbn}','BX_BooksController@show');




    //Authenticated endpoints
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->get('/token','UserController@token');

        $api->post('/bx_books/store','BX_BooksController@store');
        $api->put('/bx_books/update/{isbn}','BX_BooksController@update');

        //Admin User Endpoints
        $api->group(['middleware' => 'role:admin'], function ($api) {


            $api->delete('/bx_books/delete/{isbn}','BX_BooksController@destroy');

            $api->get('/users','UserController@all');
            $api->get('/task','TaskController@index');
            $api->get('/task/{id}','TaskController@show');
            $api->post('/task/store','TaskController@store');
            $api->put('/task/update/{id}','TaskController@update');
            $api->delete('/task/delete/{id}','TaskController@destroy');
        });
    });

});
