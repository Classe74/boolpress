<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\DashboardController;
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

// Route::get('/', function () {
//     return view('guest.home');
// });
// clear
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')
   ->group(function () {
         Route::get('/', [DashboardController::class, 'index'])
         ->name('dashboard');
        Route::resource('posts', PostController::class)->parameters(['posts' => 'post:slug']);
        Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category:slug']);
        Route::resource('tags', TagController::class)->parameters(['tags' => 'tag:slug'])->except('show','create','edit');
   });


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

//es. che riporta sempre alla home
//Route::get('{any?}', function () {
//        return view('guest.home');
// })->where('any', '.*');

// altro es. Route::get('{any?}', [HomeController::class, 'index'])->where('any', '.*')->name('home');

// con questa riporta sempre alla login
// Route::get('{any?}', function () {
//     return redirect()->route('admin.dashboard');
// })->where('any', '.*');

Route::fallback(function() {
    return redirect()->route('admin.dashboard');
});
