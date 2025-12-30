<?php

use Illuminate\Support\Facades\Route;
// Import your Controllers here so Laravel finds them
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ArasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Dashboard (Halaman Utama)
Route::get('/', function () {
    // You can point this to a specific dashboard view later
    return view('dashboard'); 
})->name('dashboard');

// 2. Data Kriteria (Criteria Menu)
// We typically only allow viewing (index) and editing weights (edit/update)
Route::resource('criteria', CriteriaController::class)
    ->only(['index', 'edit', 'update']);

// 3. Data Alternatif (Alternative Menu)
// Full CRUD: index (list), create (form), store (save), edit (form), update (save), destroy (delete)
Route::resource('alternatives', AlternativeController::class);

// 4. Penilaian (Evaluation Menu)
// Custom routes because we grade specific alternatives
Route::prefix('evaluations')->name('evaluations.')->group(function () {
    // List all alternatives to choose which one to grade
    Route::get('/', [EvaluationController::class, 'index'])->name('index');
    
    // Form to grade a specific alternative
    Route::get('/{alternative}/edit', [EvaluationController::class, 'edit'])->name('edit');
    
    // Save the grades
    Route::put('/{alternative}', [EvaluationController::class, 'update'])->name('update');
});

// 5. Hasil Perhitungan (ARAS Result)
Route::get('/aras-result', [ArasController::class, 'index'])->name('aras.result');