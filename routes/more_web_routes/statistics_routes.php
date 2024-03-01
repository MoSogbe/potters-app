<?php

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\UploadContactController;
    use App\Http\Controllers\PromoSetUpController;
    use Illuminate\Support\Facades\Route;

    Route::middleware('auth')->group(function (){
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard.index');
    Route::get('upload-products', [DashboardController::class,'uploadProduct'])->name('dashboard.upload.products');

    Route::get('view-undisbursed', [DashboardController::class,'undisbursedContact'])->name('dashboard.upload.undisbursed');

    Route::post('move-contacts-file', [UploadContactController::class,'moveContactFile'])->name('dashboard.move.file');


    Route::post('upload-products', [UploadContactController::class,'moveContactFile'])->name('dashboard.import.contacts');
    Route::get('uploaded-products', [DashboardController::class,'listProducts'])->name('dashboard.uploaded.products');
    Route::get('promo-codes/data', [DashboardController::class,'getCodeData'])->name('dashboard.promo.codes.data');

    

    });
