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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'sistema', 'as' => 'sistema.'], function () {
    
    Route::group(['as' => 'referencia.', 'prefix' => 'referencia'], function () {
        
        Route::get('index', 'Sistema\ReferenciaController@index')->name('index');        
        Route::match(['get', 'post'], 'adicionar', 'Sistema\ReferenciaController@adicionar')->name('adicionar');        
        Route::match(['get', 'post'], 'alterar/{referencia}', 'Sistema\ReferenciaController@alterar')->name('alterar');        
        Route::post('excluir/{referencia}', 'Sistema\ReferenciaController@excluir')->name('excluir');        
        
    });
    
    Route::group(['as' => 'item_referencia.', 'prefix' => 'item_referencia'], function () {
        
        Route::get('index/{referencia}', 'Sistema\ItemReferenciaController@index')->name('index');        
        Route::match(['get', 'post'], 'adicionar/{referencia}', 'Sistema\ItemReferenciaController@adicionar')->name('adicionar');        
        Route::match(['get', 'post'], 'alterar/{referencia}/{item_referencia}', 'Sistema\ItemReferenciaController@alterar')->name('alterar');        
        Route::post('excluir/{referencia}/{item_referencia}', 'Sistema\ItemReferenciaController@excluir')->name('excluir');        
        
    });

    Route::group(['as' => 'evento.', 'prefix' => 'evento'], function () {
        
        Route::post('get_tipo', 'Sistema\EventoController@getTipo')->name('get_tipo');        
        
    });

});
