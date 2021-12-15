<?php

use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Dashboard\AdminDashboardController;
use App\Http\Controllers\Backend\RolePermission\RolesController;
use App\Http\Controllers\Backend\User\UsersController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix'=>'admin'], function(){
     Route::get('/dashboard',[AdminDashboardController::class,'index'])->name('admin.dashboard');

     //ROlE
     Route::resource('roles', RolesController::class);

     //USER
     Route::resource('users', UsersController::class);
     //USER UPDATE
     Route::get('/user/update/{id}',[UsersController::class,'updateSingleUser'])->name('update.user.get');
     Route::post('/user/update/{id}',[UsersController::class,'updateUserPost'])->name('update.user.post');

     //ADMIN
     Route::resource('admins', AdminController::class);
 });



require __DIR__.'/auth.php';
