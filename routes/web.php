<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\AdminsController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SystemInformationController;
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\ForgetPasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\OvertimeController;


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
    return view('backend.auth.login');
});

Route::get('/clear', function() {
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return redirect()->back();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');


//salary route add
Route::resource('salary',SalaryController::class);
//end salary route


//overtime route add
Route::resource('overtime',OvertimeController::class);
//end overtime route

//company route add
Route::resource('company',CompanyController::class);
//end compnay route


//department route start
Route::resource('department',DepartmentController::class);
//end department route

//designation route
Route::resource('designation',DesignationController::class);
//end designation route

//bank route
Route::resource('bank',BankController::class);
//end bank route

//employee route
Route::resource('employee',EmployeeController::class);
//end employee route



    Route::get('systemInformation', [SystemInformationController::class, 'index'])->name('admin.system_information');
    Route::post('systemInformation/store', [SystemInformationController::class, 'store'])->name('admin.system_information.store');
    Route::post('systemInformation/update', [SystemInformationController::class, 'update'])->name('admin.system_information.update');
    Route::post('systemInformation/delete/{id}', [SystemInformationController::class, 'delete'])->name('admin.system_information.delete');

    Route::get('roles', [RolesController::class, 'index'])->name('admin.roles');
    Route::get('roles/create', [RolesController::class, 'create'])->name('admin.roles.create');
    Route::post('roles/store', [RolesController::class, 'store'])->name('admin.roles.store');
    Route::get('roles/edit/{id}', [RolesController::class, 'edit'])->name('admin.roles.edit');
    Route::post('roles/update', [RolesController::class, 'update'])->name('admin.roles.update');

    Route::delete('roles/delete/{id}', [RolesController::class, 'delete'])->name('admin.roles.delete');


    Route::get('users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('users/create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('users/store', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::post('users/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('users/delete/{id}', [UsersController::class, 'delete'])->name('admin.users.delete');


    Route::get('permission', [PermissionController::class, 'index'])->name('admin.permission');
    Route::get('permission/create', [PermissionController::class, 'create'])->name('admin.permission.create');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('admin.permission.store');
    Route::get('permission/edit/{id}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
    Route::get('permission/view/{gname}', [PermissionController::class, 'view'])->name('admin.permission.view');
    Route::post('permission/update', [PermissionController::class, 'update'])->name('admin.permission.update');

    Route::delete('permission/delete/{id}', [PermissionController::class, 'delete'])->name('admin.permission.delete');




    Route::get('admins', [AdminsController::class, 'index'])->name('admin.admins');
    Route::get('admins/create', [AdminsController::class, 'create'])->name('admin.admins.create');
    Route::post('admins/store', [AdminsController::class, 'store'])->name('admin.admins.store');
    Route::get('admins/edit/{id}', [AdminsController::class, 'edit'])->name('admin.admins.edit');
    Route::post('admins/update', [AdminsController::class, 'update'])->name('admin.admins.update');
    Route::delete('admins/delete/{id}', [AdminsController::class, 'delete'])->name('admin.admins.delete');


    Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('profile/update/{id}', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::post('password/update',[ProfileController::class, 'updatePassword'])->name('admin.password.update');



    Route::get('settings',[ProfileController::class, 'setting'])->name('admin.settings');
    Route::get('view_profile',[ProfileController::class, 'profile_view'])->name('admin.profile_view');







    // Login Routes
    Route::get('/login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login/submit',[LoginController::class,'login'])->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit',[LoginController::class,'logout'])->name('admin.logout.submit');

    Route::get('/recovery_password',[SessionController::class,'recovery_password'])->name('admin.recovery_password');

    Route::get('/logout_session',[SessionController::class,'logout_session'])->name('admin.logout_session');
    Route::get('/lock_screen/{email}',[SessionController::class,'lock_screen'])->name('admin.lock_screen');
    Route::post('/login_from_session',[SessionController::class,'login_from_session'])->name('admin.login_from_session');
    // Forget Password Routes

    Route::get('/check_mail_from_list',[ForgetPasswordController::class,'check_mail_from_list'])->name('check_mail_from_list');
    Route::post('/send_mail_get_from_list',[ForgetPasswordController::class,'send_mail_get_from_list'])->name('send_mail_get_from_list');
    Route::get('/password_reset_page/{id}',[ForgetPasswordController::class,'password_reset_page'])->name('password_reset_page');
    Route::get('/successfully_mail_send/{id}',[ForgetPasswordController::class,'successfully_mail_send'])->name('successfully_mail_send');

    Route::post('/password_change_confirmed',[ForgetPasswordController::class,'password_change_confirmed'])->name('password_change_confirmed');

    Route::get('/password/reset',[ForgetPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');

});
