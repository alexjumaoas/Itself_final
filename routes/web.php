<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RequesterController;
use App\Http\Controllers\TechnicianController;
use App\Http\Middleware\RequesterMiddleware;
use App\Http\Middleware\TechnicianMiddleware;

Route::get('/', function () {
    return redirect()->route('landing'); 
});

//*************************Admin page*****************************//

Route::get('admin', [AdminController::class, 'index'])->middleware(['auth:custom_users', 'admin'])->name('dashboard');
Route::get('admin/tech', [AdminController::class, 'techlist'])->middleware(['auth:custom_users', 'admin'])->name('admin.dashboard');
Route::get('admin/viewtech',  [AdminController::class, 'viewTechnicians'])->middleware(['auth:custom_users', 'admin'])->name('viewtech');
Route::get('admin/employees/search', [AdminController::class, 'searchEmp'])->middleware(['auth:custom_users', 'admin'])->name('employees.search');
Route::post('admin/technicians/add', [AdminController::class, 'addTechnician'])->middleware(['auth:custom_users', 'admin'])->name('technicians.add');
Route::post('admin/technicians/remove', [AdminController::class, 'removetech'])->middleware(['auth:custom_users', 'admin'])->name('technicians.remove');
//*************************End Admin page*****************************//

//**********************for Techinician *******************************//
Route::get('technician/dashboard', [TechnicianController::class, 'technicians'])->middleware(['auth:custom_users', 'technician'])->name('technician.dashboard');
Route::get('technician/accepted/{id}', [TechnicianController::class, 'techaccepted'])->middleware(['auth:custom_users', 'technician'])->name('tech.accepted');
Route::get('technician/done/{id}', [TechnicianController::class, 'techdone'])->middleware(['auth:custom_users', 'technician'])->name('technician.done');
Route::get('technician/finish', [TechnicianController::class, 'finishTechnician'])->middleware(['auth:custom_users', 'technician'])->name('technician.finish');


//*********************End Technician ************************************/


//*********************requester********************************************//

Route::get('requester/dashboard', [RequesterController::class, 'requester'])->middleware(['auth:custom_users', 'requester'])->name('requester.dashboard');
Route::get('request/home', [RequesterController::class, 'homerequest'])->middleware(['auth:custom_users', 'requester'])->name('request.home');
Route::post('request/addrequest', [RequesterController::class, 'Addrequest'])->middleware(['auth:custom_users', 'requester'])->name('addrequest');
Route::get('request/cancel/{id}',[RequesterController::class, 'CancelRequest'])->middleware(['auth:custom_users', 'requester'])->name('request.cancel');
//*********************End requester********************************************

// users login and register
Route::get('login', [UsersController::class, 'loginusers'])->name('login');
Route::get('register', [UsersController::class, 'registeruser'])->name('register');

Route::post('loginuser', [UsersController::class, 'userLogin'])->name('loginuser');

//for landing Page
Route::get('landing', [LandingController::class, 'landingPage'])->name('landing');

Route::get('unauthorize', [LandingController::class, 'unauthorize'])->name('unauthorized');

Route::post('/logout', [UsersController::class, 'logout'])->name('logout');