<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    PlanProductController
};
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/plan-products', [PlanProductController::class, 'index'])->name('plan.index');
Route::get('/plan-products/{slug}', [PlanProductController::class,'show'])->name('plan.show');
Route::post('/plan-produts.purchase/{slug}', [PlanProductController::class,'purchase'])->name('plan.purchase');
