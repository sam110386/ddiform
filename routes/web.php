<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
use Illuminate\Routing\Router;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/form/{key}','FormResponsesController@render')->name('render-form');
Route::post('/email/collection/{key}','FormResponsesController@saveEmail')->name('save-email-collection');
Route::post('/data/save/{key}','FormResponsesController@saveForm')->name('save-form-data');
Route::get('/response/chart/{key}','FormResponsesController@getResponseChartData')->name('form-response-chart');
// Route::get('/account', 'AccountController@index')->name('account');
Route::group([
    'prefix'        => 'account',
    'middleware'    => 'auth',
], function (Router $router) {
    $router->get('/', 'AccountController@index')->name('account');
    $router->get('/dashboard', 'AccountController@index')->name('dashboard');
    $router->get('/profile', 'AccountController@view')->name('profile');
    $router->post('/profile', 'AccountController@updateProfile')->name('profile-info-save');
    $router->post('/password', 'AccountController@updatePassword')->name('profile-password-save');
	$router->get('/forms', 'FormsController@index')->name('all-forms');
    $router->get('/forms/new', 'FormsController@new')->name('new-form');
    $router->get('/form/{key?}', 'FormsController@edit')->name('single-form');
    $router->post('/form/{key?}', 'FormsController@save')->name('save-form');
    $router->post('/form/{key}/{status}', 'FormsController@updateStatus')->name('update-form-status');
    $router->delete('/form/{key}', 'FormsController@destroy')->name('remove-form');


    $router->get('/quick/form/{key}', 'FormsController@quickForm')->name('quick-form');
    $router->get('/templates', 'FormsController@listTemplates')->name('all-form-templates');
    $router->post('/templates/{key}/{status}', 'FormsController@updateTemplateStatus')->name('update-template-status');


    $router->get('/response/form/', 'FormResponsesController@index')->name('response-list');
    $router->get('/response/form/{key}', 'FormResponsesController@responseList')->name('response-data-list');
    $router->get('/response/email/collection/{key}', 'FormResponsesController@responseEmailCollectionList')->name('response-email-list');
    
});
