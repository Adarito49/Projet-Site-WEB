<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
}); 

Route::get('/profile', [UserController::class, 'profile'])->name('profile');


Route::get('/apply/{offer_id}', [ApplyController::class, 'showForm'])->middleware(['auth'])->name('apply');
Route::post('/apply/{offer_id}', [ApplyController::class, 'sendEmail'])->middleware(['auth'])->name('apply.submit');


Route::get('/favorites', [App\Http\Controllers\FavoritesController::class, 'index'])->name('favorites');


Route::post('/favorites/add', [FavoritesController::class, 'add'])->middleware(['auth'])->name('favorites.add');
Route::post('/favorites/remove', [FavoritesController::class, 'remove'])->middleware(['auth'])->name('favorites.remove');

Route::get('/companies/ratings', [RatingController::class, 'index'])->name('companies.ratings');
Route::get('/companies/{company}/rate', [RatingController::class, 'rate'])->name('companies.rate')->middleware('auth');
Route::post('/rate', [RatingController::class, 'store'])->name('rate')->middleware('auth');

Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.destroy');

Route::post('/create-offer', [OfferController::class, 'store'])->name('offer.store');

Route::get('/companies-edit', [CompanyController::class, 'index'])->middleware('adminorpilot');
Route::put('/company/update', [CompanyController::class, 'update'])->name('company.update');
Route::get('/api/offers/{offerId}', [OfferController::class, 'show']);

Route::get('/edit/offer', [OfferController::class, 'index'])->name('offer.index');
Route::put('/edit/offer/update', [OfferController::class, 'update'])->name('offer.update');
Route::delete('/edit/offer/{id}', [OfferController::class, 'destroy'])->name('offer.destroy');

Route::get('/edit/user', [UserController::class, 'index'])->name('user.index');
Route::put('/edit/user/update', [UserController::class, 'update'])->name('user.update');
Route::delete('/edit/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');



Route::get('/offers/{id}', [OfferController::class, 'showOffer'])->name('offer.show');


Route::get('/', function () {
    return redirect('home');
})->middleware('redirectIfGuest');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/create/company', function () {
    return view('create_sheet/create_company');
})->middleware('adminorpilot');


Route::get('/legal', function () {
    return view('/footer/legal');
});

Route::get('/create/offers', function () {
    return view('create_sheet/create_offers');
})->middleware('adminorpilot');

Route::get('/edit/company/index', function () {
    return view('edit_sheet/company/index');
})->middleware('adminorpilot');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
