<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\QuotationController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/prescriptions/create', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions.index');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/quotations', [QuotationController::class, 'index'])->name('pharmacy.quotations.index');
    Route::post('/quotations/{prescription}', [QuotationController::class, 'store']);
    Route::patch('/quotations/{quotation}', [QuotationController::class, 'updateStatus'])->name('quotations.updateStatus');
});

Route::middleware(['auth:sanctum', 'pharmacy'])->group(function () {
    Route::get('/pharmacy/prescriptions', [PrescriptionController::class, 'indexForPharmacy'])->name('pharmacy.prescriptions.index');
    Route::get('/quotations/create/{prescription}', [QuotationController::class, 'create'])->name('quotations.create');
    Route::post('/quotations/{prescription}', [QuotationController::class, 'store'])->name('quotations.store');
});


require __DIR__.'/auth.php';
