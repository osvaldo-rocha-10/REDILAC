<?php



//RUTA RAIZ
Route::get('/', function (){
        return view('auth.login');
})->name('/');

//RUTAS LOGIN

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');   
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//RUTAS COORDINADOR DOCENTE

Route::group(['middleware' => 'docente'], function () {  //RUTAS ENCRIPTADAS USO COORDINADOR DOCENTE


       Route::get('/operacion/docente', 'OperacionController@Operacion')->name('operacion.docente');  //SECCION OPERACIONES
      
       Route::get('/formato_reporte/docente', 'FormatoController@FormatoReporteDocente')->name('formato_reporte.docente');  //SECCIÓN FORMATOS

       Route::get('/recurso/docente/5.2', 'RecursoController@RecursoEvaluacion')->name('recurso.docente_5.2');
       Route::get('/recurso/docente/5.1', 'RecursoController@RecursoDocente')->name('recurso.docente_5.1');  //SECCIÓN RECURSO DOCENTE
       Route::get('/recurso/docente/', 'RecursoController@RecursoDocente')->name('recurso.docente');
         
       Route::post('/galeria/Eliminar','GaleriaController@Eliminar')->name('galeria.eliminar');      //SECCIÓN GALERIA DE EQUIPO.
       Route::put('/galeria/{NoInventario}/Subir','GaleriaController@Subir')->name('galeria.subir');
       Route::get('/galeria/{NoInventario}','GaleriaController@Index')->name('galeria.index');


       Route::put('/equipo/{id}/observacion_update','EquipoController@Update_Observacion')->name('equipo.observacion_update');
       Route::get('/equipo/{id}/observacion','EquipoController@Crear_Editar_Observacion')->name('equipo.observacion');
       Route::get('/equipo/docente/1.1', 'EquipoController@EquiposResguardoDocente')->name('equipo.docente_1.1');
       Route::get('/equipo/docente', 'EquipoController@EquipoDocente')->name('equipo.docente');  //SECCIÓN EQUIPOS

       Route::get('/home/docente', 'HomeController@HomeDocente')->name('home.docente');  //SECCION HOME 

});


//RUTAS COORDIRNADOR DE AREA/////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => 'area'], function () {  //RUTAS ENCRIPTADAS USO COORDINADOR DE AREA

    Route::get('/home/area', 'HomeController@HomeArea')->name('home.area');
    Route::get('/instalacion/area', 'InstalacionController@InstalacionArea')->name('instalacion.area');
    Route::get('/instalacion_categoria/area', 'TipoInstalacionController@CategoriaArea')->name('instalacion_categoria.area');

  

    
    Route::get('/marca/area/2.6',   'MarcaController@MarcaArea')->name('marca.area_2.6');
    Route::get('/tipo_equipo/area/2.5',   'TipoEquipoController@TipoEquipoArea')->name('tipo_equipo.area_2.5');
    Route::get('/equipo/area/2.4', 'EquipoController@RestaurarArea')->name('equipo.area_2.4');
    Route::get('/equipo/area/2.3', 'EquipoController@ListaBajaArea')->name('equipo.area_2.3');
    Route::get('/equipo/2.2', 'EquipoController@ListaConcentrado')->name('equipo.area_2.2');
    Route::get('/equipo/area/2.1', 'EquipoController@EquiposRegistradosArea')->name('equipo.area_2.1');
    Route::get('/equipo/area', 'EquipoController@EquipoArea')->name('equipo.area');
     
     
     Route::get('/reporte/area/3.4','ReporteController@Filtro1')->name('reporte.area_3.4');
     Route::get('/reporte/area/3.3', 'ReporteController@EstatusBaja')->name('reporte.area_3.3');
     Route::get('/formato/area/3.2', 'FormatoController@Formato')->name('formato.area_3.2');
     Route::get('/reporte/area/3.1', 'ReporteController@Reporte')->name('reporte.area_3.1');
     Route::get('/formato_reporte/area', 'FormatoController@FormatoReporteArea')->name('formato_reporte.area'); 
  
  
     
     Route::get('/recurso/area/4.2', 'RecursoController@RecursoEvaluacion')->name('recurso.area_4.2');
     Route::get('/recurso/area/4.1', 'RecursoController@RecursoArea')->name('recurso.area_4.1');
     Route::put('/recurso/{id}/update_competencia', 'RecursoController@UpdateCompetencia')->name('recurso.update_competencia');
     Route::resource('/recurso', 'RecursoController');

     
     Route::get('/usuario/area', 'ReporteController@Usuario')->name('usuario.area');
     Route::get('/operacion/area', 'OperacionController@Operacion')->name('operacion.area');

});




