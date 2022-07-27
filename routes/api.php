<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenralController;
use App\Http\Controllers\GenralMainController;

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

	
	/*Route::get("language-list", [App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, "getLanguages"]);
    Route::get("state-list", [App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, "getStates"]);
    Route::get("district-list/{stateCode?}", [App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, "getDistricts"]);
    Route::post('fresh-empanelment-update',[App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, 'freshEmpanelmentUpdate'])->name('fresh-empanelment-update');
    Route::post('fresh-empanelment-save',[App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, 'freshEmpanelmentSave'])->name('fresh-empanelment-save');
     Route::post('rateSettlement-private-media-save',[App\Http\Controllers\Api\RateSettlementPrivateMediaController::class, 'privateMediaSave'])->name('privateMediaSave');

/*Route::middleware('auth:api')->group(function () {
    
});*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('get-banner/{location?}',[App\Http\Controllers\auth\BocUserController::class, 'getROBbanner'])->name('get-banner');
    
	Route::match(['get','post'],'get-system-ip', [App\http\controllers\Api\GenralController::class,'get_system_api'])->name('get-system-ip');

	Route::get("language-list", [App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, "getLanguages"]);
    Route::get("state-list", [App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, "getStates"]);
    Route::get("district-list/{stateCode?}", [App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, "getDistricts"]);
    Route::post('fresh-empanelment-update',[App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, 'freshEmpanelmentUpdate'])->name('fresh-empanelment-update');
    Route::post('fresh-empanelment-save',[App\Http\Controllers\Api\ApiFreshEmpanelmentController::class, 'freshEmpanelmentSave'])->name('fresh-empanelment-save');

    Route::post('sole-rightmedia-save',[App\Http\Controllers\Api\SoleRightMediaController::class, 'soleRightMediaSave'])->name('soleRightMediaSave');
    Route::post('rateSettlement-private-media-save',[App\Http\Controllers\Api\RateSettlementPrivateMediaController::class, 'privateMediaSave'])->name('privateMediaSave');
    Route::get("show-details/{od_media_id}", [App\Http\Controllers\Api\RateSettlementPrivateMediaController::class, "showDetails"]);
    Route::post("sole-right-update/{od_media_id}", [App\Http\Controllers\Api\RateSettlementPrivateMediaController::class, "privateMediaUpdate"]);
	
	Route::post('ratesettlement-personalmedia-save',[App\Http\Controllers\Api\RateSettlementPersonalMediaController::class, 'RateSettlementPersonalMediaSave'])->name('RateSettlementPersonalMediaSave');
// logs route 
    Route::get("get_activity_details",[App\Http\Controllers\Api\ApiLogsController::class, "get_activity_details"]); 
    Route::post("save_activity_logs",[App\Http\Controllers\Api\ApiLogsController::class, "save_activity_logs"]); 
    Route::post("save_logs",[App\Http\Controllers\Api\ApiLogsController::class, "save_logs"]);

Route::get("get_login_details/{email}", [App\Http\Controllers\Api\GenralController::class, "get_login_details"]);
Route::get("advisiory", [App\Http\Controllers\Api\AdvisioryController::class, "advisiory"]);


 //Client Module
     Route::post('client-submission-save',[App\Http\Controllers\Api\ClientController::class, 'saveClient'])->name('client-submission-save');
     //Activity Log
     Route::get("get_activity_details",[App\Http\Controllers\Api\ApiLogsController::class, "get_activity_details"]); 

     






