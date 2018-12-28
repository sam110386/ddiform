<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->get('/users', 'AdminUsersController@userList')->name('user-list');
    $router->get('/forms', 'AdminFormsController@formList')->name('form-list');
    $router->get('/form/response/{key}', 'AdminFormsController@responseList')->name('admin-response-data-list');
    $router->get('/form/email/collection/{key}', 'AdminFormsController@emailCollectionList')->name('admin-response-email-list');
    
    
    $router->post('/form/{key}/{status}', 'AdminFormsController@updateFormStatus')->name('admin-update-form-status');
    $router->delete('/form/{key}', 'AdminFormsController@destroyForm')->name('admin-remove-form');    

});
