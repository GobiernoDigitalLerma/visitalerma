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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', 'PaginaController@index')->name('pagina.index');

Route::get('admin', 'SistemaController@admin');

//Login
Route::get('login', 'LoginController@index')->name('login');
Route::post('validarusuario', 'LoginController@validarusuario')->name('validarusuario');
Route::get('logout', 'LoginController@logout')->name('logout');

//CRUD  de usuarios cristian lira
Route::get('/usuario', 'UsuarioController@index')->name('usuario');
Route::get('usuariosalta', 'UsuarioController@create')->name('usuariosalta');
Route::post('creauser', 'UsuarioController@store')->name('creauser');
Route::DELETE('/eliminaruser/{id}', 'UsuarioController@destroy');
Route::get('iditaruser/{id}', 'UsuarioController@edit')->name('iditaruser');
Route::post('updateusers', 'UsuarioController@update')->name('updateusers');

//Rutas Actividad Ayodoro
Route::get('alta_actividad', 'ActividadController@alta_actividad');
Route::POST('guardar_actividad', 'ActividadController@guardar_actividad');
Route::get('actividad', 'ActividadController@actividad')->name('actividad');
Route::get('modificar_actividad/{ida}', 'ActividadController@modificar_actividad');
Route::POST('guardar_modificacion_actividad', 'ActividadController@guardar_modificacion_actividad');
Route::DELETE('/eliminaractividad/{id}', 'ActividadController@destroy');
Route::DELETE('/desactivaractividad/{id}', 'ActividadController@desactiva');
Route::DELETE('/activaractividad/{id}', 'ActividadController@activa');

//CRUD TIPO DE ACTIVIDAD

Route::get('tipo_actividad', 'TipoActividadController@tipo_actividad');
Route::post('enviar_tipoac', 'TipoActividadController@enviar_tipoac')->name('enviar_tipoac');
Route::get('/reporte_tactividad', 'TipoActividadController@reporte_tactividad')->name('reporte_tactividad');
Route::DELETE('/eliminartactividad/{id}', 'TipoActividadController@destroy');
Route::get('/edita_tactividadvista/{id_tipo_actividad}', 'TipoActividadController@edita_tactividadvista')->name('edita_tactividadvista');
Route::post('editatactividad', 'TipoActividadController@editatactividad')->name('editatactividad'); //guarda modifica
Route::get('reactivartactividad/{id_tipo_actividad}', 'TipoActividadController@reactivartactividad')->name('reactivartactividad'); //reactivar
Route::get('delete_cascada/{id_tipo_actividad}', 'TipoActividadController@delete_cascada')->name('delete_cascada'); //eliminar en Cascada


//CRUD TIPO DE USUARIOS

Route::get('tipo_usuarios', 'TipoUsuarioController@tipo_usuarios');
Route::post('enviar_tusu', 'TipoUsuarioController@enviar_tusu')->name('enviar_tusu');
Route::get('/reporte_tusuarios', 'TipoUsuarioController@reporte_tusuarios')->name('reporte_tusuarios');
Route::get('/edita_tusuariosvista/{id_tipo_usuario}', 'TipoUsuarioController@edita_tusuariosvista')->name('edita_tusuariosvista');
Route::post('editatusuarios', 'TipoUsuarioController@editatusuarios')->name('editatusuarios');
Route::DELETE('/eliminartusuario/{id}', 'TipoUsuarioController@destroy');
Route::get('reactivartusuario/{id_usuario}', 'TipoUsuarioController@reactivartusuario')->name('reactivartusuario'); //reactivar

// CRUD FOTO ACTIVIDADES
Route::get('fotos_actividades', 'FotoActividadController@fotos_actividades');
Route::POST('guardar_fotosact', 'FotoActividadController@guardar_fotosact')->name('guardar_fotosact');
Route::get('reporte', 'FotoActividadController@reporte')->name('reporte');
Route::get('mod_fotos_actividades/{pera}', 'FotoActividadController@mod_fotos_actividades');
Route::POST('guarda_fotos_actividades', 'FotoActividadController@guarda_fotos_actividades')->name('guarda_fotos_actividades');
Route::DELETE('/eliminarfotoactividad/{id}', 'FotoActividadController@destroy');


// CRUD FOTO SUB ACTIVIDADES
Route::get('fotos_sub_actividades', 'FotoSubActividadController@fotos_sub_actividades');
Route::POST('guardar_foto_sub_act', 'FotoSubActividadController@guardar_foto_sub_act')->name('guardar_foto_sub_act');
Route::get('reporte_sub_actividad', 'FotoSubActividadController@reporte_sub_actividad')->name('reporte_sub_actividad');
Route::get('mod_fotos_subactividades/{pera}', 'FotoSubActividadController@mod_fotos_subactividades');
Route::POST('guarda_fotos_sub_actividad', 'FotoSubActividadController@guarda_fotos_sub_actividad')->name('guarda_fotos_sub_actividad');
Route::DELETE('/eliminarfotosubactividad/{id}', 'FotoSubActividadController@destroy');

