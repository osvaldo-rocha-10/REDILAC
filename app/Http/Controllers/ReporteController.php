<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Exports\InstalacionCategoriaExport;
use App\Exports\AcademiaCategoriaExport;

use App\Models\reporte;
use App\Models\formato;
use App\Models\academia;
use App\Models\instalacion;
use App\Models\tipo_equipo;
use App\Models\equipo;
use App\User;
use Auth;
use PDF;
use DB;

class ReporteController extends Controller
{
  

    public function __construct()
    {
        $this->middleware('auth');
    }
    
     public function Reporte(){
       $reporte = reporte::leftjoin('Coordinador','idCoordinador','=','Reportes.Coordinador_idCoordinador')
                          ->where('Coordinador.Academias_idAcademia',Auth::user()->Academias_idAcademia)->get();
        return view('admin.Reporte',['reporte'=>$reporte]);
     }
    
    public function EstatusBaja(){

        if(Auth::user()->TipoUsuario==1){
              $academia = academia::all();
              return view('admin/ReporteEstatusBaja',['academia'=>$academia]);
        }else{
              $id_a = Auth::user()->Academias_idAcademia;
              $academia = academia::nombre($id_a)->first();
              $instalacion = instalacion::where('Academia_idAcademia',Auth::user()->Academias_idAcademia)->get();

              return view('coordinador_area/ReporteEstatusBaja',
                ['academia'=>$academia,
                 'instalacion'=>$instalacion,
                 'id_a'=> $id_a,
               ]);
        }
            
    }
    public function Filtro1(){
        
         if(Auth::user()->TipoUsuario==1){
              $academia = academia::all();
              return view('admin/ReporteFiltro1',['academia'=>$academia]);
        }else{
              $id_a = Auth::user()->Academias_idAcademia;
              $academia = academia::nombre($id_a)->first();
              $instalacion = instalacion::where('Academia_idAcademia',Auth::user()->Academias_idAcademia)->get();

              return view('coordinador_area/ReporteFiltro1',
                ['academia'=>$academia,
                 'instalacion'=>$instalacion,
                 'id_a'=> $id_a,
               ]);
        }
    }
    public function Filtro2(){
           $academia = academia::all(); 
           return view('admin/ReporteFiltro2',['academia'=>$academia]);
    }
    public function Subir(Request $request){
        if ($request->hasFile('Reporte')){
              $file = $request->file('Reporte');
              $nombre_reporte = $file->getClientOriginalName();
              $file->move(public_path().'/Almacenamiento/Reportes/',$nombre_reporte);
            
               $date = new \DateTime();

               $reporte = new reporte([
                    'Reporte' => $nombre_reporte,
                    'Fecha'=> $date->format('Y-m-d H:i:s'),
                    'Tipo' => "SN/T",
                    'Coordinador_idCoordinador' => Auth::User()->idCoordinador ,
              ]);
              $reporte->save();

              return redirect('/reporte')->with('success', 'El Reporte:  ['.$nombre_reporte.'] se ha agregado correctamente');
         }else
                return redirect('/reporte');
    }

    public function Eliminar($id){
           $reporte = reporte::find($id);
           $nombre_reporte= $reporte->Reporte;
           $archivo_reporte = public_path().'/Almacenamiento/Reportes/'.$nombre_reporte;
           
           if(file_exists($archivo_reporte)){
               unlink($archivo_reporte);
           }
          $reporte->delete();
         
          return redirect('/reporte')->with('success', 'El Reporte ['.$nombre_reporte.'] se ha eliminando correctamente');
    }


 
   private function Validar($categoria,$busqueda){

     if(isset($categoria)){ 

         if(isset($busqueda))
                 return 3;    //Existe categoria y busqueda
         else
                 return 2;    //Existe categoria.

      }else if(isset($busqueda))
             return 1;       //Existe busqueda      
       else
             return 0;       //No existe ni categoria ni busqueda. 

   }

   private function AcademiaCategoria($reporte,$academia,$categoria,$busqueda,$estatus,$opc){

        $_date = new \DateTime();
        $_academia = academia::nombre($academia)->first();
        $_valida = $this->Validar($categoria,$busqueda);

      
        switch ($_valida) {

          case 0:  $equipo  = equipo::area($estatus,$academia); 

          case 1:  $equipo  = equipo::area_busqueda($estatus,$busqueda,$academia); break;
                  
          case 2:  $equipo  = equipo::area_categoria($categoria,$estatus,$academia);
                             $categoria = tipo_equipo::nombre($categoria)->first(); break;

          case 3:  $equipo  = equipo::area_busqueda_categoria($estatus,$categoria,$busqueda,$academia); 
                             $categoria = tipo_equipo::nombre($categoria)->first(); break;
        }


  if($opc==0){
         $equipo = $equipo->get();
         $pdf = PDF::loadView('Reportes.ReporteEquipoCoordinador',
                           ['equipo'=>$equipo,
                            'academia' =>$_academia->Academia,
                            'reporte' =>$reporte,
                            'tipo' => $categoria,
                            'fecha'=>$_date->format('Y-m-d'),
                            'tipo_reporte'=> 2,
                            'estatus' => $estatus,
                        ])
          ->setPaper('a4','landscape');
       return $pdf;
   }else
       return $equipo;
 }
  

