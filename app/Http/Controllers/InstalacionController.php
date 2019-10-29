<?php

namespace App\Http\Controllers;
/*Librerias*/
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use App\Imports\InstalacionImport;
use Illuminate\Http\Request;
use Auth;
use DB;

/*Modelos*/
use App\Models\instalacion;
use App\Models\recurso;
use App\Models\equipo;
use App\Models\tipo_instalacion;
use App\Models\academia;



/* 1.-Controlador => Formato*/
 
/* 2.-Tipo:CRUD.*/

/*
   3.-Funciones => 
    [  InstalacionAdministrador() => GET,
       InstalacionArea() => GET,
       create() => GET,
       store(Request $request) => POST,
       edit($id) => GET ,
       update(Request $request) => PUT,
       destroy($id) => DELETE,
       show($id) => GET,
       Importar(Request $request) => POST
    ]
*/

class InstalacionController extends Controller
{
    
    //Encabezados de las diferentes columnas para la importación de equipos desde un archivo excel.
    protected $encabezado = ['TIPO_INSTALACION', 'NOMENCLATURA', 'NOEDIFICIO','UBICACION','ACADEMIA-DIRECCION'];
     

   //Middelware login.
    public function __construct() {
        $this->middleware('auth');
         HeadingRowFormatter::default('none');
    }

   
   
    /*[Tipo   => GET.
      Función => InstalacionAdministrador.
      Retorna => Los objetos "instalacion","total","cantidad","categoria" y los arrays => ["TotalCategorias","TotalEquipos"], 
      hacia la vista admin/EquiposRegistrados."
   ]*/ 
    public function InstalacionAdministrador(){

      /*Consulta para obtener todas las instalaciones*/
        $instalacion = instalacion::
          leftjoin('Academias','idAcademia','=','Academia_idAcademia')
        ->leftjoin('TipoInstalacion','idTipo','=','TipoInstalacion_idTipo')
        ->get();
         

        $TotalEquipos = array(); /*array TotalEquipos con uso exclusivo hacia la vista Imstalacion*/
        $cantidad = 0;

        foreach ($instalacion as $instalaciones){
          /*Consulta para obtener los equipos de todas las instalaciones con estatus ALTA*/
          $equipos = equipo::leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                             ->where('Historial.Estatus',1)
                              ->where('Instalaciones_idInstalacion',$instalaciones->idInstalacion)->count();

          $cantidad+=$equipos;
          array_push($TotalEquipos,$equipos);
        }
         
         /*Consulta para obtener todas las categorias de instalacion*/
         $categoria = DB::table('TipoInstalacion')->get();

         /*array TotalCategorias con uso exclusivo hacia la vista Imstalacion*/
         $TotalCategorias = array();

          foreach ($categoria as $categorias){
         /*Consulta para el total de categorias en base a su instalacion*/
          $_instalacion = DB::table('Instalaciones')
         ->select('TipoInstalacion_idTipo')
         ->leftjoin('TipoInstalacion','idTipo','=','TipoInstalacion_idTipo')
         ->where('TipoInstalacion_idTipo',$categorias->idTipo)
         ->count();

          array_push($TotalCategorias,$_instalacion);
        }



         return view('admin.Instalacion',['instalacion'=>$instalacion,'total'=> instalacion::count(),'TotalEquipos'=>$TotalEquipos,'cantidad'=>$cantidad,'TotalCategorias'=>$TotalCategorias,'categoria'=>$categoria]);
    }

     /*[Tipo   => GET.
      Función => InstalacionArea.
      Retorna => Los objetos "instalacion","total","cantidad","categoria" y los arrays => ["TotalCategorias","TotalEquipos"], 
      hacia la vista admin/EquiposRegistrados."
    ]*/ 
    public function InstalacionArea(){
       
        /*Consulta para obtener la academia del coordinador de area.*/
        $this->id_academia = Auth::user()->Academias_idAcademia;

        /*Consulta para obtener el campo Academia del coordinador de area*/
         $academia = academia::select('Academia')->where('idAcademia',$this->id_academia)->first();


        /*Consulta para obtener las instalaciones de area */
         $instalacion = instalacion::leftjoin('TipoInstalacion','idTipo','=','TipoInstalacion_idTipo')
                                     ->where('Instalaciones.Academia_idAcademia',$this->id_academia)
                                     ->get();

        /*Consulta para obtener las categorias de instalacion de area */
         $tipo_instalacion = tipo_instalacion::whereIn('idTipo',function($query){
                                                        $query->select('Instalaciones.TipoInstalacion_idTipo')
                                                        ->from('Instalaciones')
                                                        ->where('Instalaciones.Academia_idAcademia',$this->id_academia);
                                                       }
                                                     )->get();

        /*Consulta para obtener el total de equipos por area con estatus ALTA */
         $total_equipos =  equipo::leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                        ->where('Historial.Estatus',1)
                                        ->whereIn('Instalaciones_idInstalacion',function($query){
                                              $query->select('Instalaciones.idInstalacion')
                                             ->from('Instalaciones')
                                             ->where('Instalaciones.Academia_idAcademia',$this->id_academia);
                                         })->count();

         $equipos = array();  /*array equipos con uso exclusivo hacia la vista Instalacion*/
         $categoria = array(); /*array categorias con uso exclusivo hacia la vista EquiposRegistrados*/
         $recursos = array(); /*array recursos con uso exclusivo hacia la vista EquiposRegistrados*/
      
         foreach ($instalacion as $instalaciones){
          /*Consulta para obtener el total de equipos por instalacion con estus ALTA*/
          array_push($equipos,equipo::leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                      ->where('Historial.Estatus',1)
                                      ->where('Instalaciones_idInstalacion',$instalaciones->idInstalacion)
                                      ->count());
          
          array_push($recursos,recurso::total_recursos($instalaciones->idInstalacion)->count());
         }

         foreach ($tipo_instalacion as $tipos) {
            array_push($categoria,instalacion::where('Instalaciones.Academia_idAcademia',$this->id_academia)
                                              ->where('Instalaciones.TipoInstalacion_idTipo',$tipos->idTipo)->count());
         }

         return view('coordinador_area.Instalacion',['academia'=>$academia,'instalacion'=>$instalacion,'equipos'=>$equipos,'tipo_instalacion'=>$tipo_instalacion,'categoria'=>$categoria,'total_equipos'=>$total_equipos,'recursos'=>$recursos]); 


    }
    public function create(){
        $academia = academia::all();
        $categoria = tipo_instalacion::all();

        return view('admin.CrearInstalacion',['academia'=>$academia,'categoria'=>$categoria]);
     }

