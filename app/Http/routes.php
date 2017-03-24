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


	/********************ADMINISTRACION***************************/

	/********************Asignación de personas***************************/
	Route::get('persona_tipo','AdministracionController@index');
	Route::get('persona_tipoEspe/{id}','AdministracionController@PersonaTipo');
	Route::get('persona_tipoEspe2/{id}','AdministracionController@PersonaTipo2');
	Route::post('AddPersonaTipo', 'AdministracionController@AgregarPersonaTipo');
	Route::post('DeletePersonaTipo/{id_persona}/{id_tipo}', 'AdministracionController@EliminarPersonaTipo');


	/********************Asignación de permisos***************************/
	Route::get('persona_permiso','AdministracionController@indexPermisos');
	Route::get('/actividadesModulo', 'AdministracionController@moduloActividades');
	Route::get('getPersonaActividades/{id}','AdministracionController@personaActividades');
	Route::post('PersonasActividadesProceso', 'AdministracionController@PersonasActividadesProceso');

	/********************Administración de metodologos***************************/
	Route::get('metodologo_agrupacion','AdministracionController@indexMetodologoAgrupacion');
	Route::get('getMetodologoAgrupacion/{id_persona}','AdministracionController@GetMetodologoAgrupacion');
	Route::get('getMetodologoAgrupacionNO/{id_persona}','AdministracionController@GetMetodologoAgrupacionNO');
	Route::post('AddMetodologoAgrupacion','AdministracionController@AgregarMetodologoAgrupacion');			
	Route::post('DeleteMetodologoAgrupacion','AdministracionController@EliminarMetodologoAgrupacion');			
	

	/********************SIAB***************************/
	
	Route::get('rud','DeportistaController@index');
	Route::get('welcome', 'MainController@welcome');
	Route::get('/personaDeportista/{id}','PersonaDeportistaController@obtener');
	Route::get('/personaBuscarDeportista/{id}','PersonaDeportistaController@buscar');
	/****RUD****/
	Route::get('buscarTipoPersonaRUD/{cedula}', 'EntrenadorController@BuscarTipoPersonaRUD');  
	Route::get('getTallas/{id_genero}/{id_tipo}', 'DeportistaController@Tallas');  
	Route::get('deportista/{id}','DeportistaController@datos');
	Route::post('AddDeportista', 'DeportistaController@RegistrarDeportista');
	Route::post('EditDeportista', 'DeportistaController@ModificarDeportista');	
	Route::get('getAgrupacion/{id}', 'DeportistaController@Agrupaciones');
	Route::get('getDeporte/{id}', 'DeportistaController@Deportes');
	Route::get('getModalidad/{id}', 'DeportistaController@Modalidades');
	Route::get('getClasificacionFuncional/{id}', 'DeportistaController@ClasificacionesFuncionales');
	
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
	

	/********************TECNICO****************************/
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


	Route::get('clasificacion_funcional','ConfiguracionController@clasificacion_funcional');
	Route::post('configuracion/crear_clasificacion_funcional','ConfiguracionController@AddClasificacionFuncional');
	Route::get('configuracion/ver_clasificacion_funcional/{id}','ConfiguracionController@verClasificacionFuncional');
	Route::post('configuracion/modificar_clasificacion_funcional','ConfiguracionController@EditClasificacionFuncional');
	

	Route::get('eventos','EventoController@index');
	Route::get('getEvento/{id}','EventoController@GetEvento');	
	Route::post('AddEvento','EventoController@AgregarEvento');	
	Route::post('EditEvento','EventoController@ModificarEvento');	
	Route::post('DeleteEvento','EventoController@EliminarEvento');	
	Route::post('AddDeporteEvento','EventoController@AgregarDeporteEvento');	
	Route::post('DeleteDeporteEvento/{id_dep}/{id_eve}','EventoController@EliminarDeporteEvento');		
	Route::get('getDeportesEvento/{id}','EventoController@GetDeportesEvento');	
	Route::get('getDeportesNoEvento/{id}','EventoController@GetDeportesNoEvento');			

	Route::get('certamen','CertamenController@index');
	Route::get('getPaises','CertamenController@GetPaises');	
	Route::get('getCiudades','CertamenController@GetCiudades');	
	Route::post('AddCertamen','CertamenController@AgregarCertamen');	
	Route::post('EditCertamen','CertamenController@ModificarCertamen');		
	Route::get('getCertamen/{id}','CertamenController@GetCertamen');	
	Route::get('getDivision/{id}/{id_division}','CertamenController@GetDivision');	
	Route::post('AddPruebaCertamen','CertamenController@AgregarPruebaCertamen');	
	Route::get('getDivisionCertamen/{id}','CertamenController@GetDivisionCertamen');	
	Route::post('DeletePruebaCertamen/{id_prueba}/{id_certamen}','CertamenController@EliminarPruebaCertamen');		
	Route::get('getDivisionCertamen/{id}','CertamenController@GetDivisionCertamen');		
	Route::get('getDivisionDeportista/{id}','CertamenController@GetDivisionDeportista');		
	Route::get('getDeportistaDivision/{id}','CertamenController@GetDeportistaDivision');	
	Route::post('AddPruebaCertamenDeportista','CertamenController@AgregarPruebaCertamenDeportista');			
	Route::get('getDeportistaCertamenDivision/{id}','CertamenController@GetDeportistaCertamenDivision');	
	Route::get('getDivisionUnica/{id}','CertamenController@GetDivisionUnica');	
	Route::post('DeletePruebaCertamenDeportista/{id_deportista}/{id_division}/{id_certamen}','CertamenController@EliminarPruebaCertamenDeportista');			
	Route::get('getDepartamento','CertamenController@GetDepartamento');	

	Route::get('asignacion_pruebas','RegistroResultadosController@AsignacionPruebasDeportivas');
	Route::get('getEventosClasfificacion/{id}','RegistroResultadosController@GetEventosClasfificacion');
	Route::get('getCertamenEventos/{id}','RegistroResultadosController@GetCertamenEventos');
	Route::get('getDivisionCertamenMetod/{id_certamen}/{id_persona}','RegistroResultadosController@GetDivisionCertamenMetod');		
	Route::post('addCertamenDivisionMetodologo/{id_certamenDivision}/{id_persona}','RegistroResultadosController@AgregarCertamenDivisionMetodologo');			


	Route::get('denegacion_pruebas','RegistroResultadosController@DenegacionPruebasDeportivas');
	Route::get('getDivisionCertamenMetodS/{id_certamen}/{id_persona}','RegistroResultadosController@GetDivisionCertamenMetodS');		
	Route::post('deleteCertamenDivisionMetodologo/{id_certamenDivision}/{id_persona}','RegistroResultadosController@EliminarCertamenDivisionMetodologo');			


	Route::get('registro_resultados','RegistroResultadosController@RegistroResultadosDeportivos');
	Route::post('AddRegistroDeportista','RegistroResultadosController@AgregarRegistroDeportista');			
	Route::post('AddRegistroDeportistaN','RegistroResultadosController@AgregarRegistroDeportistaN');			
	Route::get('getCertamenDivisionResultados/{id_certamenDivision}','RegistroResultadosController@GetCertamenDivisionResultados');
	Route::post('deleteCertamenDivisionRegistro/{id}','RegistroResultadosController@EliminarCertamenDivisionRegistro');
	
	/*************************************************/

	/********************ENTRENADORES***************************/
	Route::get('rue','EntrenadorController@index');
	Route::get('buscarTipoPersona/{cedula}','EntrenadorController@BuscarTipoPersona');
	Route::get('entrenador/{id}','EntrenadorController@datosEntrenador');
	Route::post('AddEntrenador', 'EntrenadorController@RegistrarEntrenador');
	Route::post('EditEntrenador', 'EntrenadorController@ModificarEntrenador');

	Route::get('VEntrenadorDeportista','EntrenadorController@VincEntrenadorDeportista');
	Route::get('entrenadorDeportistaDatos','EntrenadorController@entrenadorDeportistaDatos');
	Route::get('getEntrenadorDeportistasNO/{id_persona}','EntrenadorController@GetEntrenadorDeportistasNO');
	Route::post('addVinculoDeportitaEntrenador', 'EntrenadorController@AddVinculoDeportitaEntrenador');
	Route::post('deleteVinculoDeportitaEntrenador', 'EntrenadorController@DeleteVinculoDeportitaEntrenador');


	Route::get('registro_plan','PlanesEntrenamientoController@index');

	

	/***********************************************************/
});