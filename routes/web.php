<?php

use App\Enums\MaritalStatusEnum;
use App\Enums\PersonnelMaritalStatus;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/personnel', [App\Http\Controllers\PersonnelController::class, 'index'])->name('personnel.index');

Route::get('/personnel/create', [App\Http\Controllers\PersonnelController::class, 'create'])->name('personnel.create');

Route::post('/personnel/store', [App\Http\Controllers\PersonnelController::class, 'store'])->name('personnel.register');

Route::get('/personnel/{personnel}/edit', [App\Http\Controllers\PersonnelController::class, 'edit'])->name('personnel.edit');

Route::put('/personnel/{personnel}/update', [App\Http\Controllers\PersonnelController::class, 'update'])->name('personnel.update');

Route::get('/personnel/show/{personnel}', [App\Http\Controllers\PersonnelController::class, 'show'])->name('personnel.show');

Route::post('/personnel/staffno/search', [App\Http\Controllers\PersonnelController::class, 'getByStaffNo']);

Route::get('/personnel/promotion', [App\Http\Controllers\PromotionHistoryController::class, 'promotion'])->name('personnel.promotion');

Route::post('promotion', [App\Http\Controllers\PromotionHistoryController::class, 'savePromotion'])->name('promotion.promote');

Route::get('state/{id}/lgas', [\App\Http\Controllers\LGAController::class, 'getLocalGovernmentsByStateId'] );

Route::get('faculty/{id}/departments', [\App\Http\Controllers\FacultyController::class, 'getDepartments'] );

// Route::post('/personnel/nextofkin', [App\Http\Controllers\PersonnelController::class, 'addNextOfKin'])->name('personnel.nextofkin');
Route::post('nextofkin/store', [App\Http\Controllers\NextOfKinController::class, 'store'])->name('nextofkin.save');

Route::post('education-history/store', [App\Http\Controllers\EducationHistoryController::class, 'store'])->name('education-history.save');

Route::get('education-history/show/{educationHistory}', [App\Http\Controllers\EducationHistoryController::class, 'show'])->name('education-history.show');

Route::delete('education-history/delete/{educationHistory}', [App\Http\Controllers\EducationHistoryController::class, 'destroy'])->name('education-history.destroy');

Route::get('/nextofkin/show/{nextOfKin}', [App\Http\Controllers\NextOfKinController::class, 'show'])->name('nextofkin.show');

Route::get('/personnel/education-history/{id}', [App\Http\Controllers\EducationHistoryController::class, 'getPersonnelEducationHistory'])->name('education-history.list');

// Employment History
Route::post('employment-history/store', [App\Http\Controllers\EmploymentHistoryController::class, 'store'])->name('employment-history.save');

Route::get('employment-history/show/{employmentHistory}', [App\Http\Controllers\EmploymentHistoryController::class, 'show'])->name('employment-history.show');

Route::delete('employment-history/delete/{employmentHistory}', [App\Http\Controllers\EmploymentHistoryController::class, 'destroy'])->name('employment-history.destroy');

Route::get('/personnel/employment-history/{id}', [App\Http\Controllers\EmploymentHistoryController::class, 'getPersonnelEmploymentHistory'])->name('employment-history.list');


// promotion History
Route::post('promotion-history/store', [App\Http\Controllers\PromotionHistoryController::class, 'store'])->name('promotion-history.save');

Route::get('promotion-history/show/{promotionHistory}', [App\Http\Controllers\PromotionHistoryController::class, 'show'])->name('promotion-history.show');

Route::delete('promotion-history/delete/{promotionHistory}', [App\Http\Controllers\PromotionHistoryController::class, 'destroy'])->name('promotion-history.destroy');

Route::get('/personnel/promotion-history/{id}', [App\Http\Controllers\PromotionHistoryController::class, 'getPersonnelPromotionHistory'])->name('promotion-history.list');

// publications
Route::post('publication/store', [App\Http\Controllers\PublicationController::class, 'store'])->name('publication.save');

Route::get('publication/show/{publication}', [App\Http\Controllers\PublicationController::class, 'show'])->name('publication.show');

Route::delete('publication/delete/{publication}', [App\Http\Controllers\PublicationController::class, 'destroy'])->name('publication.destroy');

Route::get('/personnel/publication/{id}', [App\Http\Controllers\PublicationController::class, 'getPersonnelPublication'])->name('publication.list');

// Applications
Route::get('/application', [App\Http\Controllers\ApplicationController::class, 'index'])->name('application.index');

Route::get('/application/show/{id}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('application.show');

Route::get('/application/register', [App\Http\Controllers\ApplicationController::class, 'create'])->name('application.register');

Route::post('/application/store', [App\Http\Controllers\ApplicationController::class, 'store'])->name('application.register');

Route::get('/application/{id}/edit', [App\Http\Controllers\ApplicationController::class, 'edit'])->name('application.edit');

Route::put('/application/{application}/update', [App\Http\Controllers\ApplicationController::class, 'update'])->name('application.update');

// Facultry routes
Route::post('faculty/store', [App\Http\Controllers\FacultyController::class, 'store'])->name('faculty.save');

Route::get('faculty/show/{faculty}', [App\Http\Controllers\FacultyController::class, 'show'])->name('faculty.show');

Route::delete('faculty/delete/{faculty}', [App\Http\Controllers\FacultyController::class, 'destroy'])->name('faculty.destroy');

Route::get('faculties', [App\Http\Controllers\FacultyController::class, 'index'])->name('faculty.index');

// Department routes
Route::post('department/store', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.save');

Route::get('department/show/{department}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('department.show');

Route::delete('department/delete/{department}', [App\Http\Controllers\DepartmentController::class, 'destroy'])->name('department.destroy');

Route::get('department', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
