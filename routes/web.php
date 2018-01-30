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

Route::get('/forum', [
	'uses' 	=> 'ForumsController@index',
	'as' 	=> 'forum'
]);

// Social site authentication
Route::get('{provider}/auth', [
	'uses' => 'SocialController@authenticate',
	'as' => 'social.auth'
]);

Route::get('{provider}/redirect', [
	'uses' => 'SocialController@authenticate_callback',
	'as' => 'social.callback'
]);
// End social site authentication

Route::get('discussions/{slug}',[
	'uses' => 'DiscussionsController@show',
	'as' => 'discussion'
]);

Route::get('channel/{slug}',[
	'uses' => 'ForumsController@channel',
	'as' => 'channel'
]);

Route::group(['middleware' => 'auth'], function() {
	Route::resource('channels', 'ChannelsController');

	Route::get('discussions/create/new',[
		'uses' => 'DiscussionsController@create',
		'as' => 'discussions.create'
	]);

	Route::post('discussions/store',[
		'uses' => 'DiscussionsController@store',
		'as' => 'discussions.store'
	]);

	Route::post('discussion/reply/{id}',[
		'uses' => 'DiscussionsController@reply',
		'as' => 'discussion.reply'
	])->where('id', '[0-9]+');

	Route::get('reply/like/{id}', [
		'uses' => 'RepliesController@like',
		'as' => 'reply.like'	
	])->where('id', '[0-9]+');

	Route::get('reply/unlike/{id}', [
		'uses' => 'RepliesController@unlike',
		'as' => 'reply.unlike'
	])->where('id', '[0-9]+');

	Route::get('reply/delete/{id}', [
		'uses' => 'RepliesController@delete_reply',
		'as' => 'reply.delete'
	])->where('id', '[0-9]+');

	Route::get('reply/edit/{id}', [
		'uses' => 'RepliesController@edit',
		'as' => 'reply.edit'
	])->where('id', '[0-9]+');

	Route::post('reply/update/{id}', [
		'uses' => 'RepliesController@update',
		'as' => 'reply.update'
	])->where('id', '[0-9]+');

	Route::get('discussion/reply/mark/{id}', [
		'uses' => 'RepliesController@mark_best_answer',
		'as' => 'reply.mark'
	])->where('id', '[0-9]+');

	Route::get('discussion/reply/unmark/{id}', [
		'uses' => 'RepliesController@unmark_best_answer',
		'as' => 'reply.unmark'
	])->where('id', '[0-9]+');

	Route::get('discussion/unwatch/{id}', [
		'uses' => 'WatchersController@unwatch',
		'as' => 'watch.unwatch'
	])->where('id', '[0-9]+');

	Route::get('discussion/watch/{id}', [
		'uses' => 'WatchersController@watch',
		'as' => 'watch.watch'
	])->where('id', '[0-9]+');

	Route::get('discussion/edit/{slug}',[
		'uses' => 'DiscussionsController@edit',
		'as' => 'discussion.edit'
	]);

	Route::post('discussion/update/{id}',[
		'uses' => 'DiscussionsController@update',
		'as' => 'discussion.update'
	]);

});
