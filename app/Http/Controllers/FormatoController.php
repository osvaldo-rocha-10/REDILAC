<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
//Modelos
use App\Models\formato;
use App\Models\academia;

//Librerias.
use DB;
use Auth;


/* 1.-Controlador => Formato*/
 
/* 2.-Tipo:CRUD.*/

/*
   3.-Funciones => 
    [FormatoReporteAdministrador() => GET,
     FormatoReporteArea() => GET,
     FormatoReporteDocente() => GET,
     Formato() => GET,
     index() => GET,
     create() => GET,
     store(Request $request) => POST,
     edit($id) => GET,
     update($Request $request, $id) => PUT,
     destroy($id) => DELETE,
     ]
*/

class FormatoController extends Controller
{
    
     /*Middelware login.*/
     public function __construct(){
        $this->middleware('auth');
    }
    
    /*[Tipo    => GET.
      Función  => FormatoReporteAdministrador.
      Retorna  => La vista "admin/FormatoReporte."
   ]*/ 
     public function FormatoReporteAdministrador(){   
           return view('admin.FormatoReporte');
    }

   /*[Tipo     => GET.
      Función  => FormatoReporteArea.
      Retorna  => Un objeto "academia" hacia la vista "coordinador_area/FormatoReporte."
   ]*/ 
    public function FormatoReporteArea(){

          /*Consulta para obtener el area a la que pertenece un coordinador*/
           $academia = academia::nombre(Auth::user()->Academias_idAcademia)->first();
           
           return view('coordinador_area.FormatoReporte',['Academia'=>$academia]);
    }

    /*[Tipo    => GET.
      Función  => FormatoReporteDocente.
      Retorna  => La vista "coordinador_doecente/FormatoReporte."
   ]*/ 
    public function FormatoReporteDocente(){

        return view('coordinador_docente.FormatoReporte');
        
    }

    /*[Tipo    => GET.
      Función  => Formato.
      Retorna  => Un objeto "formato" hacia la vista "admin/Formato."
    ]*/ 
   
    public function Formato(){
        /*Consulta para obtener los formatos que pertenecen al area del coordinador*/
        $formato = formato::where('Academias_idAcademia',Auth::user()->Academias_idAcademia)->get();
        return view('admin.Formato',['formato'=>$formato]);
    }

    /*[Tipo    => GET.
      Función  => index.
      Retorna  => Un objeto "formato" hacia la vista "admin/Formato."
    ]*/ 

    public function index()
    {
         $formato = formato::leftjoin('Academias','idAcademia','=','Formatos.Academias_idAcademia')->get();

         return view('admin.Formato',['formato'=>$formato]);
    }

    /*[Tipo    => GET.
      Función  => create.
      Retorna  => La vista "admin/CrearFormato."
    ]*/ 
   
    public function create()
    {
        return view('admin.CrearFormato');
    }

  /* [Tipo    => POST.
      Función => store.
      Acción  => Crea una nuevo formato.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la ruta con nombre "/formato".
   ]*/

    public function store(Request $request)
    {
        if ($request->hasFile('Formato')){
              $file = $request->file('Formato');
              $nombre_formato = $file->getClientOriginalName();    /*Crea el archivo en la ruta Almacenamientos/Formatos/...*/
              $file->move(public_path().'/Almacenamiento/Formatos/',$nombre_formato);
            
               $date = new \DateTime();
            
              /*Crea el objeto formato*/
               $formato = new formato([
                    'Formato' => $nombre_formato,
                    'Fecha'=> $date->format('Y-m-d H:i:s'),
                    'Academias_idAcademia' => Auth::User()->Academias_idAcademia,
              ]);
             $formato->save(); /*Guarda la información en la tabla Formatos*/
              return redirect('/formato')->with('success', 'El Formato Especifico:  ['.$nombre_formato.'] se ha agregado correctamente');
         }else
                return redirect('/formato');
         
    }

    /*[Tipo    => GET.
      Función  => Obtiene el registro de una formato.
      Retorna  => Los objetos  "Nombre","Extension","idFormato" hacia la vista "admin/EditarFormato".
    ]*/ 
    public function edit($id)
    {
       /*Consulta para obtener los atributos de un formato mediante su identificador*/
        $formato = formato::find($id);

        /*Separa Nombre y Extension del archivo Formato*/
        $Nombre = pathinfo($formato->Formato, PATHINFO_FILENAME); 
        $Extension = pathinfo($formato->Formato, PATHINFO_EXTENSION);

        return view('admin.EditarFormato',['Nombre'=>$Nombre,'Extension'=>$Extension,'idFormato'=>$formato->idFormatos]);
    }

 
    /*[Tipo   => PUT.
      Función => update.
      Acción  => Actualiza y valida un formato.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la ruta con nombre "/formato".
   ]*/
    public function update(Request $request, $id)
    {
       
        $request->validate([
           'Formato'=>'required|max:50|',  /*Reglas de campos*/

       ]);

        /*Consulta para obtener los atributos de un formato mediante su identificador*/
         $formato = formato::find($id);

        if(file_exists(public_path().'/Almacenamiento/Formatos/'.$formato->Formato)){

          /*Actualiza en la tabla formatos y renombra el nombre en la ruta  Almacenamiento/Formatos/...*/

          $NuevoNombre = $request->get('Formato').'.'.$request->get('Extension');
          rename (public_path().'/Almacenamiento/Formatos/'.$formato->Formato,     
          public_path().'/Almacenamiento/Formatos/'.$NuevoNombre);
          $formato->Formato = $NuevoNombre;
          $formato->save();


          return redirect('/formato')->with('success', 'El Formato-Especifico se ha actualizado correctamente');
       }else
           return redirect('/formato')->with('error', 'Error  al Editar el Nombre de Formato-- ['.$formato->Formato.'] el Formato no existe');


      
    }

   /*[Tipo    => DELETE.
      Función  => destroy.
      Acción   => Elimina un formato.
      Retorna  => Una función de tipo "with" mediante un mensaje success hacia la ruta con nombre "/formato".
   ]*/
    public function destroy($id)
    {
            /*Consulta para obtener los atributos de un formato mediante su identificador*/
           $formato = formato::find($id);
           $nombre_formato = $formato->Formato;

           /*Obtenemos archivo de la ruta*/
           $archivo_formato = public_path().'/Almacenamiento/Formatos/'.$nombre_formato; 
           

           if(file_exists($archivo_formato)){
               unlink($archivo_formato);  /*Elimina el  archivo de la ruta Almacenamiento/Formatos/...*/
           }

          $formato->delete(); /*Elimina una formato en la tabla Formatos*/

          return redirect('/formato')->with('success', 'El Formato-Especifico ['.$nombre_formato.'] se ha eliminando correctamente');
    }
}