//CRUD RESEÑA
Route::get('resena', 'ResenaActividadController@index')->name('resena');
Route::get('AgregaReseñaActividad', 'ResenaActividadController@create')->name('altaresena');
Route::post('GuardaReseñaActividad', 'ResenaActividadController@store')->name('guardaresena');
Route::get('ModificaReseñaActividad/{resenaActividad}', 'ResenaActividadController@edit')->name('modificaresena');
Route::post('ActualizaReseñaActividad/{resenaActividad}', 'ResenaActividadController@update')->name('Actualizaresena');
Route::DELETE('/eliminaresenaactividad/{id}', 'ResenaActividadController@destroy');


//CRUD RESEÑASUB
Route::get('resenasub', 'ResenaSubActividadController@index')->name('resenasub');
Route::get('AgregaReseñaSub', 'ResenaSubActividadController@create')->name('altareseña');
Route::post('GuardaReseñaSub', 'ResenaSubActividadController@store')->name('guardareseña');
Route::get('ModificaReseñaSub/{resenaSubActividad}', 'ResenaSubActividadController@edit')->name('modificaresubresena');
Route::PATCH('ActualizaReseñaSub/{resenaSubActividad}', 'ResenaSubActividadController@update')->name('Actualizarsubresena');
Route::DELETE('/eliminaresenasubactividad/{id}', 'ResenaSubActividadController@destroy');
Route::DELETE('/eliminarResena/{id}', 'ResenaSubActividadController@delete');

//CRUD BANNER
Route::get('/ban', 'BanerController@index')->name('ban');
Route::get('/nbanner', 'BanerController@create')->name('nbanner');
Route::post('Guardarbaner', 'BanerController@store')->name('Guardarbaner');
Route::get('iditarbaner/{id}', 'BanerController@edit')->name('iditarbaner');
Route::post('updatbaner', 'BanerController@update')->name('updatbaner');
Route::DELETE('/eliminarbaner/{id}', 'BanerController@destroy');

//CRUD SUB ACTIVIDAD
Route::GET('subactividades', 'SubActividadController@index')->name('subactividades');
Route::GET('altaSubactividad', 'SubActividadController@create')->name('altaSubactividad');
Route::POST('newSubactividad', 'SubActividadController@store')->name('newSubactividad');
Route::GET('editSubactividad/{id}', 'SubActividadController@edit')->name('editSubactividad');
Route::PUT('updateSubactividad/{id}', 'SubActividadController@update')->name('updateSubactividad');
Route::DELETE('deleteSubactividad/{id}', 'SubActividadController@destroy')->name('deleteSubactividad');
Route::get('status', 'SubActividadController@status')->name('status');

//CRUD UBICACIÓN ACTVIDAD
Route::get('ubicaciones-actividad', 'UbicacionActividadController@index');
Route::get('create-ubicacion-actividad', 'UbicacionActividadController@create');
Route::post('store-ubicacion-actividad', 'UbicacionActividadController@store');
Route::get('edit-ubicacion-actividad/{id}', 'UbicacionActividadController@edit');
Route::post('update-ubicacion-actividad/{id}', 'UbicacionActividadController@update');
Route::DELETE('eliminar-ubicacion-actividad/{id}', 'UbicacionActividadController@destroy');
Route::post('eliminar-ubicacion-actividad-ajax/{id}', 'UbicacionActividadController@destroy');