   private function InstalacionCategoria($reporte,$academia,$instalacion,$categoria,$busqueda,$estatus,$opc){
        $_date = new \DateTime();
        $_instalacion = instalacion::nomenclatura($instalacion)->first();
        $_academia = academia::nombre($academia)->first();
        $_valida = $this->Validar($categoria,$busqueda);

      
        switch ($_valida) {

          case 0:  $equipo  = equipo::instalacion($estatus,$instalacion); 

          case 1:  $equipo  = equipo::instalacion_busqueda($estatus,$busqueda,$instalacion); break;
                  
          case 2:  $equipo  = equipo::instalacion_categoria($categoria,$estatus,$instalacion);
                             $categoria = tipo_equipo::nombre($categoria)->first(); break;

          case 3:  $equipo  = equipo::instalacion_busqueda_categoria($estatus,$categoria,$busqueda,$instalacion); 
                             $categoria = tipo_equipo::nombre($categoria)->first(); break;
        }


  if($opc==0){
         $equipo = $equipo->get();
         $pdf = PDF::loadView('Reportes.ReporteEquipoCoordinador',
                           ['equipo'=>$equipo,
                            'academia' =>$_academia->Academia,
                            'reporte' =>$reporte,
                            'tipo' => $categoria,
                            'instalacion'=> $_instalacion->Nomenclatura,
                            'fecha'=>$_date->format('Y-m-d'),
                            'tipo_reporte'=> 1,
                            'estatus' => $estatus,
                        ])
          ->setPaper('a4','landscape');
       return $pdf;
   }else
       return $equipo;
   }
   
 

   public  function Generar(Request $request,$estatus,$tipo){

         $reporte   = $request->get('reporte');
         $academia  = $request->get('academia');
         $categoria = $request->get('categoria');
         $busqueda = $request->get('busqueda');
         $archivo = $reporte. ".pdf";
        
         switch ($tipo) {
           case 1:  if($request->post('pdf'))
                        return $this->AcademiaCategoria($reporte,$academia,$categoria,$busqueda,$estatus,0)->download($archivo);
                    else if ($request->post('excel')){
                        $equipo = $this->AcademiaCategoria($reporte,$academia,$categoria,$busqueda,$estatus,1);
                        return (new AcademiaCategoriaExport($equipo,$reporte))->download($reporte.'.xlsx');
                    }else if($request->post('guardar')){
                        $date = new \DateTime();
                        $r= new reporte([
                          'Reporte' => $archivo,
                          'Fecha' => $date->format('Y-m-d H:i:s'),
                          'Tipo' => "-",
                          'Coordinador_idCoordinador' => Auth::User()->idCoordinador,
                       ]);
                        $r->save();
                        file_put_contents(public_path().'/Almacenamiento/Reportes/'.$archivo,
                        $this->AcademiaCategoria($reporte,$academia,$categoria,$busqueda,$estatus,0)->output());

                         return redirect('/reporte')->with('success', 'El Reporte ['.$archivo.'] se ha guardado correctamente');

                    }else if($request->post('imprimir'))
                        return $this->AcademiaCategoria($reporte,$academia,$categoria,$busqueda,$estatus,0)->stream($archivo);
                       
                  break;
           case 2:  $instalacion = $request->get('instalacion');
                    if($request->post('pdf'))
                        return $this->InstalacionCategoria($reporte,$academia,$instalacion,$categoria,$busqueda,$estatus,0)
                               ->download($archivo);
                    else if ($request->post('excel')){
                         $equipo = $this->InstalacionCategoria($reporte,$academia,$instalacion,$categoria,$busqueda,$estatus,1);
                        return (new InstalacionCategoriaExport($equipo,$reporte))->download($reporte.'.xlsx');

                    }else if($request->post('guardar')){
                        $date = new \DateTime();
                        $r= new reporte([
                          'Reporte' => $archivo,
                          'Fecha' => $date->format('Y-m-d H:i:s'),
                          'Tipo' => "-",
                          'Coordinador_idCoordinador' => Auth::User()->idCoordinador,
                       ]);
                        $r->save();
                        file_put_contents(public_path().'/Almacenamiento/Reportes/'.$archivo,
                        $this->InstalacionCategoria($reporte,$academia,$instalacion,$categoria,$busqueda,$estatus,0)->output());

                        return redirect('/reporte')->with('success', 'El Reporte ['.$archivo.'] se ha guardado correctamente');

                    }else if($request->post('imprimir'))
                        return $this->InstalacionCategoria($reporte,$academia,$instalacion,$categoria,$busqueda,$estatus,0)->stream($archivo);

                   break;
         }

   }

   
}
