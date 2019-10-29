<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Modelos
use App\Models\equipo;
use App\Models\tipo_equipo;
use App\Models\tipo_instalacion;
use App\Models\instalacion;
use App\Models\caracteristicas_equipo;
use App\Models\coordinador_equipo;
use App\Models\marca;
use App\Models\academia;
use App\Models\historial;
use App\Models\galeria;

//Librerias
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use App\Imports\EquipoImport;
use App\Imports\HistorialImport;
use App\Imports\CaracteristicasImport;
use DB;
use Auth;

/* 1.-Controlador => Equipo*/
 
/* 2.-Tipo:CRUD.*/

/*
   3.-Funciones => 
    [EquipoAdministrador() => GET,
     EquipoArea() => GET,
     EquipoDocente() => GET,
     EquiposResguardoDocente() => GET,
     Crear_Editar_Observacion($id) => GET ,
     Update_Observacion(Request $request,$id) => PUT,
     EquiposRegistradosAdministrador() => GET,
     EquiposRegistradosArea() => GET,
     ListaConcentrado() => GET,
     Instrucciones() => GET,
     ListaBajaAdministrador() => GET,
     ListaBajaArea() => GET,
     Importar() => POST,
     show($id) => GET ,
     Caracteristicas($id) => GET,
     RestaurarAdministrador() => GET,
     RestaurarArea() => GET,
     create() => GET,
     store(Request $request) => POST,
     edit($id) => GET,
     Baja($id) => GET ,
     update(Request $request) =>  PUT,
     destroy($id)   DELETE,
     BajaLista($id) => PUT,
     Restaurar(Request $request) => PUT,
     Tabla($opc,$equipo) => POST,
     ComboboxAcademiaCategoria(Request $request, $estatus) => POST,
     ComboxInstalacion(Request $request,$estatus) => POST,
     ComboxInstalacionCategoria(Request $request) => POST,
     TablaAcademia(Request $request, $opc, $estatus) => POST,
     TablaAcademiaCategoria(Request $request, $opc, $estatus) => POST,
     TablaAcademiaBusqueda(Request $request,$opc, $estatus) => POST,
     TablaAcademiaBusquedaCategoria(Request $request, $opc, $estatus) => POST,
     TablaInstalacion(Request $request, $opc, $estatus) => POST ,
     TablaInstalacionCategoria(Request $request, $opc, $estatus) => POST ,
     TablaInstalacionBusquedaCategoria(Request $request, $opc, $estatus) => POST,
     ]
*/

class EquipoController extends Controller
{
    
    //Encabezados de las diferentes columnas para la importación de equipos desde un archivo excel.
    protected $encabezado = ['NOINVENTARIO','TIPO_EQUIPO','SERIE','MODELO','INSTALACION'];

    
    //Middelware login.
    public function __construct(){
        $this->middleware('auth');
        HeadingRowFormatter::default('none');
    }

      
   /*[Tipo    => GET.
      Función => EquipoAdministrador.
      Retorna => La vista "admin/Equipo."
   ]*/ 
    public function EquipoAdministrador(){

      return view('admin.Equipo');

    }
          
   /*[Tipo    => GET.
      Función => EquipoArea.
      Retorna => Un objeto "academia" hacia la vista "coordinador_area/Equipo."
   ]*/
    public function EquipoArea(){
        /*Consulta para obtener la academia a la  que pertenecen a un coordinador*/
        $academia = academia::select('Academia')->where('idAcademia',Auth::user()->Academias_idAcademia)->first();
        return view('coordinador_area.Equipo',['Academia'=>$academia]);
    }

  /*  [Tipo    => GET.
      Función => EquipoDocente.
      Retorna => La vista "coordinador_docente/Equipo."
   ]*/
    public function EquipoDocente(){
       return view('coordinador_docente.Equipo');
    }

    /*[Tipo   => GET.
      Función => EquiposResguardoDocente.
      Retorna => Un objeto "equipo" hacia la vista "coordinador_docente/EquiposResguardo."
   ]*/
    public function EquiposResguardoDocente(){

       /*Consulta para obtenter los equipos con status ALTA que pertenecen a un un coordinador docente*/
       $equipo  = coordinador_equipo::where('Coordinador_idCoordinador',Auth::user()->idCoordinador)
                     ->equipo()
                     ->whereIn('Equipos_NoInventario',function($query){
                          $query->select('Equipos.NoInventario')
                          ->from('Equipos')
                          ->leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                          ->where('Historial.Estatus',1);
        })->get();

       return view('coordinador_docente.EquiposResguardo',['equipo'=>$equipo]);

    }
    
    /*[Tipo   => GET.
      Función => Crear_Editar_Observación.
      Retorna => Un objeto  "equipo" hacia la vista "coordinador_docente/Observación."
   ]*/
    public function Crear_Editar_Observacion($id){
          /*Consulta para obtener las columnas Observacion2 y NoInventario mediante su identificador de equipo "NoInventario"*/
          $equipo = equipo::select('Observacion2','NoInventario')->where('NoInventario',$id)->first();

          return view('coordinador_docente.Observacion',['equipo'=>$equipo]);
    }
    

