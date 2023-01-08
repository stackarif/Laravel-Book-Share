<?php

use App\Http\Controllers\Backend\AuthorsController;
use App\Http\Controllers\Backend\BackendPagesController;
use App\Http\Controllers\Backend\BooksController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\PublishersController;
use App\Http\Controllers\PagesController;
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
//     return view('welcome');
// });

Route::get('/',[PagesController::class,'index'])->name('index');
Route::get('/books',[BooksController::class,'index'])->name('books.index');
Route::get('/books/single',[BooksController::class,'show'])->name('books.show');

Route::get('books/categories/{slug}',[CategoriesController::class,'show'])->name('categories.show');

//admin
Route::group(['prefix'=> 'admin'], function(){

    Route::get('/', [BackendPagesController::class,'index'])->name('admin.index');

    Route::group(['prefix'=> 'books'], function(){
        Route::get('/', [BooksController::class,'index'])->name('admin.books.index');
        Route::post('/store', [BooksController::class,'store'])->name('admin.books.store');
        Route::get('/create', [BooksController::class,'create'])->name('admin.books.create');
        Route::get('/{id}', [BooksController::class,'show'])->name('admin.books.show');
        Route::post('/update/{id}', [BooksController::class,'update'])->name('admin.books.update');
        Route::post('/delete/{id}', [BooksController::class,'destroy'])->name('admin.books.delete');
    
    });

    Route::group(['prefix'=> 'authors'], function(){

        Route::get('/', [AuthorsController::class,'index'])->name('admin.authors.index');
        Route::post('/store', [AuthorsController::class,'store'])->name('admin.authors.store');
        Route::get('/{id}', [AuthorsController::class,'show'])->name('admin.authors.show');
        Route::post('/update/{id}', [AuthorsController::class,'update'])->name('admin.authors.update');
        Route::post('/delete/{id}', [AuthorsController::class,'destroy'])->name('admin.authors.delete');

    
    });

    Route::group(['prefix'=> 'categories'], function(){

        Route::get('/', [CategoriesController::class,'index'])->name('admin.categories.index');
        Route::post('/store', [CategoriesController::class,'store'])->name('admin.categories.store');
        Route::get('/{id}', [CategoriesController::class,'show'])->name('admin.categories.show');
        Route::post('/update/{id}', [CategoriesController::class,'update'])->name('admin.categories.update');
        Route::post('/delete/{id}', [CategoriesController::class,'destroy'])->name('admin.categories.delete');

    
    });

    Route::group(['prefix'=> 'publishers'], function(){

        Route::get('/', [PublishersController::class,'index'])->name('admin.publishers.index');
        Route::post('/store', [PublishersController::class,'store'])->name('admin.publishers.store');
        Route::get('/{id}', [PublishersController::class,'show'])->name('admin.publishers.show');
        Route::post('/update/{id}', [PublishersController::class,'update'])->name('admin.publishers.update');
        Route::post('/delete/{id}', [PublishersController::class,'destroy'])->name('admin.publishers.delete');

    
    });


});
