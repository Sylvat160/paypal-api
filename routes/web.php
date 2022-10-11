<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaiementController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/pay', function () {
//     return view('layouts.paypal-script');
// });

Route::middleware(['auth'])->group(
    function () {
        Route::match(['post', 'get'], '/home', function () {
            return view('paiement');
        });
        Route::post('/pay', [PaiementController::class, 'paymentHandle'])->name('paiement');
        Route::get('/success', [PaiementController::class, 'success']);
        Route::get('/error', [PaiementController::class, 'error']);
    }
);

Route::get('/dashbord', function () {
    return view('layouts.dashbord');
})->middleware('has.payment')->name('dashbord');
