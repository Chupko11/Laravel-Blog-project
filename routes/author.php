<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;

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
        Route::middleware(['auth:web'])->group(function() {
            Route::get('/home', [AuthorController::class,'index'])->name('home'); 
            Route::post('/logout', [AuthorController::class, 'logout'])->name('logout');
            });
        
});