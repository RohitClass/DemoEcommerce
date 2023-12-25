<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(["prefix" => "admin"], function () {

    // <---------without login routes-------->
    Route::group(['middleware' => 'admin.guest'], function () {

        Route::get('/', [LoginController::class, 'index'])->name('admin.login');
        Route::post('login', [LoginController::class, 'loginSubmit'])->name('login.loginSubmit');
    });

    // <---------after login routes--------->
    Route::group(['middleware' => 'admin.auth'], function () {

        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [LoginController::class, 'logout'])->name("logout.logout");

        // <--------category routes---------->
        Route::get('/category', [CategoryController::class, 'category'])->name('admin.category');
        Route::post('/create', [CategoryController::class, 'create'])->name('create.create');
        Route::post('/getslug', function (Request $request) {
            $slug = '';
            if (!empty($request->slug)) {
                $slug = Str::slug($request->slug);
            }
            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getslug');

        Route::get('/categorylist', [CategoryController::class, 'categorylist'])->name('categorylist.categorylist');
    });
});
