<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BioDataController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\itemcontoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->usertype && auth()->user()->usertype->name === 'Admin') {
        return app(DashboardController::class)->adminDashboard();
    }
    return app(DashboardController::class)->userDashboard();
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resident type selection
    Route::get('/resident-type', [App\Http\Controllers\ResidentTypeController::class, 'show'])->name('resident.type.show');
    Route::post('/resident-type', [App\Http\Controllers\ResidentTypeController::class, 'store'])->name('resident.type.store');

    // Bio data for authenticated users
    Route::get('/biodata',[BioDataController::class, 'bioData_C'])->name('user.biodataCollect');
    Route::post('/biodata',[BioDataController::class, 'store'])->name('user.storeBioData');

    // Resident type update
    Route::post('/update-resident-type', [BioDataController::class, 'updateResidentType'])->name('update.resident.type');

});

require __DIR__.'/auth.php';

// Resident type selection routes
Route::middleware('auth')->group(function () {
    Route::get('/resident-type', [App\Http\Controllers\ResidentTypeController::class, 'show'])->name('resident.type.show');
    Route::post('/resident-type', [App\Http\Controllers\ResidentTypeController::class, 'store'])->name('resident.type.store');
});

// Bio data routes (accessible to all users)
Route::get('/biodata',[BioDataController::class, 'bioData_C'])->name('biodataCollect');
Route::post('/biodata',[BioDataController::class, 'store'])->name('storeBioData');

Route::middleware('admin')->group(function () {
    Route::get('/admin/biodata', [BioDataController::class, 'index'])->name('admin.bioData.index');
    Route::get('/admin/biodata/{id}', [BioDataController::class, 'show'])->name('admin.bioData.show');
    Route::patch('/admin/biodata/{id}/approve', [BioDataController::class, 'approve'])->name('admin.bioData.approve');
    Route::patch('/admin/biodata/{id}/reject', [BioDataController::class, 'reject'])->name('admin.bioData.reject');
    Route::get('/admin/biodata/{id}/edit', [BioDataController::class, 'edit'])->name('admin.bioData.edit');
    Route::put('/admin/biodata/{id}', [BioDataController::class, 'update'])->name('admin.bioData.update');
    Route::delete('/admin/biodata/{id}', [BioDataController::class, 'destroy'])->name('admin.bioData.destroy');

    // Certificate routes
    Route::get('/admin/biodata/{id}/certificate/{type}/download', [BioDataController::class, 'downloadCertificate'])->name('admin.bioData.certificate.download');
    Route::get('/admin/biodata/{id}/certificate/{type}/view', [BioDataController::class, 'viewCertificate'])->name('admin.bioData.certificate.view');

    // New employee management routes
    Route::resource('admin/employees', EmployeeController::class, ['as' => 'admin']);
    Route::get('/admin/employees/export/excel', [EmployeeController::class, 'exportExcel'])->name('admin.employees.export.excel');
    Route::get('/admin/employees/export/pdf', [EmployeeController::class, 'exportPdf'])->name('admin.employees.export.pdf');

    // User management routes
    Route::resource('admin/users', UserController::class, ['as' => 'admin']);

    // Resident management routes
    Route::resource('admin/residents', ResidentController::class, ['as' => 'admin']);
});
