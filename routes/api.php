<?php

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
Route::get('/', function () {
	return 'This is test api';
});

Route::get('/reset-main-db', 'Api\DatabaseController@mainDbReset');

Route::post('/cp-load-main-bar', 'Api\OverlaysController@setLoadMainBar')->name('conversion.set-load-main-bar');

Route::get('/cp-embed-script/{id}', 'Api\OverlaysController@getCBScriptCode')->name('conversion.get-scripts-code-for-embed');
Route::get('/cp-embed-split-script/{id}/{bar_id}', 'Api\OverlaysController@getSplitScriptCode')->name('conversion.get-split-scripts-code-for-embed');
Route::get('/cp-embed-multi-bar-script/{id}', 'Api\OverlaysController@getMultiBarScriptCode')->name('conversion.get-multi-scripts-code-for-embed');

Route::post('/cp-action-button-click/{id}', 'Api\OverlaysController@setActionButtonClick')->name('conversion.set-action-button-click');
Route::post('/cp-cta-set-subscribers/{bar_id}', 'Api\BarOptionsApiController@setSubscribersOfLists')->name('conversion.set-lead-capture-subscribers');

Route::group(['prefix' => 'autoresponders'], function () {
	Route::post('/refreshlists', 'Api\IntegrationsApiController@refreshList');
	Route::post('/addrecipient', 'Api\IntegrationsApiController@addRecipient');
});

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