    /*[Tipo   => PUT.
      Función => Update_Observacion.
      Acción  => Actualiza y valida el campo observacion.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la ruta con nombre "/equipo/docente/1.1".
   ]*/
    public function Update_Observacion(Request $request,$id){
      $request->validate([
           'Observacion'=>'max:400',  /*Reglas de campos*/
          ],
      );

     $equipo = equipo::find($id);  
     $equipo->Observacion2 = $request->get('Observacion');  /*Actualiza el campo Observacion2 en la tabla Equipos*/
     $equipo->save(); /*Guarda la información en la tabla equipo*/

       return redirect('/equipo/docente/1.1')
              ->with('success', 'Su solicitud se ha completado con exito.');
  
    }

    /*[Tipo   => GET.
      Función => EquiposRegistradosAdministrador.
      Retorna => Los objetos "equipo", "total" ,"TotalEquipos y los arrays => ["tipo_instalacion","tipos de equipo"], 
      hacia la vista admin/EquiposRegistrados."
   ]*/    
    public function EquiposRegistradosAdministrador(){

        /*Consulta para obtener todos los equipos con estatus "ALTA"*/
         $equipo = equipo::
         leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','TipoEquipo_idTipo')
        ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
        ->where('Historial.Estatus',1)
        ->get();
         
        $tipo_equipo = tipo_equipo::select('Categoria','CA')->get();
        $total = historial::where('Estatus', 1)->exists();
        $total_equipos = historial::where('Estatus', 1)->count();

        $tipo_instalacion = array(); /*array tipo_instalacion con uso exclusivo hacia la vista EquiposRegistrados*/

        foreach ($equipo as $equipos){
         //Consulta para obtener las categorias de instalacion por equipo.
          $tipo = tipo_instalacion::select('Categoria')->where('idTipo',$equipos->TipoInstalacion_idTipo)->first();

          array_push($tipo_instalacion,$tipo);
        }
        
         
         return view('admin.EquiposRegistrados',['equipo'=>$equipo,'Total'=>$total,'TipoInstalacion'=>$tipo_instalacion,'TipoEquipo'=>$tipo_equipo,'TotalEquipos'=>$total_equipos]);
    }

     /*[Tipo   => GET.
      Función => EquiposRegistradosArea.
      Retorna => Los objetos equipo,."
    ]*/ 
    public function EquiposRegistradosArea(){
         //Consulta para obtener todos los equipos por area a la que pertenece el coordinador.
         $equipo = equipo::
         leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','TipoEquipo_idTipo')
        ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
        ->where('Historial.Estatus',1)
        ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia)
        ->get();
         
        //Consulta para obtener todas las categorias y caracteristicas adicionales.
        $tipo_equipo = tipo_equipo::select('Categoria','CA')->get();

