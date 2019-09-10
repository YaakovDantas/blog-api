<?php

use Illuminate\Http\Request;

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

Route::post('/login', 'TokenController@gerarToken');
Route::post('/register', 'TokenController@register');

Route::middleware(['my_auth'])->group(function () {
    Route::resource('posts', 'PostController');
    Route::get('posts/{id}/comments', 'PostController@getPostsComments');

    Route::resource('comments', 'CommentController');

    Route::get('/users/{id}/posts', 'UserController@getUserPosts');
    Route::get('/users/{id}/comments', 'UserController@getUserComments');
   
});