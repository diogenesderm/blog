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
    return view('welcome');
});


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', 'PostsController')->middleware('verificaSeExisteCategoria');

    Route::resource('categories', 'CategoriesController');

    Route::resource('tags', 'TagsController');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/basic_laratable', 'PostsController@datatables')->name('basic_laratable');

Route::get('/posts_table', 'PostsController@postsTable')->name('posts_table');

Route::get('/glide/uploads/{path}', 'ImageController@show')->where('path', '.+')->name('glide');

Route::get('/arquivos', 'FilesController@index')->name('arquivos');
