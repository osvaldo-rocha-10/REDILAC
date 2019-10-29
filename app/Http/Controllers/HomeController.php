<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/*Modelos*/
use App\Models\descripcion;   
use App\Models\recurso;   
use App\Models\academia;
use App\Models\instalacion;
use App\Models\recurso_instalacion;
use App\Models\coordinador_equipo;
use App\Models\equipo;
use App\Models\galeria;
use App\Models\formato;
use App\Models\reporte;

/*Librerias*/
use App\User;
use Auth;

/* 1.-Controlador => Home*/
 
/* 2.-Tipo:NORMAL.*/

/*
   3.-Funciones => 
    [ HomeAdministrador() => GET,
      HomeArea()  => GET,
      HomeDocente() => GET, 
    ]
*/


class HomeController extends Controller
{
    /*Middelware login.*/
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*[Tipo    => GET.
      Función  => HomeAdministrador.
      Acción   => Vista principal al iniciar session coordinador 1.
      Retorna  => Los  objetos "Academias","Instalaciones","Equipos","EquiposBaja","Formatos","Coordinadores","Dirreccion" hacia la vista "admin/Home."
    ]*/
    public function HomeAdministrador(){

        /*Consulta para obtener la academia/direección que pertenece el coordinador administrador*/
        $Direccion = academia::select('Academia')->where('idAcademia',Auth::user()->Academias_idAcademia)->first();

        /*Consulta para obtener el total de academias*/
        $Academias = academia::count();

        /*Consulta para obtener el total de instalaciones*/
        $instalaciones= instalacion::count();

       /*Consulta para obtener el total de equipos con estatus ALTA*/
        $Equipos = equipo::leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                          ->where('Historial.Estatus',1)
                          ->count();

        /*Consulta para obtener el total de Equipos con estatus BAJA*/
        $EquiposBaja = equipo::leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                          ->where('Historial.Estatus',0)
                          ->count();
        /*Consulta para obtener el total de formatos*/
        $Formatos = formato::count();

        /*Consulta para obtener el total de coordinadores*/
        $Coordinadores = User::count();
        
        return view('admin.Home',['Academias'=>$Academias,'instalaciones'=>$instalaciones,'Equipos'=>$Equipos,'EquiposBaja'=>$EquiposBaja,'Formatos'=>$Formatos,'Coordinadores'=>$Coordinadores,'Direccion'=>$Direccion]);
    }
   
   /*[Tipo    => GET.
      Función  => HomeArea.
      Acción   => Vista principal al iniciar session coordinador 2.
      Retorna  => Los  objetos "Academias","Instalaciones","Equipos","EquiposBaja","Formatos","Reportes","Recursos","Coordinadores" hacia la vista "coordinador_area/Home."
    ]*/

   public function HomeArea(){
         /*Consulta para obtener la academia que pertenece el coordinador de area*/
        $Academia = academia::select('Academia')->where('idAcademia',Auth::user()->Academias_idAcademia)->first();

        /*Consulta para obtener el total de instalaciones de una area*/
        $Instalaciones= instalacion::where('Academia_idAcademia',Auth::user()->Academias_idAcademia)->count();
        
         /*Consulta para obtener el total de equipos de una area*/
        $Equipos = equipo:: leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                  ->where('Historial.Estatus',1)
                                  ->whereIn('Instalaciones_idInstalacion',function($query){
                                              $query->select('Instalaciones.idInstalacion')
                                             ->from('Instalaciones')
                                             ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia);
                                          })->count();
         
         /*Consulta para obtener el total de  equipos con estatus BAJA que pertenecen a una area*/
         $EquiposBaja= equipo:: leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                  ->where('Historial.Estatus',0)
                                  ->whereIn('Instalaciones_idInstalacion',function($query){
                                              $query->select('Instalaciones.idInstalacion')
                                             ->from('Instalaciones')
                                             ->where('Instalaciones.Academia_idAcademia',Auth::user()->Academias_idAcademia);
                                          })->count();

        /*Consulta para obtener el total de formatos que pertenecen al area donde esta el coordinador*/
        $Formatos = formato::where('Academias_idAcademia',Auth::user()->Academias_idAcademia)->count();


       
        /*Consulta para obtener el total de reportes que pertenecen al area donde esta el coordinador*/
        $Reportes = reporte::whereIn('Coordinador_idCoordinador',function($query){
                                              $query->select('Coordinador.idCoordinador')
                                             ->from('Coordinador')
                                             ->where('Coordinador.Academias_idAcademia',Auth::user()->Academias_idAcademia);
                                          })->count();

       
        /*Consulta para obtener el total de recursos de una arear
         NOTA: utiliza scope-consulta "area" en el modelo recursos
        */
        $Recursos = recurso::area()->count();

       /*Consulta para obtener el total coordinadores docentes que pertenecen al area del coordinador administrador.
         NOTA: utiliza scope-consulta "area" en el modelo recursos
        */
        $Coordinadores = User::where('Academias_idAcademia',Auth::user()->Academias_idAcademia)
                              ->where('TipoUsuario',3)->count();

        return view('coordinador_area.Home',['Academia'=>$Academia,
                                             'Instalaciones'=>$Instalaciones,
                                             'Equipos'=>$Equipos,
                                             'Formatos'=>$Formatos,
                                             'Reportes'=>$Reportes,
                                             'Recursos'=>$Recursos,
                                             'Coordinadores'=>$Coordinadores,
                                             'EquiposBaja'=>$EquiposBaja]);
    }

    /*[Tipo    => GET.
      Función  => HomeDocente.
      Acción   => Vista principal al iniciar session coordinador 3.
      Retorna  => Los  objetos "Academia","Equipos","Reportes"," hacia la vista "coordinador_docente/Home."
    ]*/

    public function HomeDocente(){

        /*Consulta para obtener la academia que pertenece el coordinador de docente*/
        $Academia = academia::select('Academia')->where('idAcademia',Auth::user()->Academias_idAcademia)->first();

       /*Consulta para obtener el total de equipos que tiene a su resguardo*/
        $Equipos  = coordinador_equipo::where('Coordinador_idCoordinador',Auth::user()->idCoordinador)
                    ->whereIn('Equipos_NoInventario',function($query){
                          $query->select('Equipos.NoInventario')
                          ->from('Equipos')
                          ->leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                          ->where('Historial.Estatus',1);
        })->count();
             

        /*Consulta para obtener el total de reportes generados*/
        $Reportes = reporte::where('Coordinador_idCoordinador',Auth::user()->idCoordinador)->count();


      
        return view('coordinador_docente.Home',['Academia'=>$Academia,'Equipos'=>$Equipos,'Reportes'=>$Reportes]);
    }

    

}
