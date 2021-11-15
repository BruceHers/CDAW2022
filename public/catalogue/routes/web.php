<?php

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
Route::get('/{title}', function ($title) {
    echo $title;
})->where(['title' => '[a-zA-Z]+']);

Route::get('/{firstname}/{surname}', function ($firstname, $surname) {
    //return view('hello');
    echo $firstname."\n";
    echo $surname;
    //return "Hello world";
});

Route::get('/', function () {
    //return view('hello');
    echo "Liste des films";
    //return "Hello world";
})->name('listeFilms');

Route::get('/', function () {
    //return view('hello');
    //echo "hello";
    //return ("Hello world");
    return('<!doctype html> <html lang="fr"> <head> <meta charset="UTF-8"> <title>Mauvaise façon</title> </head> <body> <p>Le fichier risque d\'être longggggg</p> </body> </html>');
});



