<?php
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\Auth\SuperAdmin\PrintVendorUserController as PrintVendor;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
// Admin Routes
Route::prefix("admin")->group(function(){
    Route::get('reset-password', [PrintVendor::class, 'ResetPasswordForm'])->name('reset-password');
    Route::post('reset-password', [PrintVendor::class, 'ResetPassword'])->name('reset-password');
    Route::get('login',[PrintVendor::class,'LoginScreen']);
    Route::post('login',[PrintVendor::class,'signIn']);
    Route::get('dashboard',[PrintVendor::class,'dashboard']);
    // Route::get('logout', [PrintVendor::class, 'logOut'])->name('logout');

    // Route::get('datainsert', [PrintVendor::class,'datainsert']);

});
