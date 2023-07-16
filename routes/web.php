<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\SoapServer\BookSoapServerController;
use App\Http\Controllers\SoapServer\DemoSoapServerController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

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

Route::get('/', static function () {
    return view('welcome');
});

Route::any('/soap/v1/books', [BookSoapServerController::class, "__invoke"])
    ->name('soap.v1.books');

Route::any('/soap/v1/demos', [DemoSoapServerController::class, "__invoke"])
    ->name('soap.v1.demos');

Route::get('/demos/generate', static function () {
    $wsdlGenerator = new PHP2WSDL\PHPClass2WSDL(DemoController::class, route('soap.v1.demos'));
    $wsdlGenerator->generateWSDL(true);

    File::put(public_path('demos.wsdl'), $wsdlGenerator->dump());
});

Route::get('/books/generate', static function () {
    $wsdlGenerator = new PHP2WSDL\PHPClass2WSDL(BookController::class, route('soap.v1.books'));
    $wsdlGenerator->generateWSDL(false);

    File::put(public_path('books.wsdl'), $wsdlGenerator->dump());
});