//RUTAS COORDINADOR ADMINISTRADOR////////////////////////////////////////////////////////////////

Route::group(['middleware' => 'admin'], function () {   //RUTAS ENCRIPTADAS USO ADMINISTRADOR
    
    Route::resource('/competencia_categoria', 'TipoCompetenciaController')->except([  
          'show'
    ]);
    Route::resource('/competencia', 'CompetenciaController')->except([  
          'show'                                                                             //SECCIÓN OPERACIONES Y COMPETENCIAS
    ]);
    Route::get('/operacion/administrador', 'OperacionController@Operacion')->name('operacion.administrador');
     
    
    
    Route::put('usuario/{id}/store_asignar', 'UsuarioController@StoreAsignarLista')->name('usuario.store_lista');
    Route::put('usuario/{id}/eliminar_lista', 'UsuarioController@EliminarLista')->name('usuario.eliminar_lista');
    Route::get('usuario/{id_coordinador}/{id_academia}/{academia}/ListaAsignar','UsuarioController@ListaAsignar')->name('usuario.equipo_lista');
    Route::get('usuario/{id_coordinador}/{id_academia}/{academia}/{coordinador}ListaEliminar','UsuarioController@ListaEliminar')->name('usuario.equipo_lista_e');
    Route::get('usuario/informacion/{id}','UsuarioController@informacion')->name('usuario.informacion');
    Route::put('usuario/{id}/updatepassword','UsuarioController@updatepassword')->name('usuario.updatepassword');
    Route::get('usuario/{id}/resetpassword', 'UsuarioController@resetpassword')->name('usuario.resetpassword');   //SECCIÓN COORDINADORES
    Route::get('usuario/administrador/5.2', 'UsuarioController@Resguardo')->name('usuario.administrador_5.2');
    Route::get('usuario/administrador/5.1', 'UsuarioController@UsuariosRegistrados')->name('usuario.administrador_5.1');   
    Route::get('/usuario/administrador', 'UsuarioController@Usuario')->name('usuario.administrador');
    
    Route::get('/reporte/administrador/4.5', 'ReporteController@Filtro2')->name('reporte.administrador_4.5');
    Route::get('/reporte/administrador/4.4', 'ReporteController@Filtro1')->name('reporte.administrador_4.4');    //SECCION FORMATOS Y REPORTES
    Route::get('/reporte/administrador/4.3', 'ReporteController@EstatusBaja')->name('reporte.administrador_4.3');
    Route::get('/formato/administrador/4.2', 'FormatoController@Formato')->name('formato.administrador_4.2');
    Route::get('/reporte/administrador/4.1', 'ReporteController@Reporte')->name('reporte.administrador_4.1');
    Route::get('/formato_reporte/administrador', 'FormatoController@FormatoReporteAdministrador')->name('formato_reporte.administrador'); 

    
    Route::resource('marca', 'MarcaController')->except([  
          'show','index'
   ]);
    Route::resource('tipo_equipo', 'TipoEquipoController')->except([ 
          'show','index'
   ]);

    Route::post('equipo/{opc}/{estatus}/Tabla_Academia/Categoria_Busqueda','EquipoController@TablaAcademiaBusquedaCategoria')
    ->name('equipo.tabla_abc');
    Route::post('/equipo/{opc}/{estatus}/Tabla_Academia/Busqueda', 'EquipoController@TablaAcademiaBusqueda')->name('equipo.tabla_ab');
    Route::post('/equipo/{opc}/{estatus}/Tabla_Academia/Categoria', 'EquipoController@TablaAcademiaCategoria')->name('equipo.tabla_ac');
    Route::post('/equipo/{opc}/{estatus}/Tabla_Academia', 'EquipoController@TablaAcademia')->name('equipo.tabla_a');
    Route::post('/equipo/{estatus}/Combobox_AcademiaCategoria', 'EquipoController@ComboboxAcademiaCategoria')->name('equipo.combobox_ac');
    Route::post('/equipo/Combobox_Instalacion','EquipoController@ComboboxInstalacion')->name('equipo.combobox_i');
    Route::get('/tipo_equipo/administrador/3.6',   'TipoEquipoController@TipoEquipoAdministrador')->name('tipo_equipo.administrador_3.6');
    Route::get('/marca/administrador/3.5',   'MarcaController@MarcaAdministrador')->name('marca.administrador_3.5');  
    Route::get('/equipo/administrador/3.4', 'EquipoController@RestaurarAdministrador')->name('equipo.administrador_3.4');   //SECCION EQUIPOS
    Route::get('/equipo/administrador/3.3', 'EquipoController@ListaBajaAdministrador')->name('equipo.administrador_3.3');
    Route::get('/equipo/administrador/3.2', 'EquipoController@ListaConcentrado')->name('equipo.administrador_3.2');
    Route::get('/equipo/administrador/3.1', 'EquipoController@EquiposRegistradosAdministrador')->name('equipo.administrador_3.1');
    Route::get('/equipo/administrador',  'EquipoController@EquipoAdministrador')->name('equipo.administrador');

   Route::get('/instalacion_categoria/administrador', 'TipoInstalacionController@CategoriaAdministrador')->name('instalacion_categoria.administrador'); 
   Route::resource('/instalacion_categoria', 'TipoInstalacionController')->except([                              //SECCION CATEGORIA DE INSTALACIÓN
          'index'
   ]);
   
   Route::post('/instalacion/importar', 'InstalacionController@Importar')->name('instalacion.importar');
   Route::get('/instalacion/administrador', 'InstalacionController@InstalacionAdministrador')->name('instalacion.administrador'); //SECCION INSTALACIONES
   Route::resource('/instalacion', 'InstalacionController')->except([      
          'index'
   ]);                                                                                                     


   Route::resource('/academia', 'AcademiaController')->except([      //SECCION ACADEMIAS
          'show'
   ]);

  Route::get('/home/administrador', 'HomeController@HomeAdministrador')->name('home.administrador');   // HOME ADMINISTRADOR

  
});

