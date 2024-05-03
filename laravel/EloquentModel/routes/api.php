<?php

use App\Http\Controllers\ArticleController;
use App\Models\Address;
use App\Models\Scope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/articles', [ArticleController::class, 'store']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/show', [ArticleController::class, 'show']);
Route::get('/lazy', [ArticleController::class, 'lazy']);
Route::get('/demo', [ArticleController::class, 'demo']);

Route::get('/flights', [ArticleController::class, 'indexone'])->name('flights.index');
Route::delete('/flights/{id}', [ArticleController::class, 'destroy'])->name('flights.destroy');
Route::put('/flights/{id}/restore', [ArticleController::class, 'restore'])->name('flights.restore');
Route::get('/add', function () {
    // Create a new address for shipping
    // Create a new address for shipping
    $shipping = Address::create([
        'type' => 'shipping',
        'line_1' => '123 Example Street',
        'city' => 'Victorville',
        'state' => 'CA',
        'postcode' => '90001',
    ]);

    // Replicate the shipping address for billing
    $billing = $shipping->replicate()->fill([
        'type' => 'billing'
    ]);

    // Save the billing address
    $billing->save();

    return 'Address replicated successfully!';
});

Route::get('/Scope', function () {
    // Create some dummy users
    

    // Retrieve popular and active users
    $popularActiveUsers = Scope::popular()->active()->get();

    // Retrieve popular or active users
    $popularOrActiveUsers = Scope::popular()->orWhere->active()->get();

    return [
        'popular_active_users' => $popularActiveUsers,
        'popular_or_active_users' => $popularOrActiveUsers,
    ];
});