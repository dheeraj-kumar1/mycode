<?php

use Illuminate\Support\Facades\Route;
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
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('groups', 'App\Http\Controllers\GroupController');
    Route::get('whatsapp/single', 'App\Http\Controllers\WhatsappController@singleMessage')->name('whatsapp.single');
    Route::get('whatsapp/group', 'App\Http\Controllers\WhatsappController@groupMessage')->name('whatsapp.group');
    Route::post('whatsapp/send', 'App\Http\Controllers\WhatsappController@sendMessage')->name('whatsapp.send');
    Route::get('groups/status/{group}', 'App\Http\Controllers\GroupController@changestatus')->name('changestatus');
    Route::resource('client', 'App\Http\Controllers\ClientController');
    Route::resource('importcontact', 'App\Http\Controllers\FileUploadController');
    Route::post('importcontact/save', 'App\Http\Controllers\FileUploadController@contactSave')->name('importcontact.save');
    Route::put('edit/{id}', 'FileUploadController@update');
    Route::post('get_group_user_cnt', 'App\Http\Controllers\ClientController@GetClientCount')->name('GetClientCount');
});
