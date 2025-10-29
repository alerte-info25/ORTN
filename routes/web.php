<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| front end Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Front.Acceuil.index');
})->name("ortn.home");

Route::get('/actualites', function () {
    return view('Front.Actualites.index');
})->name("ortn.actualites");

Route::get('/programmes', function () {
    return view('Front.Programmes.index');
})->name("ortn.programmes");

Route::get('/podcasts', function () {
    return view('Front.Programmes.index');
})->name("ortn.podcasts");

Route::get('/evenements', function () {
    return view('Front.Evenements.index');
})->name("ortn.evenements");

Route::get('/contact', function () {
    return view('Front.Contact.index');
})->name("ortn.contact");

Route::get('/a-propos', function () {
    return view('Front.About.index');
})->name("ortn.about");
