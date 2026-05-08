<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportDatasetController;
use App\Http\Controllers\ModelPerformanceController;
use App\Http\Controllers\TestingPredikController;
use App\Http\Controllers\TextProcessingController;
use App\Http\Controllers\TFIDFController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/dataset', [ImportDatasetController::class, 'index'])
    ->name('dataset.index');
Route::post('/dataset/import', [ImportDatasetController::class, 'import'])
    ->name('dataset.import');
Route::get('/dataset/data', [ImportDatasetController::class, 'data'])
    ->name('dataset.data');

Route::get('/text-processing', [TextProcessingController::class, 'index'])
    ->name('text-processing.index');
Route::get('/text-processing/data', [TextProcessingController::class, 'data'])
    ->name('text-processing.data');
Route::post('/run-preprocessing', [TextProcessingController::class, 'run'])
    ->name('run.preprocessing');

Route::get('/tfidf', [TFIDFController::class, 'index'])
    ->name('tfidf.index');
Route::get('/tfidf/data', [TFIDFController::class, 'data'])
    ->name('tfidf.data');

Route::get('/model-performance', [ModelPerformanceController::class, 'index'])
    ->name('model-performance.index');

Route::get('/testing-predik', [TestingPredikController::class, 'index'])
    ->name('testing-predik.index');
