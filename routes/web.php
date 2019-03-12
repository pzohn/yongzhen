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

Route::get('/', function () {
    return "welcome to yongzhen";
});


Route::post('/onGetUser', 'UserController@getUser');

Route::post('/getGood', 'GoodController@getGood');

Route::post('/getGoodsByType', 'GoodController@getGoodsByType');

Route::post('/getLeasings', 'GoodController@getLeasings');

Route::post('/getLeasing', 'GoodController@getLeasing');

Route::post('/onPay', 'PayController@onPay');

Route::post('/onPayBack', 'PayController@onPayBack');

Route::get('/getShows', 'GoodController@getShows');

Route::post('/getGoodsByName', 'GoodController@getGoodsByName');

Route::post('/login', 'UserController@login');

Route::post('/registor', 'UserController@registor');

Route::post('/collect', 'UserController@collect');

Route::post('/iscollect', 'UserController@iscollect');

Route::post('/getCollect', 'UserController@getCollect');

Route::post('/getTrades', 'PayController@getTrades');

Route::post('/getTrade', 'PayController@getTrade');

Route::post('/getAddresses', 'UserController@getAddresses');

Route::post('/getAddress', 'UserController@getAddress');

Route::post('/updateAddress', 'UserController@updateAddress');

Route::post('/insertAddress', 'UserController@insertAddress');

Route::post('/delAddress', 'UserController@delAddress');

Route::post('/updateDefaultAddress', 'UserController@updateDefaultAddress');

Route::post('/userSave', 'UserController@userSave');

Route::post('/getTopicsByTab', 'TopicController@getTopicsByTab');

Route::post('/getTopicById', 'TopicController@getTopicById');

Route::post('/upload', 'FileController@upload');

Route::post('/insertTopic', 'TopicController@insertTopic');

Route::post('/phoneVerify', 'UserController@phoneVerify');

Route::post('/getHosptialTypes', 'HospitalController@getTypes');

Route::post('/getHosptialCities', 'HospitalController@getCities');

Route::post('/getHospitalsByCity', 'HospitalController@getHospitalsByCity');

Route::post('/getHospitalservicesByType', 'HospitalController@getHospitalservicesByType');


