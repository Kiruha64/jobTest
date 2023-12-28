<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FileManagerController;
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

Route::get('/1', function () {
    return view('welcome');
});
Route::get('', [FileManagerController::class, 'index'])->name('file.index');
Route::post('', [FileManagerController::class, 'create'])->name('file.create');
Route::get('delete/{id}', [FileManagerController::class, 'delete'])->name('file.delete');
Route::get('download/{id}', [FileManagerController::class, 'download'])->name('file.download');



