<?php

    use Illuminate\Support\Facades\DB;
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
    Route::get('test',function (){
        log_slack('Testing logs', 'Test');
        //return get_days_of_week();
        // $msg = "Congratulations you have won airtime of GHS 1 for patronizing the indomie brand.";
       
        // $disbursed =  disburse_airtime(233243038039,0.2,get_network_from_id('MTN'));
        // return log_slack(['INDOMIE SUCCESS'],'https://hooks.slack.com/services/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');
        // return $disbursed;
        // exit();
        // return $disbursed;
        //         send_sms_by_url('', 233243038039, $msg, 'Indomie_GH');

    });

    Route::get('/', [\App\Http\Controllers\Auth\AuthController::class,'login'])->name('welcome');
    Route::get('/login', [\App\Http\Controllers\Auth\AuthController::class,'login'])->name('login');
    Route::post('process-login', [\App\Http\Controllers\Auth\AuthController::class,'processLogin'])
        ->name('process.login');

    @include('more_web_routes/user_routes.php');
    @include('more_web_routes/statistics_routes.php');

    /*Route::middleware('auth')->group(function (){
        Route::get('dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard.index');
    });*/
