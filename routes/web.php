<?php

use App\Http\Controllers\InstrumentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubMenuController;
use App\Http\Controllers\KriteriaController;

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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profil',  [UserController::class, 'tampil_profil']);

    
    Route::get('/menu',[MenuController::class,'list_menu']);
    Route::post('/tambah_menu', [MenuController::class, 'tambah_menu']);
    Route::post('/edit_menu', [MenuController::class, 'edit_menu']);
    Route::post('/hapus_menu', [MenuController::class, 'hapus_menu']);


    Route::get('/submenu',[SubMenuController::class,'list_submenu']);
    Route::post('/tambah_submenu', [SubMenuController::class, 'tambah_submenu']);
    Route::post('/hapus_submenu', [SubMenuController::class, 'hapus_submenu']);
    Route::post('/edit_submenu', [SubMenuController::class, 'edit_submenu']);

    Route::get('/kriteria',[KriteriaController::class,'index']);
    Route::post('/tambah_kriteria', [KriteriaController::class, 'store']);
    Route::post('/hapus_kriteria', [KriteriaController::class, 'destroy']);
    Route::post('/edit_kriteria', [KriteriaController::class, 'update']);

    Route::get('/instrument',[InstrumentController::class,'index']);
    Route::get('/tambah_instrument', [InstrumentController::class, 'add']);
    Route::post('/tambah_instrument', [InstrumentController::class, 'store']);
    Route::post('/hapus_instrument', [InstrumentController::class, 'destroy']);
    Route::get('/edit_instrument/{id}', [InstrumentController::class, 'edit']);
    Route::post('/update_instrument', [InstrumentController::class, 'update']);

    Route::post('/logout', [UserController::class, 'logout']);
});

// Route::get('/', [UserController::class, 'tampil_home']);
// Route::get('/auth', [UserController::class, 'tampil_login'])->name("login");

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [UserController::class, 'tampil_login'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});

Route::get('/', [UserController::class, 'mainpage']);
// Route::get('/', function(){
//     return view('welcome');
// }
// );
