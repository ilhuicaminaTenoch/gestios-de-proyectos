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


Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth/login');
    });
    //Route::match(array('GET', 'POST'), 'login', 'Auth\LoginController@login')->name('login');
    Auth::routes();
});


Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');



    Route::group(['middleware' => ['Administrator']], function () {

        Route::get('Default', 'ReportesController@principal');
        //Gestiones
        Route::get('/gestion', 'GestionController@index');
        Route::get('/gestion/searchPerson', 'GestionController@searchBarCode');
        Route::get('/gestion/register', 'GestionController@register');

        Route::get('/home', 'HomeController@index')->name('home');
//PUESTOS
        Route::resource('/Catalogos/Cat_Puestos','PuestoController');
        Route::post('/Cat_Puestos/create','PuestoController@store');
        Route::get('/Catalogos/Cat_Puestos/destroy/{id_puesto}','PuestoController@destroy');

//EMPRESAS
        Route::resource('/Catalogos/Cat_Empresas','EmpresaController');
        Route::post('/Cat_Empresas/create','EmpresaController@store');
        Route::get('/Catalogos/Cat_Empresas/destroy/{id_compania}','EmpresaController@destroy');

//USUARIOS
        Route::resource('Catalogos/Cat_Usuarios','UsuarioController');
        Route::post('/Cat_Usuarios/create','UsuarioController@store');
        Route::get('/Catalogos/Cat_Usuarios/destroy/{id}','UsuarioController@destroy');

//CONTRATISTAS
        Route::resource('Catalogos/Cat_Contratistas','ContratistaController');
        //Route::resource('/Cat_Contratistas/create','ContratistaController@store');
        Route::get('/Catalogos/Cat_Contratistas/agregarH/{id_contratista}','ContratistaController@agregarH');
        Route::post('/Catalogos/Cat_Contratistas/{id_contratista}','ContratistaController@updateHabilidad');
        Route::get('/Codigos/horarios','ContratistaController@horarios');
        Route::get('/Codigos/verifica-horarios','ContratistaController@consultaHorarios');
        Route::get('/Codigos/generate-pdf','ContratistaController@generatePDF');
        Route::get('/Catalogos/Cat_Contratistas/destroy-view/{id_contratista}','ContratistaController@destroyView');
        Route::post('/Catalogos/activo','ContratistaController@activo');

        Route::get('/Codigos/examen-medico-e-induccion','ContratistaController@examenMedicoInduccion');
        Route::get('/Codigos/reporte-medico-e-induccion','ContratistaController@reporteMedicoInduccion');
        Route::get('/Codigos/reporte-pdf-medico-induccion','ContratistaController@reportePdfMedicoInduccion');

         
// Route::get('/Catalogos/Cat_Contratistas/{id_compania}/agregarH','ContratistaController@agregarH')
// ->name('Cat_Contratistas.updateHabilidad');

//BARRAS
        Route::resource('Codigos/Barras','BarrasController');
        Route::get('/Codigos/Barras/edit/{id_compania}', 'BarrasController@Buscar');
        Route::get('/pdfDownload', 'BarrasController@pdfDownload');

//REPORTES
        Route::resource('Reportes/HorasHombre','ReportesController');
        Route::resource('Reportes/HorasHombre/index','ReportesController@store');
        Route::get('Reportes/altas-bajas','ReportesController@altasBajas');
        Route::post('Reportes/consulta-altas-bajas','ReportesController@consultaAltasBajas');


//PDF
        Route::get('/pdf_form', 'PdfController@pdfForm');
        Route::post('/pdf_download', 'PdfController@pdfDownload');

//qr habilidades
        Route::resource('Codigos/QR','HabilidadesController');
        Route::get('/Codigos/QR/edit/{id_compania}', 'HabilidadesController@Buscar');
        
        Route::get('/pdfDownloadH', 'HabilidadesController@pdfDownloadH');

    });
    Route::group(['middleware' => ['Operador']], function () {
        //CONTRATISTAS
        Route::resource('Catalogos/Cat_Contratistas','ContratistaController');
        Route::resource('/Cat_Contratistas/create','ContratistaController@store');
        Route::get('/Catalogos/Cat_Contratistas/agregarH/{id_contratista}','ContratistaController@agregarH');
        Route::post('/Catalogos/Cat_Contratistas/{id_contratista}','ContratistaController@updateHabilidad');

        //BARRAS
        Route::resource('Codigos/Barras','BarrasController');
        Route::get('/pdfDownload', 'BarrasController@pdfDownload');

        //qr habilidades
        Route::resource('Codigos/QR','HabilidadesController');
        Route::get('/pdfDownloadH', 'HabilidadesController@pdfDownloadH');


    });

    Route::group(['middleware' => ['Seguridad']], function () {
        //Gestiones
        Route::get('/gestion', 'GestionController@index');
        Route::get('/gestion/searchPerson', 'GestionController@searchBarCode');
    });


});






