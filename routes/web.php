<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('/', 'MailsController@form')->name('mails.main');
Route::get('/mails', 'MailsController@list')->name('mails.list');
Route::get('/mail/{id}', 'MailsController@detail')->name('mails.detail');
Route::post('/send', 'MailsController@send');
Route::get('/export', 'MailsController@excelExport')->name('mails.export');
