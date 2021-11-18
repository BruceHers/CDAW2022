<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\listeMediasController;

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
Route::get('/films', 'App\Http\Controllers\listeMediasController@helloWorld')->name('films');

Route::get('/{prenom}/{nom}', function($prenom, $nom){
    echo $prenom;
    echo '3';
    echo $nom;
});

Route::get('/template', function() {
    return view('template');
});

Route::get('/{title}', function($title, $id) {
    return $title;
})->where(['title' => '[a-z]+']);

Route::get('/', function() {
    echo "Liste des films";
})->name('listeFilms');

Route::get('/', function() {
    // echo "Hello world!";
    // return view('welcome');
    return view('helloworld');
});

?>

