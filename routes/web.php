<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\slider_pageController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\FamiliarController;
use App\Http\Controllers\HabitantesController;
use App\Http\Controllers\TipoDocumentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LoginController;




Auth::routes();
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');




Route::group(['middleware' => ['auth']], function() {

  Route::resource('sliders', SliderController::class); 
  
  Route::get('/cambioestadoslider', [SliderController::class,'cambioestadoslider']) -> name('cambioestadoslider');
  Route::get('/slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
  Route::put('/slider/{id}', [SliderController::class, 'update'])->name('slider.update');
  Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
  

   Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



   // PARAMETROS
	Route::resource('paises', PaisController::class);
	Route::get('cambioestadopais', [PaisController::class, 'cambioestadopais'])->name('cambioestadopais');
	
	Route::resource('departamentos', DepartamentoController::class);
	Route::get('cambioestadodepartamento', [DepartamentoController::class, 'cambioestadodepartamento'])->name('cambioestadodepartamento');
	
	Route::resource('ciudads', CiudadController::class);
	Route::get('cambioestadociudad', [CiudadController::class, 'cambioestadociudad'])->name('cambioestadociudad');
	Route::get('getDepartamentos', [CiudadController::class, 'getDepartamentos'])->name('getDepartamentos');
    
	Route::resource('tipodocumentos', TipodocumentoController::class);
	Route::get('cambioestadotipodocumento', [TipoDocumentoController::class, 'cambioestadotipodocumento'])->name('cambioestadotipodocumento');


	Route::resource('users', UsuarioController::class);
	Route::get('cambioestadouser', [UsuarioController::class, 'cambioestadouser'])->name('cambioestadouser');


//personas

Route::resource('habitantes', HabitantesController::class);
Route::get('cambioestadohabitante', [HabitantesController::class, 'cambioestadohabitante'])->name('cambioestadohabitante');
Route::get('getDepartamentos', [HabitantesController::class, 'getDepartamentos'])->name('getDepartamentos');
Route::get('getDepartamentosEdit', [HabitantesController::class, 'getDepartamentosEdit'])->name('getDepartamentosEdit');
Route::get('getCiudads', [HabitantesController::class, 'getCiudads'])->name('getCiudads');
Route::get('getCiudadsEdit', [HabitantesController::class, 'getCiudadsEdit'])->name('getCiudadsEdit');

Route::resource('familiares', FamiliarController::class)->parameters([
    'familiares' => 'familiar'
]);Route::get('cambioestadofamiliar', [FamiliarController::class, 'cambioestadofamiliar'])->name('cambioestadofamiliar');
Route::get('getFamiliares', [FamiliarController::class, 'getFamiliares'])->name('getFamiliares');


});





