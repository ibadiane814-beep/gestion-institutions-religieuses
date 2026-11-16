<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DecesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MariageController;
use App\Http\Controllers\NaissanceController;
use App\Http\Controllers\ResponsableController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profil', [App\Http\Controllers\ProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');

    // Institutions
    Route::get('/institutions', [App\Http\Controllers\InstitutionController::class, 'index'])->name('institutions.index');

    // Mariages
    Route::get('/mariages/create', [MariageController::class, 'create'])->name('mariages.create');
    Route::post('/mariages', [MariageController::class, 'store'])->name('mariages.store');

    // Décès
    Route::get('/deces/create', [DecesController::class, 'create'])->name('deces.create');
    Route::post('/deces', [DecesController::class, 'store'])->name('deces.store');

    // Naissances
    Route::get('/naissances/create', [NaissanceController::class, 'create'])->name('naissances.create');
    Route::post('/naissances', [NaissanceController::class, 'store'])->name('naissances.store');
    Route::get('/mon-espace', [App\Http\Controllers\UserDashboardController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');

    // Mariages
    Route::get('/mariages', [\App\Http\Controllers\MariageController::class, 'index'])->name('mariages.index');
    Route::get('/mariages/pdf', [\App\Http\Controllers\MariageController::class, 'exportPdf'])->name('mariages.pdf');
    Route::get('/mariages/{mariage}/pdf', [\App\Http\Controllers\MariageController::class, 'fichePdf'])->name('mariages.fiche-pdf');
    Route::delete('/mariages/{mariage}', [\App\Http\Controllers\MariageController::class, 'destroy'])->name('mariages.destroy');

    // Décès
    Route::get('/deces', [\App\Http\Controllers\DecesController::class, 'index'])->name('deces.index');
    Route::get('/deces/pdf', [\App\Http\Controllers\DecesController::class, 'exportPdf'])->name('deces.pdf');
    Route::get('/deces/{dece}/pdf', [\App\Http\Controllers\DecesController::class, 'fichePdf'])->name('deces.fiche-pdf');
    Route::delete('/deces/{dece}', [\App\Http\Controllers\DecesController::class, 'destroy'])->name('deces.destroy');

    // Naissances
    Route::get('/naissances', [\App\Http\Controllers\NaissanceController::class, 'index'])->name('naissances.index');
    Route::get('/naissances/pdf', [\App\Http\Controllers\NaissanceController::class, 'exportPdf'])->name('naissances.pdf');
    Route::get('/naissances/{naissance}/pdf', [\App\Http\Controllers\NaissanceController::class, 'fichePdf'])->name('naissances.fiche-pdf');
    Route::delete('/naissances/{naissance}', [\App\Http\Controllers\NaissanceController::class, 'destroy'])->name('naissances.destroy');

    // Nouveaux utilisateurs
Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

// Institutions (admin)
Route::get('/institutions', [\App\Http\Controllers\Admin\InstitutionAdminController::class, 'index'])->name('institutions.admin.index');
Route::get('/institutions/create', [\App\Http\Controllers\Admin\InstitutionAdminController::class, 'create'])->name('institutions.create');
Route::post('/institutions', [\App\Http\Controllers\Admin\InstitutionAdminController::class, 'store'])->name('institutions.store');
Route::get('/institutions/{institution}/edit', [\App\Http\Controllers\Admin\InstitutionAdminController::class, 'edit'])->name('institutions.edit');
Route::put('/institutions/{institution}', [\App\Http\Controllers\Admin\InstitutionAdminController::class, 'update'])->name('institutions.update');
Route::delete('/institutions/{institution}', [\App\Http\Controllers\Admin\InstitutionAdminController::class, 'destroy'])->name('institutions.destroy');
});

Route::middleware(['auth', 'role:responsable'])->prefix('responsable')->name('responsable.')->group(function () {
    Route::get('/dashboard', [ResponsableController::class, 'dashboard'])->name('dashboard');
});
