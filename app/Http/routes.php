<?php
session_start();
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
	Route::get('/', function () { return view('welcome'); });

	/************************************/
	Route::any('/', 'MainController@index');
	Route::any('/logout', 'MainController@logout');

	

	Route::get('/personas', '\Idrd\Usuarios\Controllers\PersonaController@index');
	Route::get('/personas/service/obtener/{id}', '\Idrd\Usuarios\Controllers\PersonaController@obtener');
	Route::get('/personas/service/buscar/{key}', '\Idrd\Usuarios\Controllers\PersonaController@buscar');
	Route::get('/personas/service/ciudad/{id_pais}', '\Idrd\Usuarios\Controllers\LocalizacionController@buscarCiudades');
	Route::post('/personas/service/procesar/', '\Idrd\Usuarios\Controllers\PersonaController@procesar');	
	/************************************/




//rutas con filtro de autenticación
Route::group(['middleware' => ['web']], function () {

	/********************SIAB***************************/
	
	Route::get('rud','DeportistaController@index');
	Route::get('welcome', 'MainController@welcome');
	Route::get('/personaDeportista/{id}','PersonaDeportistaController@obtener');
	Route::get('/personaBuscarDeportista/{id}','PersonaDeportistaController@buscar');
	/****RUD****/
	Route::get('getTallas/{id_genero}/{id_tipo}', 'DeportistaController@Tallas');  
	Route::get('deportista/{id}','DeportistaController@datos');
	Route::post('AddDeportista', 'DeportistaController@RegistrarDeportista');
	Route::post('EditDeportista', 'DeportistaController@ModificarDeportista');	
	Route::get('getAgrupacion/{id}', 'DeportistaController@Agrupaciones');
	Route::get('getDeporte/{id}', 'DeportistaController@Deportes');
	Route::get('getModalidad/{id}', 'DeportistaController@Modalidades');
	Route::get('getDeportistaDeporte/{id}', 'DeportistaController@DeportistaDeporte');
	Route::get('getEtapas/{id}', 'DeportistaController@Etapas');
	Route::get('getEtapasD/{id}', 'DeportistaController@getDeportistaEtapas');	
	Route::get('TallaTenis/{id}', 'DeportistaController@TallaTenis');  
	

	/***********PDF*************/
	Route::any('Descarga/{id}', 'DeportistaController@Descarga');
	Route::get('rudPDF/{id}','DeportistaController@RudPdf');

	/****Valoracion Psico****/
	Route::get('psico','ValoracionPsicoController@index');
	Route::post('AddValoracion', 'ValoracionPsicoController@RegistrarValoracion');
	Route::post('EditValoracion', 'ValoracionPsicoController@ModificarValoracion');
	Route::get('valoracion/{id_deportista}','ValoracionPsicoController@Valoracion_Datos');
	/*************************************************/


	/****Visitia domiciliaria****/
	Route::get('domicilio','VisitaController@index');
	Route::post('AddVisita', 'VisitaController@RegistrarVisita');
	Route::get('TraerVisita/{id}', 'VisitaController@GetVisita');
	/*************************************************/

	/****Actividades de intervención****/
	Route::get('actividad','ActividadController@index');	
	Route::post('AddActividad', 'ActividadController@RegistrarActividad');
	Route::post('EditActividad', 'ActividadController@ModificarActividad');	
	Route::get('TraeActividad/{id}','ActividadController@ActividadTraer');		
	/*************************************************/


	/****Suministros, apoyos y servicios****/
	Route::get('suministros','SuministrosController@index');	

	Route::post('AddComplemento', 'SuministrosController@RegistrarComplemento');
	Route::get('complemento/{id}','SuministrosController@Complemento_Datos');	
	Route::get('ValorComplemento/{id}','SuministrosController@ValorComplemento_Datos');			
	Route::get('ListaComplemento/{id}','SuministrosController@Lista_Complemento_Datos');	

	Route::post('AddApoyo', 'SuministrosController@RegistrarApoyo');
	Route::get('ListaApoyos/{id}','SuministrosController@Lista_Apoyos_Datos');	

	Route::post('AddAlimentacion', 'SuministrosController@RegistrarAlimentacion');
	Route::get('alimentacion/{id}','SuministrosController@Alimentacion_Datos');
	Route::get('ValorAlimentacion/{id}','SuministrosController@ValorAlimentacion_Datos');		
	Route::get('ListaAlimentacion/{id}','SuministrosController@Lista_Alimentacion_Datos');	
	/*************************************************/
	

	/********************Tecnico****************************/
	Route::get('configuracion','ConfiguracionController@inicio');
	Route::post('configuracion/crear','ConfiguracionController@guardar');
	Route::post('configuracion/modificar','ConfiguracionController@modificar');
	Route::get('configuracion/IdAgrupacion/{id}','ConfiguracionController@agrupacion');
	Route::get('configuracion/eliminarAgrupacion/{id}','ConfiguracionController@agrupacionEliminar');


	Route::get('deporte','ConfiguracionController@deporte');
	Route::post('configuracion/crear_dpt','ConfiguracionController@crear_dpt');
	Route::post('configuracion/modificar_dpt','ConfiguracionController@modificar_dpt');
	Route::get('configuracion/ver_deporte/{id}','ConfiguracionController@ver_deporte');
	Route::get('configuracion/eliminarDeporte/{id}','ConfiguracionController@deporteEliminar');


	Route::get('modalidad','ConfiguracionController@modalidad');
	Route::post('configuracion/crear_mdl','ConfiguracionController@crear_mdl');
	Route::post('configuracion/modificar_mdl','ConfiguracionController@modificar_mdl');
	Route::get('configuracion/ver_modalidad/{id}','ConfiguracionController@ver_modalidad');
	Route::get('configuracion/eliminarModalidad/{id}','ConfiguracionController@eliminarModalidad');


	Route::get('rama','ConfiguracionController@rama');
	Route::post('configuracion/crear_rm','ConfiguracionController@crear_rm');
    Route::post('configuracion/modificar_rm','ConfiguracionController@modificar_rm');
	Route::get('configuracion/ver_rama/{id}','ConfiguracionController@ver_rama');
	Route::get('configuracion/eliminarRama/{id}','ConfiguracionController@eliminarRama');


	Route::get('categoria','ConfiguracionController@categoria');
	Route::post('configuracion/crear_ct','ConfiguracionController@crear_ct');
	Route::post('configuracion/modificar_ct','ConfiguracionController@modificar_ct');
	Route::get('configuracion/ver_categoria/{id}','ConfiguracionController@ver_categoria');
	Route::get('configuracion/eliminarCategoria/{id}','ConfiguracionController@eliminarCategoria');

	Route::get('division','ConfiguracionController@division');
	Route::get('configuracion/ver_division/{id}','ConfiguracionController@ver_division');
	Route::post('configuracion/modificar_div','ConfiguracionController@modificar_division');
	Route::get('configuracion/eliminarDivision/{id}','ConfiguracionController@eliminarDivision');
	Route::post('configuracion/crear_division','ConfiguracionController@crear_division');


	Route::get('eventos','EventoController@index');
	Route::get('getEvento/{id}','EventoController@GetEvento');	
	Route::post('AddEvento','EventoController@AgregarEvento');	
	Route::post('EditEvento','EventoController@ModificarEvento');	
	Route::post('DeleteEvento','EventoController@EliminarEvento');	

	Route::get('certamen','CertamenController@index');
	Route::get('getPaises','CertamenController@GetPaises');	
	Route::get('getCiudades','CertamenController@GetCiudades');	
	Route::post('AddCertamen','CertamenController@AgregarCertamen');	
	Route::get('getCertamen/{id}','CertamenController@GetCertamen');	
	
	/*************************************************/
});