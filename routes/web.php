<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrialConfigController;
use App\Models\Mass;
use App\Models\User;




Route::prefix('config')->group(function(){

    Route::get('getData',[TrialConfigController::class, 'getData'])->name('config.getData');
});



Route::get('/', function () {

    $data['userCount'] = User::countUsers();

    $data['pendingMassCount'] = Mass::countMassPending();

    $data['allMassCount'] = Mass::countMassAll();

    $data['allMassTodayCount'] = Mass::countMassToday();
    
    $data['getMassToday'] = Mass::getMassToday();
    // dd($data['getMassToday']);

    return view('user.welcome',$data);
})->name('home');


// account middleware 
Route::group(['prefix' => 'account'], function(){
    //verifies that the users is guest
    Route::group(['middleware' => 'guest'], function(){
        //register
        Route::get('/register',[AuthController::class,'register'])->name('account.register');
        //post : register
        Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');
        //login
        Route::get('/login',[AuthController::class,'login'])->name('account.login');
        //post : login
        Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');
        //forgot password
        Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('account.forgotPassword');
        //post : forgot password
        Route::post('/forgot-password',[AuthController::class,'postForgotPassword'])->name('account.postForgotPassword');
        //reset password form page
        Route::get('/reset/{token}',[AuthController::class,'reset'])->name('account.resetPassword');
        //post : reset password form
        Route::post('/reset/{token}',[AuthController::class,'postReset'])->name('account.postResetPassword');
    }); 

    Route::group(['middleware' => 'auth'], function(){

        

        //profile
        Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
        //update profile
        Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
        //show change password form
        Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
        //post: change password form
        Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');
        //logout
        Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

        /**Email Verication */

            //verify email
            Route::get('/verify-email',[AuthController::class,'verifyEmail'])->name('account.verifyEmail');

            //email verified
            Route::get('/email-verified/{token}',[AuthController::class,'emailVerified'])->name('account.emailVerified');

        /**end of Email Verification */

        //donation 
        Route::post('donate',[AuthController::class,'donate'])->name('account.donate');

        //donation success
        Route::post('donate/success',[AuthController::class,'donation_success'])->name('account.donate.success');

        //donation error
        Route::post('donate/error',[AuthController::class,'donation_error'])->name('account.donate.error');
        
    });


});


//User Routes
Route::middleware('user')->group(function(){

    /** User Mass Routes */
        //Store Mass
        Route::post('/mass/insert',[MassController::class,'insert'])->name('user.mass.insert');
        //Update Mass
        Route::post('/mass/update',[MassController::class,'update'])->name('user.mass.update');
        //Delete Mass
        Route::post('/mass/delete',[MassController::class,'delete'])->name('user.mass.delete');

        //Print mass Records 
        Route::post('/mass/print_mass_records',[MassController::class,'print_mass_records'])->name('user.mass.print_mass_records');

        //My Masses 
        Route::get('/mass/list',[MassController::class,'list'])->name('user.mass.list');

        //Get Mass Values 
        Route::post('/mass/get_values',[MassController::class,'get_mass_values'])->name('user.mass.get_values');

    /** end of User Mass Routes */

});

//Admin Route
Route::middleware('admin')->group(function(){
    
    /**Admin Mass Routes */
        //Mass List
        Route::get('admin/mass/list',[MassController::class,'list'])->name('admin.mass.list');
        //Mass Confirm
        Route::post('admin/mass/confirm',[MassController::class,'confirm'])->name('admin.mass.confirm');
        //Mass Cancel
        Route::post('admin/mass/cancel',[MassController::class,'cancel'])->name('admin.mass.cancel');
        //Print mass Records 
        Route::post('admin/mass/print_mass_records',[MassController::class,'print_mass_records'])->name('admin.mass.print_mass_records');
    /**end of Admin Mass Routes */


    /**Admin User Routes */
        //user list
        Route::get('admin/user/list',[UserController::class,'list'])->name('admin.user.list');

    /**end of Admin User Routes */

});