       //Consulta para obtener el total de equipos con estatus "ALTA" del area a la  que peertenece el coordinador.
        $total_equipos =  equipo:: leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                  ->where('Historial.Estatus',1)
                                  ->whereIn('Instalaciones_idInstalacion',function($query){
                                              $query->select('Instalaciones.idInstalacion')
                                             ->from('Instalaciones')
                                             ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia);
                                          })->count();

        $tipo_instalacion = array(); /*array tipo_instalacion con uso exclusivo hacia la vista EquiposRegistrados*/

        foreach ($equipo as $equipos){
          //Consulta para obtener las categorias de instalacion por equipo.
          $tipo = tipo_instalacion::select('Categoria')->where('idTipo',$equipos->TipoInstalacion_idTipo)->first();
          array_push($tipo_instalacion,$tipo);
        }
        
         
         return view('coordinador_area.EquiposRegistrados',['equipo'=>$equipo,'TipoInstalacion'=>$tipo_instalacion,'TipoEquipo'=>$tipo_equipo,'TotalEquipos'=>$total_equipos]);
    }

    /*[Tipo   => GET.
      Función => ListaConcentrado.
      Retorna => La vista "admin/EquipoListaConcentrado."
   ]*/
    public function ListaConcentrado(){
          return view('admin.EquipoListaConcentrado'); 
    }

    /*[Tipo   => GET.
      Función => Instrucciones.
      Retorna => La vista "admin/InstruccionesEquipo."
   ]*/
    public function Instrucciones(){
        return view('admin.InstruccionesEquipo'); 
    }
    
   /*[Tipo   => GET.
      Función => ListaBajaAdministrador.
      Retorna => El objeto academia hacia La vista "admin/InstruccionesEquipo."
   ]*/

    public function ListaBajaAdministrador(){
        /*Consulta para obtener todas las academias*/
         $academia = academia::all();  
         return view('admin/EquipoListaBaja',['academia'=>$academia]);
    }
    
    /*[Tipo   => GET.
      Función => ListaBajaArea.
      Retorna => Los objetos insyalacion y academia hacia la vista coordinador_area/EquipoListaBaja.
   ]*/
    public function ListaBajaArea(){

         /*Consulta para obtener las instalaciones  mediante su area a la que pertenece el coordinador*/
         $instalacion = instalacion::where('Academia_idAcademia',Auth::user()->Academias_idAcademia)->get();

         /*Consulta para obtener la  academia a la que pertenece el cordinador*/
         $academia = academia::select('Academia')->where('idAcademia',Auth::user()->Academias_idAcademia)->first();

         return view('coordinador_area/EquipoListaBaja',['instalacion'=>$instalacion,'academia'=>$academia]);
    }


    /*[Tipo   => POST.
      Función => Importar.
      Accion  =>  Valida la importación del formato excel.
      Retorna =>  Una función de tipo "with" mediante un mensaje success hacia el controlador  @EquipoController y la función ListaConcentrado."
    ]*/
    public function Importar(Request $request){
        $Archivo = $request->file('Excel');
        $Excel = (new HeadingRowImport)->toArray($Archivo);
        $Nombre = $Archivo->getClientOriginalName();

       /*Valida encabezados mediante el arreglo declarado como protegido al inicio de la clase*/
        for ($i=0; $i < count($Excel); $i++) { 

            if(count($Excel[$i][0])==5){
                $k=0;
                 for ($j=0; $j < count($Excel[$i][0]); $j++) { 
                      if($Excel[$i][0][$j]!=$this->encabezado[$k]){
                      
                          if($Excel[$i][0][$j]=="")
                                    
                                  return redirect()->action('EquipoController@ListaConcentrado')->with('Error', 'Se encontraron encabezados vacios en su archivo '.$Nombre.' verifique!');    
                          else
                             return redirect()->action('EquipoController@ListaConcentrado')->with('Error', 'Encabezado '.$Excel[$i][0][$j].' desconocido en archivo '.$Nombre.' verifique!');
                       }
                      
                  $k++;
               }

            }else
               return redirect()->action('EquipoController@ListaConcentrado')->with('Error', 'Longitud invalida de encabezados en su archivo :'.$Nombre.' verifique.!');
        }
     
        /* Importa el archivo a una nueva clase EquipoImport localizada en la ruta app/Imports/ */
        $import = new EquipoImport();
       
         try {
                  $import->import($Archivo);
         } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                   $datas = ($import)->toArray($Archivo); 
                   $failures = $e->failures();  /*Regresa los errores de validación por filas y columnas del formato excel*/

                   return redirect()->action('EquipoController@ListaConcentrado')->with(['failures'=>$failures]);
            
        }
       
        /*Utiliza las clases adicionales HistorialImport y CaracteristicasImport localizadas en la ruta app/Imports*/
        (new HistorialImport)->import($Archivo);
        (new CaracteristicasImport)->import($Archivo);

      
        return redirect()->action('EquipoController@ListaConcentrado')->with('success', 'Sus datos se han importado de manera correcta.!');
   
    }
    /*[Tipo   => GET.
      Función => show.
      Acción  => Visualiza el historial de un equipo.
      Retorna => "Un objeto "historial" hacia la vista admin/HistorialEquipo.
   ]*/
    public function show($id){   
       /*Consulta para obtener el historial de un equipo por su id "NoInventario" */
        $historial = historial::where('Equipos_NoInventario',$id)->first(); 
        return view('admin.HistorialEquipo',['Historial'=>$historial]);
    }
    
     /*[Tipo   => GET.
      Función => Caracterisiticas.
      Acción  => Visualiza las caracteristicas de un equipo.
      Retorna => Un objeto "equipo" hacia la vista "admin/CaracteristicasAdicionales.".
   ]*/
    public function Caracteristicas($id){  
        /*Consulta para obtener las caracteristicas de un equipo" */
        $equipo = caracteristicas_equipo::find($id);

        return view('admin.CaracteristicasAdicionales',['equipo'=>$equipo]);
    }

     /*[Tipo   => GET.
       Función => RestaurarAdministrador
       Retorna => Los objeto "equipo", "TipoEquipo", "TotalEquipos" y el array => ["TipoInstalacion"] hacia la vista "admin/EquiposRestaurar."
   ]*/
    public function RestaurarAdministrador(){

        /*Consulta para obtener todos los equipos con estatus BAJA*/
         $equipo = equipo::
         leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','TipoEquipo_idTipo')
        ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
        ->where('Historial.Estatus',0)
        ->get();
         
        $tipo_equipo = tipo_equipo::select('Categoria','CA')->get();                  
        $total_equipos = historial::where('Estatus', 0)->count();

        $tipo_instalacion = array(); /*array tipo_instalacion con uso exclusivo hacia la vista EquipoRestaurar*/

        foreach ($equipo as $equipos){
          /*Consulta para obtener las categorias de instalacion por equipo*/
          $tipo = tipo_instalacion::select('Categoria')->where('idTipo',$equipos->TipoInstalacion_idTipo)->first();

          array_push($tipo_instalacion,$tipo);
        }
        
         
         return view('admin.EquipoRestaurar',['equipo'=>$equipo,'TipoInstalacion'=>$tipo_instalacion,'TipoEquipo'=>$tipo_equipo,'TotalEquipos'=>$total_equipos]);         
    }

     /*[Tipo   => GET.
       Función => RestaurarArea
       Retorna => Los objetos "equipo","tipo_equipo","TotalEquipos",y el array =>["tipo_instalacion"] hacia la vista admin/EquipoRestaurar.
   ]*/
    public function RestaurarArea(){

        /*Consulta para obtener todos los equipos de un area/academia con estatus baja*/
          $equipo = equipo::
         leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','TipoEquipo_idTipo')
        ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
        ->where('Historial.Estatus',0)
        ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia)
        ->get();
         
        $tipo_equipo = tipo_equipo::select('Categoria','CA')->get();

        /*Consulta para obtener el total de equipos del area a la que pertenece el coordinador */    

        $total_equipos = equipo:: leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                  ->where('Historial.Estatus',0)
                                  ->whereIn('Instalaciones_idInstalacion',function($query){
                                              $query->select('Instalaciones.idInstalacion')
                                             ->from('Instalaciones')
                                             ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia);
                                          })->count();

        $tipo_instalacion = array(); /*array tipo_instalacion con uso exclusivo hacia la vista EquipoRestaurar*/

        foreach ($equipo as $equipos){
          /*Consulta para obtener las categorias por equipo mediante su identificador*/
          $tipo = tipo_instalacion::select('Categoria')->where('idTipo',$equipos->TipoInstalacion_idTipo)->first();

          array_push($tipo_instalacion,$tipo);
        }
        
         
         return view('admin.EquipoRestaurar',['equipo'=>$equipo,'TipoInstalacion'=>$tipo_instalacion,'TipoEquipo'=>$tipo_equipo,'TotalEquipos'=>$total_equipos]); 
    }

    
   /*[Tipo    => GET.
     Función => create.
     Retorna => Los objetos "TipoEquipo","Instalacion","Marca" hacia la vista "admin/CrearEquipo".
   ]*/

    public function create(){
       /*Consulta para obtener todas las categorias de equipo.*/
       $tipo_equipo= tipo_equipo::all();

       /*Consulta para obtener todas las marcas.*/
       $marca = marca::all();

      /*Valida el tipo de usuario para obtener los campos instalacion y Nomenclatura por area a la que pertenece el coordinador o de manera general. */
       if(Auth::user()->TipoUsuario==1)
             $instalacion = instalacion::select('idInstalacion','Nomenclatura')->get();
       else
             $instalacion = instalacion::select('idInstalacion','Nomenclatura')->where('Academia_idAcademia',Auth::user()->Academias_idAcademia)->get();
       

        return view('admin.CrearEquipo',['TipoEquipo'=>$tipo_equipo,'Instalacion'=>$instalacion ,'Marca'=>$marca]);
    }

    
   /* [Tipo    => POST.
      Función => store.
      Acción  => Crea una nuevo equipo.
      Retorna => Una función de tipo redirect hacia el controlador @EquipoController hacia la funcion EquiposRegistradosAdministrador y una función "with" mediante un mensaje success".
   ]*/ 

    public function store(Request $request)        
    {
      $request->validate([
           'TipoEquipo'=>'required|',
           'Instalacion'=>'required|',
           'NoInventario' =>'required|numeric|digits_between:0,9|unique:Equipos',
           'Serie'=>'nullable|alpha_dash|min:3|max:50|',
           'Modelo'=>'nullable|alpha_dash|min:3|max:50|',    /*Reglas de campos*/
           'Observacion1' => 'nullable|max:500|',

           'NomenclaturaBuap'=> 'nullable|alpha_dash|min:7|max:50|unique:Equipos|',
           'idProducto'=>'nullable|alpha_dash|min:3|max:50|',
           'Procesador' => 'nullable|min:3|max:100|',
          ],
      );

      
       /*Crea el objeto equipo*/
        $equipo = new equipo([
        'TipoEquipo_idTipo' => $request->get('TipoEquipo'),
        'Instalaciones_idInstalacion' => $request->get('Instalacion'),
        'NoInventario' => $request->get('NoInventario'),
        'Serie' => $request->get('Serie'),
        'Modelo' => $request->get('Modelo'),
        'Marca_idMarca' => $request->get('Marca'),
        'Observacion1' => $request->get('Observacion1'),
        'Disponible' => 0,
        'TipoAdquisicion' => $request->get('TipoAdquisicion'),  
      ]);
      $equipo->save(); /*Guarda la información en la tabla equipos*/

     $data = tipo_equipo::select('CA')->where('idTipo',$request->get('TipoEquipo'))->first();
     
     /*Crea el objeto caracteristicas*/

     if($data->CA==1){
        $caracteristicas_equipo = new caracteristicas_equipo([
        'Equipos_NoInventario' => $request->get('NoInventario'),
        'NomenclaturaBuap' => $request->get('NomenclaturaBuap'),
        'idProducto' => $request->get('idProducto'),
        'SistemaOperativo' => $request->get('SistemaOperativo'),
        'TipoSistema' => $request->get('TipoSistema'),
        'MemoriaRam' => $request->get('MemoriaRam'),
        'Capacidad' => $request->get('Capacidad'),
        'Procesador' => $request->get('Procesador'),  
      ]);
      $caracteristicas_equipo->save(); /*Guarda la información en la tabla caracteristicas*/
     }

      $date = new \DateTime(); 

     /*Crea el objeto historial*/
      $historial = new historial([
          'Equipos_NoInventario' => $request->get('NoInventario'),
          'Alta' => $date->format('Y-m-d H:i:s'),      
          'Estatus' => 1,
          'Registro' => 1,
      ]);

      $historial->save(); /*Guarda la información en la tabla historial*/

    if(Auth::user()->TipoUsuario==1)
       return redirect()->action('EquipoController@EquiposRegistradosAdministrador')->with('success', 'El equipo con No.Inventario ['.$request->get('NoInventario').'] se ha registrado correctamente');
     else
        return redirect()->action('EquipoController@EquiposRegistradosArea')->with('success', 'El equipo con No.Inventario ['.$request->get('NoInventario').'] se ha registrado correctamente');

    }

    /*[Tipo   => GET.
      Función => edit.
      Acción  => Obtiene el registro de una equipo.
      Retorna => Los objetos "equipo", "TipoEquipo","Instalacion"  y "marca" hacia la vista "admin/EditarEquipo".
    ]*/

    public function edit($id){   
        /*Consulta para obtener la informacion de un equipo mediante su identificador "NoInventario"*/
        $equipo = equipo::
          leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','TipoEquipo_idTipo')
        ->where('NoInventario',$id)
        ->first();

        /*Consulta para obtener todas las caracteristicas de equipo*/
        $tipo_equipo = tipo_equipo::all();
      
       /*Consulta para obtener todas las instalaciones*/
        $instalacion = instalacion::all();

        /*Consulta para obtener todas las marcas*/
        $marca =  marca::all();

        return view('admin.EditarEquipo',['equipo'=>$equipo,'TipoEquipo'=>$tipo_equipo,'Instalacion'=>$instalacion,'Marca'=>$marca]);
    }

    /*[Tipo   => GET.
      Función => Baja.
      Acción  => Actualiza un equipo a estatus BAJA.
      Retorna => Una función de tipo redirect hacia el controlador @EquipoController hacia la funcion EquiposRegistradosAdministrador y una función "with" mediante un mensaje success".
    ]*/
    public function Baja($id){   
           $date = new \DateTime();
           $historial = historial::find($id);
           $historial->Baja = $date->format('Y-m-d H:i:s');    /*Actualiza el campo Baja con la fecha actual en la tabla historial*/ 
           $historial->Estatus = 0;
           $historial->save();  /*Guarda la información en la tabla historial*/

          if(Auth::user()->TipoUsuario==1)
            return redirect()->action('EquipoController@EquiposRegistradosAdministrador')->with('success', 'El equipo:  ['.$id.'] se ha dado de baja temporalmente');
          else
            return redirect()->action('EquipoController@EquiposRegistradosArea')->with('success', 'El equipo:  ['.$id.'] se ha dado de baja temporalmente'

          );
   }


    /*[Tipo   => PUT.
      Función => update
      Acción  => Actualiza y valida un equipo.
      Retorna =>  Una función de tipo redirect hacia el controlador @EquipoController hacia la funcion EquiposRegistradosAdministrador/EquiposRegistradosArea y una función "with" mediante un mensaje success".
   ]*/

   public function update(Request $request, $id){
        $request->validate([
           'TipoEquipo'=>'required|',
           'Instalacion'=>'required|',
           'NoInventario' =>'required|numeric|digits_between:0,11|unique:Equipos,NoInventario,'.$id.',NoInventario|',
           'Serie'=>'nullable|alpha_dash|min:3|max:50|',         /*Reglas de campos*/
           'Modelo'=>'nullable|alpha_dash|min:3|max:50|',
           'Observacion1' => 'nullable|max:500|',

           'NomenclaturaBuap'=> 'nullable|alpha_dash|min:7|max:50|unique:Equipos,NomenclaturaBuap,'.$request->get('NomenclaturaBuap').',NomenclaturaBuap|',
           'idProducto'=>'nullable|alpha_dash|min:3|max:50|',
           'Procesador' => 'nullable|min:3|max:100|',
          ],
      );
     
      
      $equipo = equipo::find($id);
      $equipo->TipoEquipo_idTipo = $request->get('TipoEquipo'); 
      $equipo->Instalaciones_idInstalacion = $request->get('Instalacion');
      $equipo->NoInventario = $request->get('NoInventario'); 
      $equipo->Serie = $request->get('Serie');                             /*Actualiza los campos en la tabla equipo*/
      $equipo->Modelo= $request->get('Modelo');
      $equipo->TipoAdquisicion= $request->get('TipoAdquisicion');
      $equipo->Observacion1= $request->get('Observacion1');
      $equipo->save();

      if($request->get('CA')==1){
           $caracteristicas = caracteristicas_equipo::find($id);
           $caracteristicas->Equipos_NoInventario =  $request->get('NoInventario');
           $caracteristicas->NomenclaturaBuap =  $request->get('NomenclaturaBuap');
           $caracteristicas->idProducto =  $request->get('idProducto');              /*Actualiza los campos en la caracteristicas*/
           $caracteristicas->SistemaOperativo =  $request->get('SistemaOperativo');
           $caracteristicas->TipoSistema =  $request->get('TipoSistema');
           $caracteristicas->MemoriaRam =  $request->get('MemoriaRam');
           $caracteristicas->Capacidad =  $request->get('Capacidad');
           $caracteristicas->Procesador =  $request->get('Procesador');
           $caracteristicas->save();
      }

      
      $date = new \DateTime();
      $historial = historial::find($id);
      $historial->Edita = $date->format('Y-m-d H:i:s');    /*Actualiza el campo historial con la fecha actual en la tabla historial*/
      $historial->save();
        
        if(Auth::user()->TipoUsuario==1)
           return redirect()->action('EquipoController@EquiposRegistradosAdministrador')->with('success', 'El equipo  se ha actualizado correctamente');
        else
           return redirect()->action('EquipoController@EquiposRegistradosArea')->with('success', 'El equipo  se ha actualizado correctamente');

    }

    /*[Tipo    => DELETE.
      Función  => destroy.
      Acción   => Elimina un equipo
      Retorna  => Una función de tipo redirect hacia el controlador @EquipoController hacia la funcion EquiposRegistradosAdministrador/EquiposRegistradosArea y una función "with" mediante un mensaje success"..
    ]*/
    public function destroy($id){  
        /*Consulta para obtener los atributos de un equipo mediante su identificador*/ 
        $equipo = equipo::find($id);
        $NoInventario = $equipo->NoInventario;
        $equipo->delete();    /*Elimina un equipo en la tabla Equipos*/


        if(Auth::user()->TipoUsuario==1)
        return redirect()->action('EquipoController@EquiposRegistradosAdministrador')->with('success', 'El equipo con No.Inventario:  ['.$NoInventario.'] se ha eliminado correctamente del sistema.');
        else
           return redirect()->action('EquipoController@EquiposRegistradosArea')->with('success', 'El equipo con No.Inventario:  ['.$NoInventario.'] se ha eliminado correctamente del sistema.');
    }

    
   /*[Tipo   => PUT.
      Función => BajaLista.
      Acción  => Obtiene un array de equipos mediante "checkbox" para editar el estatus  BAJA.
      Retorna =>  Una función de tipo redirect hacia el controlador @EquipoController hacia la funcion ListaBajaAdministrador/ListaBajaArea y una función "with" mediante un mensaje success".
   ]*/
   public function BajaLista(Request $request){
         $equipo = $request->get('equipo');  /*Array "checkbox"*/
         $no_inventarios="";
         $date = new \DateTime();

         foreach ($equipo  as $equipos ) {

                   $historial = historial::find($equipos);
                   $historial->Baja= $date->format('Y-m-d H:i:s');
                   $historial->Estatus = 0;      /*Actualiza el historial con status BAJA por equipo*/
                   $historial->save();

                if ($equipos=== end($equipo))
                    $no_inventarios.=$equipos;
                else
                    $no_inventarios.=$equipos.",";     
         }

       if(Auth::user()->TipoUsuario==1)
            return redirect()
                  ->action('EquipoController@ListaBajaAdministrador')
                  ->with('success', 'Los equipos con No.Inventario['.$no_inventarios.']  se han dado de baja exitosamente.');
       else 
          return redirect()
                ->action('EquipoController@ListaBajaArea')
                ->with('success', 'Los equipos con No.Inventario['.$no_inventarios.']  se han dado de baja exitosamente.');

   }

    /*[Tipo   => PUT.
      Función => Restaurar.
      Acción  => Obtiene un array de equipos mediante "checkbox" para editar el estatus ALTA.
      Retorna =>  Una función de tipo redirect hacia el controlador @EquipoController hacia la funcion ListaBajaAdministrador/ListaBajaArea y una función "with" mediante un mensaje success".
   ]*/
    public function Restaurar(Request $request){ 
         $equipo = $request->get('equipo'); /*Array "checkbox"*/
         $no_inventarios="";
         $date = new \DateTime();

         foreach ($equipo  as $equipos ) {

                   $historial = historial::find($equipos);
                   $historial->Baja = NULL;
                   $historial->Estatus = 1;   /*Actualiza el historial con status ALTA por equipo*/
                   $historial->save();

                if ($equipos=== end($equipo))
                    $no_inventarios.=$equipos;
                else
                    $no_inventarios.=$equipos.",";     
         }

          if(Auth::user()->TipoUsuario==1)
            return redirect()
                  ->action('EquipoController@RestaurarAdministrador')
                  ->with('success', 'Los equipos con No.Inventario['.$no_inventarios.']  se han restaurado exitosamente.');
         else 
          return redirect()
                ->action('EquipoController@RestaurarArea')
                ->with('success', 'Los equipos con No.Inventario['.$no_inventarios.']  se han restaurado exitosamente.');

    }

     

    /*[Tipo   => private.
      Función => Tabla.
      Acción  => Selecciona mediante una opcion pasado como parametro, el tipo de tabla a seleccionar. TABLA1/TABLA2
      Retorna => El codigo HTML mediante una cadena con formato de TABLA .
   ]*/

    private function Tabla($opc,$equipo){
       $existe=false;
      /*Tabla  1*/
       if($opc==1){
           $salida ='
                <table >
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>TipoEquipo</th>
                      <th>NoInventario</th>
                      <th><center>Baja Temporal </center> </th>
                    </tr>
                  </thead>                                                   
                  <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>TipoEquipo</th>
                      <th>NoInventario</th>
                      <th><center>Baja Temporal </center></th>
                    </tr>
                  </tfoot>
                 <tbody>'
                   
                 ;


            
            foreach ($equipo  as $equipos ) {
                  $existe = true;

                  $salida.='
                     <tr>
                         <td>'.$equipos->Categoria.'</td>
                         <td>'.$equipos->NoInventario.'</td>
                         <td><center><input type="checkbox" name ="equipo[]" value="'.$equipos->NoInventario.'" style="width: 30px; height: 20px;"></center></td>
                     </tr>
                  ';
              }
             $salida .='</tbody>
                      </table>  
                   ';
          }else{
             /*Tabla  2*/
             $salida ='
             
             <table>
                  <thead style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>TipoEquipo</th>
                      <th>NoInventario</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Observacion1</th>
                      <th>Observacion2</th>
                    </tr>
                  </thead>
                   <tfoot style="background :#003b5c; color: #00b5e2;">
                    <tr>
                      <th>TipoEquipo</th>
                      <th>NoInventario</th>
                      <th>Serie</th>
                      <th>Modelo</th>
                      <th>Observacion1</th>
                      <th>Observacion2</th>
                    </tr>
                  </tfoot>
                 <tbody>
                    '
                 ;

           
            foreach ($equipo  as $equipos ) {
                  $existe = true;

                  $salida.='
                     <tr>
                         <td>'.$equipos->Categoria.'</td>
                         <td>'.$equipos->NoInventario.'</td>
                         <td>'.$equipos->Serie.'</td>
                         <td>'.$equipos->Modelo.'</td>
                         <td>'.$equipos->Observacion1.'</td>
                         <td>'.$equipos->Observacion2.'</td>
                     </tr>
                  ';
              }
             $salida .='</tbody>
                      </table>  

                   ';
          }

          if($existe)
            return $salida;
      
    }

    /*[Tipo    => POST.
      Función => ComboboxAcademiaCategoria.
      Acción  => Crea un combobox mediante Ajax.
      Retorna => El codigo HTML mediante una cadena con formato de select option.
   ]*/
    public function ComboboxAcademiaCategoria(Request $request,$estatus){  

          $academia = $request->get('value'); /*Obtiene academia*/

          $existe = false;  
          /*Consulta para obtener todas las categorias de equipo mediante su area 
           NOTA: utiliza scope-consulta "categoria_area" en el modelo tipo_equipo*/
          $categoria = tipo_equipo::categoria_area($estatus,$academia)->get();
       
            $salida =  '<option value="" >CATEGORIA</option>';

            foreach ($categoria as $row) {
              $existe = true;
              $salida.='<option value="'.$row->idTipo.'" data-categoria ="'.$row->Categoria.'">'.$row->Categoria.'</option>';
           }

         if($existe)
             echo $salida;
    }

    /*[Tipo    => POST.
      Función => TablaAcademia.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
   ]*/

    public function TablaAcademia(Request $request,$opc,$estatus){ 

          $academia = $request->get('value');  /*Obtiene academia*/

           /*Consulta para obtener todos los equipos mediante su area 
           NOTA: utiliza scope-consulta "area" en el modelo equipo*/
          $equipo  = equipo::area($estatus,$academia)->get();

          echo $this->Tabla($opc,$equipo);   
    }

   /*[Tipo    => POST.
      Función => TablaAcademiaCategoria.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
   ]*/

    public function TablaAcademiaCategoria(Request $request,$opc,$estatus){ 

        $categoria = $request->get('value_categoria');  /*Obtiene categoria*/
        $academia  = $request->get('value_academia');   /*Obtiene academia*/

        /*Consulta para obtener los equipos por categoria mediante su area
          NOTA: utiliza scope-consulta "area_categoria" en el modelo equipo*/
        $equipo    = equipo::area_categoria($categoria,$estatus,$academia)->get();

        echo $this->Tabla($opc,$equipo);
    }
    
    /*[Tipo    => POST.
      Función => TablaAcademiaBusqueda.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
   ]*/

    public function TablaAcademiaBusqueda(Request $request,$opc,$estatus){   
            
          $academia = $request->get('value_academia');  /*Obtiene academia*/
          $busqueda = $request->get('busqueda');       /*Obtiene busqueda*/

           /*Consulta para obtener los equipos por area mediante su busqueda
          NOTA: utiliza scope-consulta "area_busqueda" en el modelo equipo*/
          $equipo  = equipo::area_busqueda($estatus,$busqueda,$academia)->get();

          echo $this->Tabla($opc,$equipo);
    }

     /*[Tipo    => POST.
      Función => TablaAcademiaBusquedaCategoria.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
    ]*/

    public function TablaAcademiaBusquedaCategoria(Request $request,$opc,$estatus){ 
        $categoria = $request->get('value_categoria');  /*Obtiene categoria*/
        $busqueda = $request->get('busqueda');  /*Obtiene busqueda*/
        $academia = $request->get('value_academia');  /*Obtiene academia*/


       /*Consulta para obtener los equipos por area mediante su busqueda y categoria.
       NOTA: utiliza scope-consulta "area_busqueda_categoria" en el modelo equipo*/
        $equipo  = equipo::area_busqueda_categoria($estatus,$categoria,$busqueda,$academia)->get();

        echo $this->Tabla($opc,$equipo);
        
    }
    
      /*[Tipo    => POST.
       Función => ComboboxInstalacion.
       Acción  =>Crea un combobox mediante Ajax .
       Retorna => El codigo HTML mediante una cadena con formato de select option..
      ]*/

    public function ComboboxInstalacion(Request $request){
           $id_academia = $request->get('value_academia'); /*Obtiene identificador de academia*/
           $existe  = false;
           $academia = $request->get('academia'); /*Obtiene academia*/

           /*Consulta para obtener las instalaciones que pertenecen a la academia*/
           $instalacion = instalacion::where('Academia_idAcademia',$id_academia)->get();

           $salida =  '<option value="" >INSTALACIÓN /'.$academia.'</option>';

           foreach ($instalacion as $row) {
              $existe = true;
              $salida.='<option value="'.$row->idInstalacion.'" data-instalacion ="'.$row->Nomenclatura.'">'.$row->Nomenclatura.'</option>';
           }

           if($existe)
               echo $salida;
    }

      /*[Tipo    => POST.
       Función => ComboboxInstalacionCategoria.
       Acción  =>Crea un combobox mediante Ajax .
       Retorna => El codigo HTML mediante una cadena con formato de select option..
      ]*/

    public function ComboboxInstalacionCategoria(Request $request,$estatus){  
          $instalacion = $request->get('instalacion'); /*Obtiene instalacion*/
          $existe = false;
          /*Consulta para obtener las categorias de equipoen base a su instalacion
           NOTA: utiliza scope-consulta "categoria_instalacion" en el modelo tipo_equipo
           */
          $categoria = tipo_equipo::categoria_instalacion($estatus,$instalacion)->get();

          $salida =  '<option value="" >CATEGORIA</option>';

           foreach ($categoria as $row) {
              $existe = true;
              $salida.='<option value="'.$row->idTipo.'" data-categoria ="'.$row->Categoria.'">'.$row->Categoria.'</option>';
           }

        if($existe)
              echo $salida;
    }

    /*[Tipo    => POST.
      Función => TablaInstalacion.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
    ]*/
    public function TablaInstalacion(Request $request,$opc,$estatus){
        $instalacion = $request->get('instalacion'); /*Obtiene instalacion*/

        /*Consulta para obtener todos los equipos que pertenecen a una instalacion
          NOTA: utiliza scope-consulta "instalacion" en el modelo equipo.
        */
        $equipo  = equipo::instalacion($estatus,$instalacion)->get();

        echo $this->Tabla($opc,$equipo);
    }
    
    /*[Tipo    => POST.
      Función => TablaInstalacionCategoria.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
    ]*/

    public function TablaInstalacionCategoria(Request $request,$opc,$estatus){
        $categoria = $request->get('categoria'); /*Obtiene categoria*/
        $instalacion = $request->get('instalacion');  /*Obtiene instalacion*/

         /*Consulta para obtener todos los equipos que pertenecen a una categoria de instalacion
          NOTA: utiliza scope-consulta "instalacion_categoria" en el modelo equipo.
         */

        $equipo  = equipo::instalacion_categoria($categoria,$estatus,$instalacion)->get();

         echo $this->Tabla($opc,$equipo);
    }

     /*[Tipo    => POST.
      Función => TablaInstalacionBusqueda.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
    ]*/

    public function TablaInstalacionBusqueda(Request $request,$opc,$estatus){
          $instalacion = $request->get('instalacion'); /*Obtiene instalación*/
          $busqueda = $request->get('busqueda');  /*Obtiene la busqueda*/

          /*Consulta para obtener todos los equipos que pertenecen a una instalacion mediante su busqueda
          NOTA: utiliza scope-consulta "instalacion_categoria" en el modelo equipo.
         */
          $equipo  = equipo::instalacion_busqueda($estatus,$busqueda,$instalacion)->get();

          echo $this->Tabla($opc,$equipo);
    }
 
     /*[Tipo    => POST.
      Función => TablaInstalacionBusquedaCategoria.
      Acción  => Crea un tabla mediante ajax desde la función Tabla() .
      Retorna => El llamado de la funcion tabla.
    ]*/


    public function TablaInstalacionBusquedaCategoria(Request $request,$opc,$estatus){

        $categoria = $request->get('categoria'); /*Obtiene categoria*/
        $busqueda = $request->get('busqueda');  /*Obtiene busqueda*/
        $instalacion = $request->get('instalacion'); /*Obtiene instalacion*/

        /*Consulta para obtener todos los equipos mediante categoria y busqueda*/
        $equipo  = equipo::instalacion_busqueda_categoria($estatus,$categoria,$busqueda,$instalacion)->get();

        echo $this->Tabla($opc,$equipo);
    }


}
