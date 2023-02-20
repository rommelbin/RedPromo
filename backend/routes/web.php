<?php

use App\Http\Controllers\MainController;
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
Route::get('/', function () {
    return 'Laravel version - ' . app()->version();
});


Route::post('/login', [MainController::class, 'login']);
Route::post('/register', [MainController::class, 'register']);



Route::addRoute(
    ['GET', 'POST', 'DELETE', 'PUT'],
    '/{model}/{method}/{id?}',
    [MainController::class, 'index']
)->middleware(['auth:sanctum', 'params']);

