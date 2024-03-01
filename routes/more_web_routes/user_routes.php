<?php

    use App\Http\Controllers\Auth\AuthController;
    use App\Http\Controllers\DashboardController;
    use Illuminate\Support\Facades\Route;

    Route::middleware('auth')->group(function () {

        Route::get('sign-out', [AuthController::class, 'signOut'])
            ->name('dashboard.users.sign.out');

      
            Route::get('list-users', [AuthController::class, 'listUsers'])
                ->name('dashboard.users');

            Route::get('create-user', [AuthController::class, 'registration'])
                ->name('dashboard.users.register');

            Route::post('store-user', [AuthController::class, 'processRegistration',])
                ->name('dashboard.users.store');


            Route::get('settings', [DashboardController::class, 'settings'])
                ->name('dashboard.settings');

            Route::post('settings', [DashboardController::class, 'processSettings'])
                ->name('dashboard.process.settings');
       

    });