//CRUD UBICACIÓN SUB-ACTVIDAD
Route::get('ubicaciones-sub-actividad', 'UbicacionSubActividadController@index');
Route::get('create-ubicacion-sub-actividad', 'UbicacionSubActividadController@create');
Route::post('store-ubicacion-sub-actividad', 'UbicacionSubActividadController@store');
Route::get('edit-ubicacion-sub-actividad/{id}', 'UbicacionSubActividadController@edit');
Route::post('update-ubicacion-sub-actividad/{id}', 'UbicacionSubActividadController@update');
Route::delete('eliminarubicacion_subactividad/{id}', 'UbicacionSubActividadController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//RUTAS DE PAGINA

Route::get('banner/{nombre}', 'PaginaController@banner')->name('paginaBanner');

/*=======================================
=            Rutas que hacer            =
=======================================*/
Route::get('quehacer', 'PaginaController@actividades')->name('quehacer');
Route::get('quehacern3/{nombre}', 'PaginaController@quehacern3')->name('quehacern3');
Route::get('quehacern4/{nombre}', 'PaginaController@quehacern4')->name('quehacern4');
/*=====  End of Rutas que hacer  ======*/


Route::get('QueSucede', 'ActividadController@show')->name('QueSucede');

Route::get('festival-cultura', 'PaginaController@festival')->name('festival');
Route::get('festival-cultura/actvidades/{nombre}', 'PaginaController@festival3')->name('festival.actividades');
Route::get('festival-cultura/actvidades/detalle/{nombre}', 'PaginaController@festival4')->name('festival.actividades.detalle');
/* Fin de Ruta Festival y Cultura */

//Rutas Seccion Actividades
Route::get('index_actividades', 'PaginaController@index_actividades')->name('index_actividades');
Route::get('abrir/{abrir}', 'PaginaController@abrir')->name('abrir');
Route::get('index_actividades4/{nombre}', 'PaginaController@index_actividades4')->name('index_actividades4');

/* Rutas por nivel de seccion Que sucede Ahora */
Route::get('queSucede', 'PaginaController@queSucede')->name('pagina.queSucede');
Route::get('queSucede/actividad/{nombre}', 'PaginaController@queSucedeNivel3')->name('pagina.queSucedeNivel3');
Route::get('queSucede/subactividades/{nombre}', 'PaginaController@queSucedeNivel4')->name('pagina.queSucedeNivel4');
/* Fin de Ruta Que Sucede Ahora */


/*Rutas de conoce lerma por nivel*/
Route::get('conoce_lerma', 'PaginaController@conoce_lerma')->name('conoce_lerma');
Route::get('conoce_lerma_actividades/{nombre}', 'PaginaController@conoce_lerma_actividades')->name('conoce_lerma_actividades');
Route::get('conoce_lerma_subactividades/{nombre}', 'PaginaController@conoce_lerma_subactividad')->name('conoce_lerma_subactividad');

Route::get('mas_sub-actividades', 'PaginaController@cuartoNivel')->name('mas_sub-actividades');

//FIN DE RUTAS DE PAGINA

/*==================================================
=            calificacion sub actividad            =
==================================================*/
Route::post('/calificacionsub', 'CalSubActividadController@store')->name('calificacionsub');


/*=====  End of calificacion sub actividad  ======*/

//CRUD TIPO_ARTESANIAS

Route::get('tipo_artesanias', 'ControllerTartesanias@tipo_artesanias');
Route::post('enviar_tipoartesania', 'ControllerTartesanias@enviar_tipoartesania')->name('enviar_tipoartesania');
Route::get('reporte_tartesanias', 'ControllerTartesanias@reporte_tartesanias')->name('reporte_tartesanias');
Route::get('/edita_tartesaniasvista/{id_tipo_artesanias}', 'ControllerTartesanias@edita_tartesaniasvista')->name('edita_tartesaniasvista');
Route::post('editatartesanias', 'ControllerTartesanias@editatartesanias')->name('editatartesanias');
//Desactivar AJAX
Route::post('eliminar-artesania-ajax/{id}', 'ControllerTartesanias@destroy');
//Desactivar ACTIVAR AJAX
Route::post('activar-artesania-ajax/{id}', 'ControllerTartesanias@reactivar');
//eliminar AJAX
Route::post('eliminardefinitivo-artesania-ajax/{id}', 'ControllerTartesanias@eliminar');


/*==================================================
=            CRUD DE ARTESANIAS           =
==================================================*/
Route::get('artesaniasp', 'ProductosArtesaniasController@index')->name('artesaniasp');
Route::get('artesaniasalta', 'ProductosArtesaniasController@create')->name('artesaniasalta');
Route::post('guardar_artesanias', 'ProductosArtesaniasController@store')->name('guardar_artesanias');





/*=====  End of CRUD DE ARTESANIAS ======*/
Route::get('artesanos', 'artesanoController@index')->name('artesano');
Route::get('altartesano', 'artesanoController@create')->name('altartesano');
Route::post('guardartesano', 'artesanoController@store')->name('guardaratesano');
Route::get('modificarartesano/{id_art}', 'artesanoController@edit')->name('editarartesano');
Route::post('updateartesano', 'artesanoController@update')->name('updateartesano');
Route::post('eliminardefinitivo-artesano-ajax/{id_art}', 'artesanoController@eliminar');

// Mapa
Route::get('mapa','MapaController@index');


Route::get('notificaciones','SubscribeController@notificaciones')->name('notificaciones');
Route::post('sendNotification','SubscribeController@sendNotification')->name('sendNotification');
Route::post('downloadPWA','UsuarioController@downloadPWA');
Route::get('checkpwa/{ip}','UsuarioController@checkpwa');
