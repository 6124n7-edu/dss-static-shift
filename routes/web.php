<?php

use Illuminate\Support\Facades\Route;
// Import Controllers
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ArasController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. GUEST ROUTES (Accessible by everyone) ---

// Show Login Page
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Process Login Form
Route::post('/login', [AuthController::class, 'login'])->name('login.post');


// --- 2. PROTECTED ROUTES (Must be logged in to access) ---

Route::middleware(['auth'])->group(function () {
    
    // Logout Action
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (Home)
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // Criteria Management (Index, Edit, Update only)
    Route::resource('criteria', CriteriaController::class)
        ->only(['index', 'edit', 'update']);

    // Alternatives Management (Full CRUD)
    Route::resource('alternatives', AlternativeController::class);

    // Evaluations (Grading System)
    Route::prefix('evaluations')->name('evaluations.')->group(function () {
        Route::get('/', [EvaluationController::class, 'index'])->name('index');
        Route::get('/{alternative}/edit', [EvaluationController::class, 'edit'])->name('edit');
        Route::put('/{alternative}', [EvaluationController::class, 'update'])->name('update');
    });

    // ARAS Calculation Result
    Route::get('/aras-result', [ArasController::class, 'index'])->name('aras.result');
});