    public function store(Request $request){
       $request->validate([
           'TipoInstalacion'=>'required|',
           'Nomenclatura'=>'required|min:2|max:50|unique:Instalaciones|',
           'NoEdificio' => 'nullable|max:50|',
           'Ubicacion' => 'nullable|max:50',
           'Direccion/Academia' =>'required|',

       ]);


      $instalacion = new instalacion([
        'Nomenclatura' => $request->get('Nomenclatura'),
        'NoEdificio'=> $request->get('NoEdificio'),
        'Ubicacion' => $request->get('Ubicacion'),
        'Academia_idAcademia'=>$request->get('Direccion/Academia'),
        'TipoInstalacion_idTipo'=>$request->get('TipoInstalacion'),
      ]);

      $instalacion->save();
   

      return redirect('/instalacion/administrador')->with('success', 'La instalacion:  ['.$request->get('Nomenclatura').'] se ha agregado correctamente.');
    }
    public function edit($id)
    {
        
         $academia = academia::all();
         $categoria = tipo_instalacion::all();

         $instalacion = instalacion::
         leftjoin('Academias','idAcademia','=','Academia_idAcademia')
        ->leftjoin('TipoInstalacion','idTipo','=','TipoInstalacion_idTipo')
        ->where('idInstalacion',$id)
        ->first();

       return view('admin.EditarInstalacion',['categoria'=>$categoria,'academia'=>$academia,'instalacion'=>$instalacion]);

    }
    public function update(Request $request, $id)
    {
      
        $request->validate([
           'Nomenclatura'=>'required|min:2|max:50|unique:Instalaciones,idInstalacion,'.$id.',idInstalacion|',
           'NoEdificio' => 'nullable|max:50|',
           'Ubicacion' => 'nullable|max:50',
       ]);


        $instalacion = instalacion::find($id);
        $instalacion->Nomenclatura = $request->get('Nomenclatura');
        $instalacion->NoEdificio = $request->get('NoEdificio');
        $instalacion->Ubicacion= $request->get('Ubicacion');
        $instalacion->Academia_idAcademia = $request->get('Direccion/Academia');
        $instalacion->TipoInstalacion_idTipo = $request->get('TipoInstalacion');
        $instalacion->save();
      
         return redirect('/instalacion/administrador')->with('success', 'La instalacion se ha actualizado de manera correcta.');

    }

    public function destroy($id)
    {
        $instalacion      =   instalacion::find($id);
        $TipoInstalacion  =   DB::table('TipoInstalacion')
                             ->select('Categoria')
                             ->where('idTipo',$instalacion->TipoInstalacion_idTipo)->first();

         $Nomenclatura = $instalacion->Nomenclatura;
         $Categoria  = $TipoInstalacion->Categoria;
         $instalacion->delete();

         return redirect('/instalacion/administrador/')->with('success', 'El Tipo de instalación  '.$Categoria . ' con Nomenclatura '.$Nomenclatura.' se ha eliminado correctamente.');
    }

    public function show($id){
      return view('admin.InstruccionesInstalacion',['captura'=>$id]);
    }

     public function Importar(Request $request){
  
        $Archivo = $request->file('Excel');
        $Excel = (new HeadingRowImport)->toArray($Archivo);
        $Nombre = $Archivo->getClientOriginalName();

        for ($i=0; $i < count($Excel); $i++) { 

            if(count($Excel[$i][0])==5){
                $k=0;
                 for ($j=0; $j < count($Excel[$i][0]); $j++) { 
                      if($Excel[$i][0][$j]!=$this->encabezado[$k]){
                      
                          if($Excel[$i][0][$j]=="")
                                return redirect('/instalacion/administrador')->with('Error', 'Se encontraron encabezados vacios en su archivo '.$Nombre.' verifique!');    
                          else
                             return redirect('/instalacion/administrador')->with('Error', 'Encabezado '.$Excel[$i][0][$j].' desconocido en archivo '.$Nombre.' verifique!');
                       }
                      
                  $k++;
               }



            }else
               return redirect('/instalacion/administrador')->with('Error', 'Longitud invalida de encabezados en su archivo :'.$Nombre.' verifique.!');
        }

        $import = new InstalacionImport();
       
         try {
                  $import->import($Archivo);
         } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                   $datas = ($import)->toArray($Archivo);
                   $failures = $e->failures();
                   return redirect('/instalacion')->with(['failures'=>$failures]);
            
        }

          return redirect('/instalacion/administrador')->with('success', 'Sus datos se han importado de manera correcta.!');

    }



}
