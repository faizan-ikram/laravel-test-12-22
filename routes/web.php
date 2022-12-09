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

Route::get('/', function () {
    return view('welcome');
});

Route::get('private/temp/{path}', function (string $path){
    if (! \request()->hasValidSignature()) {
        abort(401);
    }
    return Storage::disk('private')->download($path);
})->name('private.temp');