//RUTAS COORDINADOR AREA-ADMINISTRADOR///////////////////////////////////////////
 Route::resource('/usuario', 'UsuarioController')->except([
          'show','index'
 ]);
  

  Route::delete('/reporte/{id}', 'ReporteController@Eliminar')->name('reporte.eliminar');
  Route::post('/reporte/subir', 'ReporteController@Subir')->name('reporte.subir');
  Route::post('/reporte/{estatus}/{tipo}/generar', 'ReporteController@Generar')->name('reporte.generar');

  Route::post('equipo/{opc}/{estatus}/Tabla_Instalacion/Categoria_Busqueda','EquipoController@TablaInstalacionBusquedaCategoria')
    ->name('equipo.tabla_ibc');
  Route::post('/equipo/{opc}/{estatus}/Tabla_Instalacion/Busqueda', 'EquipoController@TablaInstalacionBusqueda')->name('equipo.tabla_ib');
  Route::post('/equipo/{opc}/{estatus}/Tabla_Instalacion/Categoria', 'EquipoController@TablaInstalacionCategoria')->name('equipo.tabla_ic');
  Route::post('/equipo/{opc}/{estatus}/Tabla_Instalacion', 'EquipoController@TablaInstalacion')->name('equipo.tabla_i');
  Route::post('/equipo/{estatus}/Combobox_InstalacionCategoria', 'EquipoController@ComboboxInstalacionCategoria')->name('equipo.combobox_ic');

  Route::put('/equipo/restaurar', 'EquipoController@Restaurar')->name('equipo.restaurar');
  Route::put('/equipo/baja_lista', 'EquipoController@BajaLista')->name('equipo.baja_lista');
  Route::post('/equipo/importar', 'EquipoController@Importar')->name('equipo.importar');

  Route::get('/equipo/instrucciones', 'EquipoController@Instrucciones')->name('equipo.instrucciones'); 
  Route::get('/equipo/{id}/baja','EquipoController@Baja')->name('equipo.baja');
  Route::get('/equipo/{id}/caracteristicas','EquipoController@Caracteristicas')->name('equipo.caracteristicas');

  Route::resource('/equipo', 'EquipoController')->except([  
          'index'
  ]);

  Route::resource('formato', 'FormatoController')->except([  
          'index','show'
  ]);

 
////////////////////////////////////////////////////////////////////////////////7





