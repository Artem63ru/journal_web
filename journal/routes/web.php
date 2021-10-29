<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

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


Route::group(['middleware' => ['auth']], function() {
    Route::get('/', [Controllers\MenuController::class, 'index'])->name('gazprom');   //Главная

    //Смена пароля
//    Route::get('/change-password', 'ChangePasswordController@index')->name('changepwd');
//    Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

    //Получить дерево
    Route::get('/getsidetree', [Controllers\SidetreeController::class, 'getSideTree']);
    //Получить данные одного элемента дерева
    Route::get('/gettabledata', [Controllers\SidetreeController::class, 'getTableItemData']);
    Route::get('/test/{id}', [Controllers\SidetreeController::class, 'test']);
    Route::get('/get_mins_params', [Controllers\SidetreeController::class, 'getMinsParams']);
    Route::get('/maintable', [Controllers\MainTableController::class, 'index']);
    Route::get('/getmaintable', [Controllers\MainTableController::class, 'getMainTableInfo']);

});
//*******************************************
Auth::routes();
Route::get('/logout', function () {    Auth::logout();    return Redirect::to('login');});

//Главная таблица


