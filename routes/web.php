<?php

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
    return view('publica.layouts.master');
});

// Route::get('/', 'PublicaController@home')->name('home');
Route::get('/empresa', 'PublicaController@empresa')->name('empresa');
Route::get('/servicios', 'PublicaController@servicios')->name('servicios');
Route::get('/productos', 'PublicaController@productos')->name('productos');
Route::get('/productos/{slug}', 'PublicaController@producto')->name('producto');
Route::get('/proyectos', 'PublicaController@proyectos')->name('proyectos');
Route::get('/proyectos/{slug}', 'PublicaController@proyecto')->name('proyecto');
Route::get('/clientes', 'PublicaController@clientes')->name('clientes');
Route::get('/sectores', 'PublicaController@sectores')->name('sectores');
Route::get('/contacto', 'PublicaController@contacto')->name('contacto');
Route::post('/contacto', 'PublicaController@contact')->name('contact');
Route::get('/presupuesto', 'PublicaController@presupuesto')->name('presupuesto');
Route::post('/presupuesto', 'PublicaController@sendpresupuesto')->name('sendpresupuesto');

Route::prefix('adm')->middleware('auth')->group(function () {
	
	Route::get('/', function () {
	    return view('adm.index');
	})->name('adm');

	Route::get('usuarios/listar', ['as' =>'usuarios.listar' , 'uses' => 'UserController@listar']);
	Route::get('perfil', ['as' =>'perfil' , 'uses' => 'UserController@perfil']);
	Route::post('perfil', ['uses' => 'UserController@perfilUpdate','as' => 'perfil.update']);
	Route::resource('usuarios', 'UserController');

	Route::get('metadatos',['uses' => 'InfoController@metadatos',	'as' => 'info.metadatos']);
	Route::prefix('info')->group(function () {
		Route::get('{data}',	['uses' => 'InfoController@index',		'as' => 'info.empresa']);
		Route::put('general',	['uses' => 'InfoController@general',	'as' => 'info.general']);
		Route::put('emails',	['uses' => 'InfoController@emails',		'as' => 'info.emails']);
		//Route::put('imagenes',	['uses' => 'InfoController@imagenes',	'as' => 'info.imagenes']);
		Route::put('redes',	['uses' => 'InfoController@redes',		'as' => 'info.redes']);
		Route::put('terminos',	['uses' => 'InfoController@terminos',	'as' => 'info.terminos']);
		Route::get('metadatos/{id}',['uses' => 'InfoController@showmetadato',	'as' => 'info.showmetadatos']);
		Route::put('metadatos/{id}',['uses' => 'InfoController@savemetadato',	'as' => 'info.savemetadatos']);
	});

	Route::prefix('home')->group(function () {
		Route::get('slider',['uses' => 'MultimediaController@SliderHome','as' => 'home.slider']);
		Route::get('slider/form/{id?}',['uses' => 'MultimediaController@SliderHomeID','as' => 'home.slider.id']);
		Route::get('contenido-extra',['uses' => 'InfoController@ContenidoHomeShow','as' => 'home.contenido']);
		Route::post('contenido-extra',['uses' => 'InfoController@ContenidoHomeSave','as' => 'home.contenido.save']);
	});

	Route::get('texto-extra',['uses' => 'InfoController@TextoSeccionesshow','as' => 'texto.index']);
	Route::post('texto-extra',['uses' => 'InfoController@TextoSeccionessave','as' => 'texto.save']);

	Route::prefix('empresa')->group(function () {
		Route::get('slider',['uses' => 'MultimediaController@SliderEmpresa','as' => 'empresa.slider']);
		Route::get('slider/form/{id?}',['uses' => 'MultimediaController@SliderEmpresaID','as' => 'empresa.slider.id']);
		Route::get('contenido',['uses' => 'ContenidoController@ContenidoEmpresa','as' => 'empresa.contenido']);
		Route::get('contenido/form/{id?}',['uses' => 'ContenidoController@ContenidoEmpresaID','as' => 'empresa.contenido.id']);

		Route::get('timeline',['uses' => 'HistoriaController@index','as' => 'timeline.index']);
		Route::get('timeline/form/{id?}',['uses' => 'HistoriaController@form','as' => 'timeline.form']);
		Route::post('timeline',['uses' => 'HistoriaController@store','as' => 'timeline.store']);
		Route::delete('timeline/{id}',['uses' => 'HistoriaController@destroy','as' => 'timeline.destroy']);
	});

	Route::prefix('servicios')->group(function () {
		Route::get('',['uses' => 'ServiciosController@index','as' => 'servicios.index']);
		Route::get('form/{id?}',['uses' => 'ServiciosController@FormServiciosID','as' => 'servicios.form.id']);
		Route::post('',['uses' => 'ServiciosController@store','as' => 'servicios.store']);
		Route::delete('{id}',['uses' => 'ServiciosController@destroy','as' => 'servicios.destroy']);
		Route::get('/getServicios', ['as' =>'servicios.getServicios' , 'uses' => 'ServiciosController@getServicios']);

	});

	Route::prefix('productos')->group(function () {
		Route::get('',['uses' => 'ContenidoController@ContenidoProductos','as' => 'productos.contenido']);
		Route::get('form/{id?}',['uses' => 'ContenidoController@ContenidoProductosID','as' => 'productos.contenido.id']);
		Route::get('{id}',['uses' => 'ContenidoController@ProductosIDshow','as' => 'productos.show']);
		Route::post('images/reposition/{id}', [ 'uses' => 'ContenidoController@reposition', 'as' => 'images.reposition' ]);
		Route::delete('images/delete/{id_item}/{id_img}', [ 'uses' => 'ContenidoController@delete', 'as' => 'images.delete' ]);
	});

	Route::prefix('proyectos')->group(function () {
		Route::get('',['uses' => 'ProyectosController@index','as' => 'proyectos.index']);
		Route::get('form/{id?}',['uses' => 'ProyectosController@FormProyectosID','as' => 'proyectos.form.id']);
		Route::post('',['uses' => 'ProyectosController@store','as' => 'proyectos.store']);
		Route::delete('{id}',['uses' => 'ProyectosController@destroy','as' => 'proyectos.destroy']);
	});

	Route::get('sectores/contenido',['uses' => 'ContenidoController@ContenidoSectores','as' => 'sectores.contenido']);
	Route::get('sectores/contenido/form/{id?}',['uses' => 'ContenidoController@ContenidoSectoresID','as' => 'sectores.contenido.id']);

	Route::post('file',['uses' => 'MultimediaController@store','as' => 'file.store']);
	Route::delete('file/{id}',['uses' => 'MultimediaController@destroy','as' => 'file.destroy']);

	Route::post('contenido',['uses' => 'ContenidoController@store','as' => 'contenido.store']);
	Route::delete('contenido/{id}',['uses' => 'ContenidoController@destroy','as' => 'contenido.destroy']);

	Route::get('clientes/listar', ['as' =>'clientes.listar' , 'uses' => 'ClientesController@listar']);
	Route::resource('clientes', 'ClientesController', ['except' => ['create', 'edit', 'update']]);
});


Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');
