<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtoListingAcceptOfferController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

//Route::get('/', function () {
//
//    return inertia('Index/Index');
//});

Route::get('/',[IndexController::class,'index']);
Route::get('/hello',[IndexController::class,'show'])
->middleware('auth');



Route::resource('listing', ListingController::class)->only(['index', 'show']);

Route::resource('listing.offer',ListingOfferController::class)->middleware('auth')->only(['store']);


Route::resource('notification', NotificationController::class)
    ->middleware('auth')
    ->only(['index']);

Route::put('notification/{notification}/seen', NotificationSeenController::class)
    ->name('notification.seen')
    ->middleware('auth');

Route::get('login',[AuthController::class,'create'])->name('login');
Route::post('login',[AuthController::class,'store'])->name('login.store');
Route::delete('logout',[AuthController::class,'destroy'])->name('logout');

Route::get('/email/verify',function() {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect()->route('listing.index')->with('success', 'Your email has been verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::resource('user-account', UserAccountController::class)->only(['create','store']);


Route::prefix('realtor')
    ->name('realtor.')
    ->middleware(['auth','verified'])
    ->group(function () {
        Route::name('listing.restore')
            ->put(
                'listing/{listing}/restore',
                [RealtorListingController::class, 'restore']
            )->withTrashed();
        Route::resource('listing', RealtorListingController::class)
            ->withTrashed();

        Route::name('offer.accept')
            ->put('offer/{offer}/accept', RealtoListingAcceptOfferController::class);

        Route::resource('listing.image',RealtorListingImageController::class)
            ->only(['create','store','destroy']);
    });
