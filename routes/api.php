<?php

use Illuminate\Http\Request;
use App\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/ 

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//dd(User::all());
$route = array(
   // 'user' => 'API\UserController'
    0 => array('name' => 'user', 'path' => 'API\UserController'),
    1 => array('name' => 'role', 'path' => 'API\RoleController'),
    2 => array('name' => 'page', 'path' => 'API\PageController'),
    3 => array('name' => 'userlog', 'path' => 'API\UserLogController'),
    4 => array('name' => 'userrole', 'path' => 'API\UserRoleController'),
);
//dd($route);
for($i = 0 ; $i < count($route) ; $i++){
    Route::apiResources([
       $route[$i]['name'] => $route[$i]['path']
    ]);
}

//Route::apiResources('{path}', 'HomeController@index')->where( 'path','([A-z\d-\/_.]+)?' );