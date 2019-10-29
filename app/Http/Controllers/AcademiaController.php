<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//Modelos
use App\Models\academia;
use App\Models\equipo;
use App\Models\instalacion;


//Librerias.
use App\User;
use Auth;
use DB;



/*
1.-Controlador => Academia

2.-Tipo => CRUD.

3.-Funciones => 
    [index() => GET ,
     create() => GET ,
     store(Request $request) => POST,
     edit($id) => GET,
     update(Request $request, $id) => PUT, 
     destroy($id) => DELETE
     ]
*/

class AcademiaController extends Controller
{
    
      //Middelware login.
     public function __construct()
    {
        $this->middleware('auth');

    }

   /*[Tipo    => GET.
     Función => index. 
     Retorna => Los objetos "academia","instalaciones", "equipos", "cantidad de instalaciones" , "cantidad de equipos" y los array [
     "_instalaciones",_equipos,_coordinadores_docente,_coordinadores_area] hacia la vista "admin/Academia".
   ]*/  
    public function index()
    {
        /*Consulta para obtener todas las academias*/
        $academia = academia::all(); 

        /*Consulta para obtener todas las instalaciones y sus respectivas academias.*/
        $instalacion = instalacion::   
        select('Academia_idAcademia','idInstalacion')
        ->leftjoin('Academias','idAcademia','=','Instalaciones.Academia_idAcademia')
        ->get();

        /*Consulta para obtener todos los coordinadores de todas las academias.*/
        $coordinador = User::leftjoin('Academias','idAcademia','=','Coordinador.Academias_idAcademia')->get(); 

        $_instalaciones = array(); /*array _instalaciones con uso exclusivo hacia la vista Academia*/
        $_equipos = array();   /*array equipos con uso exclusivo hacia la vista Academia*/
        $_coordinador_docente= array();  /*array coordinador_docente con uso exclusivo hacia la vista Academia*/
        $_coordinador_area = array(); /*array coordinador_area con uso exclusivo hacia la vista Academia*/

        $cantidadI = 0;
        foreach ($academia as $academias){
         /*Consulta para obtener el total de instalaciones por academia*/
          $i = instalacion::where('Academia_idAcademia',$academias->idAcademia)->count();
          array_push($_instalaciones,$i);   
          $cantidadI+=$i;
        }
        
        $cantidadE = 0;
        foreach ($academia as $academias){
            $contador = 0;
             foreach ($instalacion as $instalaciones){
                if($academias->idAcademia==$instalaciones->Academia_idAcademia){
                    /*Consulta para obtener todos los equipos de todas las academias con estatus ALTA.*/
                     $equipos = equipo::where('Instalaciones_idInstalacion',$instalaciones->idInstalacion)
                                         ->leftjoin('Historial','Equipos_NoInventario','=','Equipos.NoInventario')
                                         ->where('Historial.Estatus',1)
                                         ->count();
                    $contador+=$equipos;
                }
            
            }
          $cantidadE += $contador;
           array_push($_equipos,$contador);
        }
        

        foreach ($academia as $academias){
            /*Consulta para obtener el total de coordinadores docentes y de area.*/
            array_push($_coordinador_area, User::where('Academias_idAcademia',$academias->idAcademia)
                                                ->where(function($q){
                                                      $q->where('TipoUsuario',1)
                                                      ->orWhere('TipoUsuario',2);
                                                })->first());

            array_push($_coordinador_docente, User::where('Academias_idAcademia',$academias->idAcademia)
                                                -> where('TipoUsuario',3)->get());
         }

        return view('admin.Academia',['academia'=>$academia,'instalaciones'=>$_instalaciones,'equipos'=>$_equipos,'coordinador_area'=>$_coordinador_area,'coordinador_docente'=>$_coordinador_docente,'CantidadI'=>$cantidadI,'CantidadE'=>$cantidadE]); 
    }

  /*[Tipo    => GET.
     Función => create.
     Retorna => La vista "admin/CrearAcademia".
   ]*/  
    public function create()
    {
        return view('admin.CrearAcademia');
    }

    

  /* [Tipo    => POST.
      Función => store.
      Acción  => Crea una nueva academia.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la vista "academia".
   ]*/ 
    public function store(Request $request)
    {
       $rules= [
           'Academia'=>'required|max:50|unique:Academias|',  /*Reglas de campos*/
       ];

       $messages = [
        'Academia.required' => 'El campo Direccion/Academia es obligatorio.',
        'Academia.max' => 'El campo Direccion/Academia no debe ser mayor de 50 caracteres',  /*Mensajes exclusivos*/
        'Academia.unique' => 'El campo Direccion/Academia ya ha sido registado.',
       ];

      $this->validate($request, $rules, $messages);

     /*Crea el objeto academia*/
      $academia = new academia([
        'Academia' => $request->get('Academia'),
      ]);


      $academia->save(); /*Guarda la información en la tabla academia.*/

      return redirect('/academia')->with('success', 'Dirrección/Academia:  ['.$request->get('Academia').'] se ha agregado correctamente');
    }


   /* [Tipo   => GET.
      Función => edit.
      Acción => Obtiene el registro de una academia.
      Retorna => Un objeto  "academia" hacia la vista "admin/EditarAcademia".
   ]*/ 

    public function edit($id)
    {
        /*Consulta para obtener los atributos de una academia mediante su identificador*/
         $academia = academia::find($id); 

         return view('admin.EditarAcademia',['academia'=>$academia]);
    }


   /* [Tipo    => PUT.
      Función => update.
      Acción => actualiza y valida una academia.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la vista "academia".
   ]*/
 
    public function update(Request $request, $id)
    {
       $academia = academia::find($id);

       $rules= [
           'Academia'=>'required|max:50|unique:Academias,Academia,'.$academia->Academia.',Academia|', /*Reglas de campos*/
       ];

       $messages = [
         'Academia.unique' => 'El campo Direccion/Academia ya ha sido registado.', /*Mensajes exclusivos*/
       ];

      $this->validate($request, $rules, $messages);        
      
 
      $academia->Academia= $request->get('Academia'); /*Actualiza los campos en la tabla academia*/
      $academia->save();
       
     return redirect('/academia')->with('success', 'La Dirrección/Academia  se ha actualizado correctamente');
   
    }
    
    /*[Tipo    => DELETE.
      Función  => destroy.
      Acción   => Elimina una academia.
      Retorna  => Una función de tipo "with" mediante un mensaje success hacia la vista "academia".
   ]*/
    public function destroy($id)
    {
       /*Consulta para obtener los atributos de una academia mediante su identificador*/
        $academia = academia::find($id);
        $nombre = $academia->Academia;
        $academia->delete(); /*Elimina una academia en la tabla Academias*/
        return redirect('/academia')->with('success', 'La Dirrección/Academia ['.$nombre.'] se ha actualizado correctamente');
    }
}
