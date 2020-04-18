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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//PUESTOS
Route::resource('/Catalogos/Cat_Puestos','PuestoController');
Route::post('/Cat_Puestos/create','PuestoController@store');
//EMPRESAS
Route::resource('/Catalogos/Cat_Empresas','EmpresaController');
Route::post('/Cat_Empresas/create','EmpresaController@store');
//USUARIOS
Route::resource('Catalogos/Cat_Usuarios','UsuarioController');
Route::post('/Cat_Usuarios/create','UsuarioController@store');
//CONTRATISTAS
Route::resource('Catalogos/Cat_Contratistas','ContratistaController');
Route::resource('/Cat_Contratistas/create','ContratistaController@store');
Route::get('/Catalogos/Cat_Contratistas/mod/{id_compania}','ContratistaController@agregarH');

//BARRAS
Route::resource('Codigos/Barras','BarrasController');
Route::get('/pdfDownload', 'BarrasController@pdfDownload');

//Gestiones
Route::get('/gestion', 'GestionController@index');
Route::get('/gestion/searchPerson', 'GestionController@searchBarCode');


//PDF
Route::get('/pdf_form', 'PdfController@pdfForm');
Route::post('/pdf_download', 'PdfController@pdfDownload');

