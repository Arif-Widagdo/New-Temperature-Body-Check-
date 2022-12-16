<?php

use App\Http\Controllers\Admin\AbsenceController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Employe\EmployeController;
use App\Http\Controllers\Admin\UserManagementController;

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

if (!App::isLocale('id') && !App::isLocale('en')) {
    App::setLocale('en');
}
Route::get('/locale/{locales}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [RouterController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [RouterController::class, 'profile'])->name('profile.edit');


    Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');

        // Route Users Position
        Route::get('/check-positions/slug', [PositionController::class, 'checkSlug'])->name('admin.check.positions');
        Route::delete('/positionst-deleteAll', [PositionController::class, 'deleteAll'])->name('admin.position.deleteAll');
        Route::resource('/positions', PositionController::class)->except(['create', 'edit']);

        // Route Users Management
        Route::resource('/users', UserManagementController::class)->except(['create', 'edit']);
        Route::delete('/users-management-deleteAll', [UserManagementController::class, 'deleteAll'])->name('admin.users.deleteAll');

        // Route Absence
        Route::resource('/presences', AbsenceController::class);
    });

    Route::group(['prefix' => 'employe', 'middleware' => 'isEmployee'], function () {
        Route::get('/dashboard', [EmployeController::class, 'index'])->name('employe.dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('employe.profile.edit');

        Route::post('/dashboard', [EmployeController::class, 'store'])->name('employe.store.temperature');
        Route::patch('/dashboard/{absence:id}', [EmployeController::class, 'update'])->name('employe.update.temperature');
        Route::delete('/dashboard/{absence:id}', [EmployeController::class, 'destroy'])->name('employe.destroy.temperature');
    });

    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::post('/change-profile-picture', [ProfileController::class, 'updatePicture'])->name('profile.pictureUpdate');
    Route::post('/profile-delete-picture', [ProfileController::class, 'deletePicture'])->name('profile.deletePicture');
});

require __DIR__ . '/auth.php';
