<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/comments/{model}', 'CommentController@index');
Route::post('/comments/{model}', 'CommentController@store');
Route::get('/comments/{model}', 'CommentController@store');

Route::get('/posts', 'PostController@index')->name('posts.index');
Route::post('/posts', 'PostController@store')->name('posts.store')->middleware('auth');
Route::get('/posts/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::put('/posts/{post}', 'PostController@update')->name('posts.update')->middleware('auth');
Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit')->middleware('auth');
Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy')->middleware('auth');
Route::get('/posts/{post}/{slug}', 'PostController@show')->name('posts.show');

Route::get('/songs', 'SongController@index')->name('songs.index');
Route::post('/songs', 'SongController@store')->name('songs.store')->middleware('auth');
Route::post('/songs/store', 'SongController@storeUpload')->name('songs.store_upload')->middleware('auth');
Route::get('/songs/create', 'SongController@create')->name('songs.create')->middleware('auth');
Route::put('/songs/{song}', 'SongController@update')->name('songs.update')->middleware('auth');
Route::get('/songs/{song}/edit', 'SongController@edit')->name('songs.edit')->middleware('auth');
Route::delete('/songs/{song}', 'SongController@destroy')->name('songs.destroy')->middleware('auth');
Route::get('/songs/download/{song}', 'SongController@download')->name('songs.download');
Route::get('/songs/{song}/{slug}', 'SongController@show')->name('songs.show');

Route::get('/albums', 'AlbumController@index')->name('albums.index');
Route::post('/albums', 'AlbumController@store')->name('albums.store')->middleware('auth');
Route::get('/albums/create', 'AlbumController@create')->name('albums.create')->middleware('auth');
Route::put('/albums/{album}', 'AlbumController@update')->name('albums.update')->middleware('auth');
Route::get('/albums/{album}/edit', 'AlbumController@edit')->name('albums.edit')->middleware('auth');
Route::delete('/albums/{album}', 'AlbumController@destroy')->name('albums.destroy')->middleware('auth');
Route::get('/albums/{album}/{slug}', 'AlbumController@show')->name('albums.show');

Route::get('/videos', 'VideoController@index')->name('videos.index');
Route::post('/videos', 'VideoController@store')->name('videos.store')->middleware('auth');
Route::get('/videos/create', 'VideoController@create')->name('videos.create')->middleware('auth');
Route::put('/videos/{video}', 'VideoController@update')->name('videos.update')->middleware('auth');
Route::get('/videos/{video}/edit', 'VideoController@edit')->name('videos.edit')->middleware('auth');
Route::delete('/videos/{video}', 'VideoController@destroy')->name('videos.destroy')->middleware('auth');
Route::get('/videos/download/{video}', 'VideoController@download')->name('videos.download');
Route::get('/videos/{video}/{slug}', 'VideoController@show')->name('videos.show');

Route::middleware('auth')->group(function () {
    Route::resource('/tags', 'TagController');
    Route::resource('/comments', 'CommentController');

    Route::resource('/post_categories', 'PostCategoryController');
    Route::resource('/song_categories', 'SongCategoryController');
    Route::resource('/video_categories', 'VideoCategoryController');
	
	Route::get('/profile/{id}/edit', 'UsersController@editProfile')->name('user.profile.edit');
	Route::put('/profile/{id}/update', 'UsersController@updateProfile')->name('user.profile.update');
});


Route::namespace('User')
		->prefix('user')
		->middleware('auth')
		->name('user.')
		->group(function () {
		    Route::get('/', 'DashboardController@index')->name('dashboard');
		    Route::view('/settings', 'user.settings', ['name' => 'settings']);
		    Route::resource('/songs', 'SongsController');
		});

Route::namespace('Admin')
		->prefix('admin')
		->middleware('auth')
		->name('admin.')
		->group(function () {
		    Route::get('/', 'DashboardController@index')->name('index');

		    Route::resource('/users', 'UsersController');
		    Route::resource('/songs', 'SongsController');
		});
