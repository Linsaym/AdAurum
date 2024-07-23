<?php

use App\Http\Controllers\CompanyCommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FieldCommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/companies_page', fn() => Inertia::render('Companies'))->name('companies');
    Route::get('/company/{id}', fn(int $id) => Inertia::render('CompanyPage', ['id' => $id]))->name('company');
    Route::get('/company/{id}/field/{fieldId}', fn(int $id, int $fieldId) => Inertia::render('CompanyField', ['id' => $id, 'fieldId' => $fieldId]))->name('field');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{companyId}', [CompanyController::class, 'show']);
Route::post('/companies', [CompanyController::class, 'store']);


Route::get('companies/{companyId}/comments', [CompanyCommentController::class, 'show'])->name('company_comments.show');
Route::post('companies/{companyId}/comments', [CompanyCommentController::class, 'store'])->name('company_comments.store');

Route::get('companies/{companyId}/field_comment/{fieldId}', [FieldCommentController::class, 'show'])->name('field_comments.store');
Route::post('companies/{companyId}/field_comment/{fieldId}', [FieldCommentController::class, 'store'])->name('field_comments.store');


require __DIR__ . '/auth.php';
