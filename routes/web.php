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
// codetatoo.com, geeksmakecode.com, geekmakescode.com(1), smellslikegeek,
// codedripper.com, codingbuilder.com, drawingthecode.com(1), hipthecode.com
// justdocoding


Route::get('/', function () {
    return view('welcome');
});

// /user-name/


Route::get('/chat', function () {
    return view('chat');
});

Route::group(['prefix' => 'profile'], function() {
  Route::get('/', 'ProfileController@index')->name('profile.index');
  Route::get('edit', 'ProfileController@edit')->name('profile.edit');
  Route::post('update', 'ProfileController@update')->name('profile.update');
  Route::post('avatarUpload', 'ProfileController@avatarUpload');
  Route::post('basicUpdate', 'ProfileController@basicUpdate');
  Route::post('passwordUpdate', 'ProfileController@passwordUpdate');
  Route::post('settingsUpdate', 'ProfileController@settingsUpdate');
  Route::post('snsUpdate', 'ProfileController@snsUpdate');
  Route::get('{user}', 'ProfileController@show')->name('profile.show');
});

// backstage, backyard, underground, background, admin,
// shield, ground, 서비스 + in
Route::resource('tutorial', 'TutorialController');
Route::resource('tlist', 'TlistController');
Route::post('tag/findGet/{query?}', 'TagController@findGet');
Route::resource('tag', 'TagController');


/*Route::group(['prefix'=> 'user'], function() {
  Route::get('profile', 'ProfileController@index');
});*/

/*Route::get('/', function (){
  return view('admin.home.index');
});*/

Auth::routes();

//Route::get('/home', 'HomeController@index');
