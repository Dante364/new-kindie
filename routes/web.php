<?php

use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\StaffMiddleware;

use App\Livewire\Parent\Home as ParentHome;

use App\Livewire\Staff\Home as StaffHome;
use App\Livewire\Staff\ManageAttendance as StaffManageAttendance;
use App\Livewire\Staff\ViewReports as StaffViewReports;

use App\Livewire\Admin\Home as AdminHome;
use App\Livewire\Admin\ViewParent as AdminViewParents;
use App\Livewire\Admin\ViewStaff as AdminViewStaff;
use App\Livewire\Admin\ViewChildren as AdminViewChildren;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Landing and Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function() {
    return view('landing');
});

Route::get('/login', function() {
    return view('auth.login');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', function() {
    return view('auth.register');
});

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/forgot-password', function() {
    return view('auth.forgot-password');
});

Route::get('/reset-password', function() {
    return view('auth.reset-password');
});

Route::get('/verify-email', function() {
    return view('auth.verify-email');
});

Route::get('/verify-email/{id}/{hash}', function() {
    return view('auth.verify-email');
});


Route::get('/logout', function () {
    $guards = array_keys(config('auth.guards'));

    foreach ($guards as $guard) {
        if (auth()->guard($guard)->check()) {
            auth()->guard($guard)->logout();
        }
    }

    return redirect('/');
})->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:admin')->group(function() {
    Route::get('/admin/home', AdminHome::class)->name('admin.home');
    Route::get('/admin/view-parent', AdminViewParents::class)->name('admin.view-parent');
    Route::get('/admin/view-staff', AdminViewStaff::class)->name('admin.view-staff');
    Route::get('/admin/view-children', AdminViewChildren::class)->name('admin.view-children');
});


/*
|--------------------------------------------------------------------------
| Parents Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:parent')->group(function() {
    Route::get('/parent/home', ParentHome::class)->name('parent.home');
});

/*
|--------------------------------------------------------------------------
| Staff Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:staff')->group(function() {
    Route::get('/staff/home', StaffHome::class)->name('staff.home');
    Route::get('/staff/manage-attendance', StaffManageAttendance::class)->name('staff.manage-attendance');
    Route::get('/staff/view-reports', StaffViewReports::class)->name('staff.view-reports');
});
