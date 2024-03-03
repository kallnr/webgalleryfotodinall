<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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

Route::middleware(['guest'])->group(function () {
    //Home Luar
    Route::get('/', function () {
        return view('/index');
    });
    //Login
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    //Register
    Route::get('/register', function () {
        return view('register');
    });
    //proses register
    Route::post('/registered', [UserController::class, 'register']);
    //proses log in
    Route::post('/ceklogin', [UserController::class, 'ceklogin']);
});
//middleware user
Route::middleware(['auth'])->group(function () {
    //data Explore
    Route::get('/getDataExplore', [UserController::class, 'getdata']);
    //likefoto
    Route::post('/likefoto', [UserController::class, 'likesfoto']);
    //Home explore
    Route::get('/explore', [UserController::class, 'explore']);
    //Home explore-detail
    Route::get('/explore-detail/{id}', [UserController::class, 'explore_detail']);
    //datadetailexplore
    Route::get('/explore-detail/{id}/getdatadetail', [UserController::class, 'getdatadetail']);
    //Menampilakan Komentar
    Route::get('/explore-detail/getkomen/{id}', [UserController::class, 'ambildatakomentar']);
    //kirimkomentar
    Route::post('/explore-detail/kirimkomentar', [UserController::class, 'kirimkomentar']);
    //follow
    Route::post('/explore-detail/ikuti', [UserController::class, 'ikuti']);
    //upload
    Route::get('/upload', [UserController::class, 'upload']);
    //tambahalbum
    Route::post('/tambah_album', [UserController::class, 'tambahalbum']);
    //upload foto
    Route::post('/upload', [UserController::class, 'upload_foto']);
    //album
    Route::get('/album/{id}', [UserController::class, 'showalbum']);
    //datapostinan
    Route::get('/getDataPostingan', [UserController::class, 'getdatapostingan']);
    //dataAlbum
    Route::get('/getDataAlbum', [UserController::class, 'getdataalbum']);
    //profil
    Route::get('/profil', [UserController::class, 'profil']);
    Route::get('/editprofil', [UserController::class, 'editprofil']);
    //updatedata
    Route::post('/updateprofil', [UserController::class, 'updatedataprofile']);
    //updatefotoprofile
    Route::post('/ubahprofil', [UserController::class, 'fotoprofil']);
    //changepassword
    Route::get('/password&username ', [UserController::class, 'edit_password_username']);
    Route::post('/updatepassword ', [UserController::class, 'update_password']);
    //fotopublic
    Route::get('/getDataPublic/{id}', [UserController::class, 'getdatapublic']);
     //menampilkan profile user lain
     Route::get('/profil_other/{id}', [UserController::class, 'profil_other'])->name('profil_other');
     Route::get('/otherpin/{id} ', [UserController::class, 'otherpin'])->name('otherpin');
    //log out
    Route::get('/logout ', [UserController::class, 'logout']);
});
