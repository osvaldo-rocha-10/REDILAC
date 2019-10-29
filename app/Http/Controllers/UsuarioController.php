<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\coordinador_equipo;
use App\Models\academia;
use App\Models\equipo;
use App\User;
use DB;

class UsuarioController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    } 
    public function Usuario()
    {
         return view('admin.Usuario');
    }

    public function UsuariosRegistrados(){

         $usuario = User::leftjoin('Academias','idAcademia','=','Academias_idAcademia')->get();
         return view('admin.UsuariosRegistrados',['usuario'=>$usuario]);
    }
    public function create()
    {
        $academia = academia::all();
        return view('admin.CrearUsuario',['academia'=>$academia]);
    }

    public function ListaAsignar($id_coordinador,$id_academia,$academia){
  
       $equipo = equipo::
                  leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
                 ->area(1,$id_academia)
                 ->where('Disponible',0)
                 ->get();

      return view('admin.UsuarioEquipoAsignar',['equipo' => $equipo,'id_coordinador'=>$id_coordinador,'academia'=>$academia]);
    }
   
      public function ListaEliminar($id_coordinador,$id_academia,$academia,$coordinador){
  
       $equipo = coordinador_equipo::leftjoin('Equipos','NoInventario','=','Equipos_NoInventario')
                                     ->leftjoin('Instalaciones','idInstalacion','=','Equipos.Instalaciones_idInstalacion')
                                     ->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                                     ->where('Coordinador_idCoordinador',$id_coordinador)
                                    ->get();

      return view('admin.UsuarioEquipoEliminar',['equipo' => $equipo,'id_coordinador'=>$id_coordinador,'academia'=>$academia,'coordinador'=>$coordinador]);
    }

    public function StoreAsignarLista(Request $request,$id){
         $equipo = $request->get('equipo');

         foreach ($equipo  as $equipos) {

                   $ce= new coordinador_equipo([
                      'Coordinador_idCoordinador'=> $id,
                      'Equipos_NoInventario' => $equipos,
                  ]);
                  $ce->save();

                  $_equipo = equipo::find($equipos);
                  $_equipo->Disponible = 1;
                  $_equipo->save();
         }

     return redirect()
                   ->action('UsuarioController@Resguardo')
                   ->with('success', 'su solicitud se ha completado exitosamente');
    }

     public function EliminarLista(Request $request,$id){
         $equipo = $request->get('equipo');

         foreach ($equipo  as $equipos) {

                  $coordinador_equipo = coordinador_equipo::find($equipos);
                  $coordinador_equipo->delete();

                  $_equipo = equipo::find($equipos);
                  $_equipo->Disponible = 0;
                  $_equipo->save();
         }

     return redirect()
                   ->action('UsuarioController@Resguardo')
                   ->with('success', 'su solicitud se ha completado exitosamente');
    }


    public function store(Request $request)
    {
         $request->validate([
            'idCoordinador'=>'required|digits_between:0,9|unique:Coordinador|',
            'Coordinador'=>'required|max:50|',
            'password' =>'required|alpha_dash|min:3|max:50|confirmed',
            'TipoCoordinador' => 'required',
            'Direccion/Academia'=>'required',
         ]);

       if ($request->hasFile('Imagen1')){
              $file = $request->file('Imagen1');
              $nombre_imagen = $file->getClientOriginalName();
              $file->move(public_path().'/Almacenamiento/Coordinadores/',$nombre_imagen);
        }else{
            $nombre_imagen="default_user.jpg";
        }

      
       $coordinador = new User([
        'idCoordinador' => $request->get('idCoordinador'),
        'Nombre'=> $request->get('Coordinador'),
        'password' => Hash::make($request->get('password')),
        'TipoUsuario'=> $request->get('TipoCoordinador'),
        'Icono' =>$nombre_imagen,
        'Academias_idAcademia' =>$request->get('Direccion/Academia'),
      ]);

      $coordinador->save();
      
      return redirect()->action('UsuarioController@UsuariosRegistrados')->with('success', 'El Coordinador con idCoordinador ['.$request->get('idCoordinador').'] se ha agregado correctamente.');
    }


    public function Resguardo()
    {
         $usuario = User::leftjoin('Academias','idAcademia','=','Coordinador.Academias_idAcademia')->get();
         $TotalEquipo = array();

         foreach ($usuario as $usuarios)
         {
              $equipos = DB::table('CoordinadorEquipo')
                         ->select('Equipos_NoInventario')
                         ->where('Coordinador_idCoordinador',$usuarios->idCoordinador)
                         ->get();
              array_push($TotalEquipo,$equipos);
          }
        return view('admin.UsuarioResguardo',['TotalEquipo'=>$TotalEquipo,'usuario'=>$usuario]); 
    }

 
  
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('admin.EditarUsuario',['usuario'=>$usuario]);
    }


    public function update(Request $request, $id)
    {
         
          $request->validate([
            'idCoordinador'=>'required|digits_between:0,9|unique:Coordinador,idCoordinador,'.$id.',idCoordinador|',
            'Coordinador'=>'required|max:50|',
         ]);
      
        $coordinador = User::find($id);
        $coordinador->idCoordinador = $request->get('idCoordinador');
        $coordinador->Nombre = $request->get('Coordinador');
        $coordinador->TipoUsuario = $request->get('TipoCoordinador');
        $coordinador->save();

          return redirect()->action('UsuarioController@UsuariosRegistrados')->with('success', 'El Coordinador se ha actualizado correctamente.');

    }
    public function resetpassword($id){
       return view('admin.ResetPassword',['id'=>$id]);
    }

    public function updatepassword(Request $request,$id){

        $request->validate([
            'password' =>'required|alpha_dash|min:3|max:50|confirmed',
         ]);
       
       $coordinador = User::find($id);
       $coordinador->password = Hash::make($request->get('password'));
       $coordinador->save();

      return redirect()->action('UsuarioController@UsuariosRegistrados')->with('success', 'La contraseña se ha restablecido de manera correcta.');

    }

    public function destroy($id)
    {
           $coordinador = User::find($id);
           $identificador = $coordinador->idCoordinador;
           $coordinador->delete();

      return redirect()->action('UsuarioController@UsuariosRegistrados')->with('success', 'El Coordinador con idCoordinador ['.$identificador.'] se ha agregado eliminado de manera exitosa.');
    }

    public function informacion($id){
          
        
         $equipo = equipo::
         leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
        ->leftjoin('Instalaciones','idInstalacion','=','Equipos.Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Equipos.Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
        ->where('Equipos.NoInventario',$id)
        ->where('Historial.Estatus',1)
        ->first();



         $instalacion = DB::table('TipoInstalacion')->select('Categoria')->where('idTipo',$equipo->TipoInstalacion_idTipo)->first();
         $academia =  DB::table('Academias')->select('Academia')->where('idAcademia',$equipo->Academia_idAcademia)->first();

         return view('admin.UsuarioInformacion',['equipo'=>$equipo,'instalacion'=>$instalacion,'academia'=>$academia]);
    }
}
