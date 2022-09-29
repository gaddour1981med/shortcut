<?php

use App\Http\Middleware\EnsureMaxLinks;
use App\Http\Middleware\EnsureMaxDBLinks;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return redirect(app()->getLocale());
});

Route::prefix('{shortcut}')
     ->where(['shortcut' => '[0-9a-zA-Z]{6}']) 
     ->group(function () {
    Route::get('/', [App\Http\Controllers\LinksController::class, 'redirect'])->name('shortcut');       
});


Route::prefix('{locale}')
       ->where(['locale' => '[a-zA-Z]{2}'])
       ->middleware('setlocale')
       ->group(function () {
    
        
        Route::get('/', function () {
            return view("welcome");
        });

        Auth::routes(['reset' => false,'verify' => false]);

        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/links/add/form', [App\Http\Controllers\LinksController::class, 'form']) ->name('links.add.form')
                                                                                             ->middleware(EnsureMaxLinks::class); 

        Route::post('/links/add/save', [App\Http\Controllers\LinksController::class, 'save']) ->name('links.add.save')
                                                                                              ->middleware([EnsureMaxLinks::class,
                                                                                                            EnsureMaxDBLinks::class]);

        
        Route::get('/links/{link_id}/delete', [App\Http\Controllers\LinksController::class, 'delete']) ->name('links.delete');

});
