<?php

use App\Http\Controllers\Admin\ComponentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionGroupController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\TendererController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home-test', [DashboardController::class, 'test'])->name('dashboard.test');
    Route::resource('permission-groups', PermissionGroupController::class)->except(['show']);
    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
    Route::post('roles/{role}/assign-permissions', [RoleController::class, 'assignPermissions'])->name('roles.assignPermissions');

    // Route::get('/home', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:delete users');;
    Route::resource('users', UserController::class);

    // Division 
    Route::resource('divisions', DivisionController::class)->except(['show']);
    Route::resource('zones', ZoneController::class)->except(['show']);
    Route::resource('districts', DistrictController::class)->except(['show']);
    Route::resource('upazilas', UpazilaController::class)->except(['show']);
    Route::resource('components', ComponentController::class)->except(['show']);
    Route::resource('tenderers', TendererController::class);

    Route::resource('schools', SchoolController::class);

    // Dependency dropdowns
    Route::get('get-zones/{division}', [SchoolController::class, 'getZones']);
    Route::get('get-districts/{zone}', [SchoolController::class, 'getDistricts']);
    Route::get('get-upazilas/{district}', [SchoolController::class, 'getUpazilas']);


    Route::resource('tenders', TenderController::class);

    // Extra routes for dependent dropdowns (if needed)
    Route::get('schools-by-division/{division}', [TenderController::class, 'schoolsByDivision']);
    Route::get('schools-by-zone/{zone}', [TenderController::class, 'schoolsByZone']);
    Route::get('schools-by-district/{district}', [TenderController::class, 'schoolsByDistrict']);
    Route::get('schools-by-upazila/{upazila}', [TenderController::class, 'schoolsByUpazila']);


});

require __DIR__.'/auth.php';
