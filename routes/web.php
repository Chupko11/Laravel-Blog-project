<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;
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


//Kada osoba otvori stranicu, prvo što se otvori je welcome view.
Route::get('/', function () {
    return view('welcome');
});

//grupacija route -> u ovom slucaju bi bio http://127.0.0.1:8000 sa dodatkom /author
Route::prefix('author')->name('author.')->group(function(){

    //Ova linija koda omogućuje osobama koji nisu korisnici da ostvore dva view-a (login i forgot-password)
        Route::middleware(['guest:web'])->group(function () {
            Route::view('/login','back.pages.auth.login')->name('login');
            Route::view('/forgot-password','back.pages.auth.forgot')->name('forgot-password');
        });

        //The next part of the code is saying that for pages in the 'author' group,
        //if someone is logged in (which is what the empty brackets mean), they should be able to access a page called 'home'. 
        //This page is represented by a function called 'index' in a class called 'AuthorController'.
        Route::middleware([])->group(function() {
            Route::get('/home', [AuthorController::class,'index'])->name('home'); 
                
            });
        
});