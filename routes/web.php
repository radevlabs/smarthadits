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

Route::get('/', [
    'uses' => 'SmadhaditsController@index',
    'as' => 'home'
]);

Route::get('/stats', [
    'uses' => 'SmadhaditsController@stats',
    'as' => 'stats'
]);

Route::group(['prefix' => 'classification-based-on-narrator'], function () {
    Route::get('/', [
        'uses' => 'SmadhaditsController@classification',
        'as' => 'classification'
    ]);

    Route::post('/result', [
        'uses' => 'SmadhaditsController@classificationResult',
        'as' => 'classification.result'
    ]);
});

Route::group(['prefix' => 'hadith'], function () {
    Route::get('/', [
        'uses' => 'SmadhaditsController@priest',
        'as' => 'hadith.priest'
    ]);

    Route::get('/{priest}', [
        'uses' => 'SmadhaditsController@hadith',
        'as' => 'hadith.priest.list'
    ]);

    Route::get('/{priest}/{no}', [
        'uses' => 'SmadhaditsController@hadithDetail',
        'as' => 'hadith.detail'
    ]);
});

Route::get('hadith-retrieval', [
    'uses' => 'SmadhaditsController@retrieval',
    'as' => 'retrieval'
]);
