<?php

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

$app->get('/', function () use ($app) {
    return 'API Mandacaru Hackerspace';
});

$app->get ('/status', 'StatusController@index');
$app->post('/status', 'StatusController@store');

$app->group(['middleware' => 'jwt.auth'], function ($app) {

});

/*
$app->get('token', function() {
	$exp = strtotime('+10 years');
	$customClaims = [ 'exp' => $exp ];

	$usuario = \App\Usuario::find(1);
	$token = \JWTAuth::fromUser($usuario, $customClaims);

	var_dump(compact('token'));

});
*/
