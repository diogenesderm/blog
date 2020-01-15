<?php

use Illuminate\Http\Request;
use App\Posts;

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

Route::get('posts', function () {
    return Posts::all();
});

Route::get('posts/{id}', function ($id) {
    return Posts::find($id);
});

Route::post('posts', function (Request $request) {
    return Posts::create($request->all());
});

Route::put('posts/{id}', function (Request $request, $id) {
    $post = Posts::findOfFail($id);
    $post->update($request->all());
});

Route::delete('posts/{id}', function ($id) {
    Posts::find($id)->delete();
    return 204;
});

Route::post('register', 'Auth\RegisterController@register');
