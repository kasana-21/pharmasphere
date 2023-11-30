<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/generate-token', [App\Http\Controllers\TokenController::class, 'generate'])->name('generate-token');

// Route::middleware('auth:sanctum')->group(function(){
//     Route::get('/drugs', [App\Http\Controllers\DrugController::class, 'index'])->name('drugs.index');
//     Route::get('/drugs/create', [App\Http\Controllers\DrugController::class, 'create'])->name('drugs.create');
//     Route::post('/drugs', [App\Http\Controllers\DrugController::class, 'store'])->name('drugs.store');
//     Route::get('/drugs/{drug}', [App\Http\Controllers\DrugController::class, 'show'])->name('drugs.show');
//     Route::get('/drugs/{drug}/edit', [App\Http\Controllers\DrugController::class, 'edit'])->name('drugs.edit');
//     Route::patch('/drugs/{drug}', [App\Http\Controllers\DrugController::class, 'update'])->name('drugs.update');
//     Route::delete('/drugs/{drug}', [App\Http\Controllers\DrugController::class, 'destroy'])->name('drugs.destroy');
// });

require __DIR__.'/auth.php';
