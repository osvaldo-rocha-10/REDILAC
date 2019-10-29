<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\recurso;
use App\Models\descripcion;
use App\Models\recurso_instalacion;
use App\Models\recurso_competencia;
use App\Models\tipo_recurso;
use App\Models\instalacion;
use App\Models\academia;
use App\Models\image;
use Auth;
use DB;
class RecursoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $academia = academia::nombre(Auth::user()->Academias_idAcademia)->first();
      return view('coordinador_area.Recurso',['academia'=>$academia]);
       
    }

    public function RecursoDocente(){
       return view('coordinador_docente.Recurso');
    }



    public function RecursoArea(){

       $recurso = recurso::area()->get();
       $instalacion = array();
       $competencia = array();

       foreach ($recurso as $recursos) {
          array_push($instalacion,recurso_instalacion::instalacion($recursos->id)->get());
          array_push($competencia,descripcion::competencias($recursos->id)->count());
       }


       return view('coordinador_area.RecursoDigital',['recurso' => $recurso,'instalacion'=>$instalacion,'competencia'=>$competencia]);  
    }

    public function show($id){

      $competencia_recurso = recurso_competencia::select('DescripcionCompetencia_NumeroCompetencia as nc')
                                               ->where('RecursosDigitales_idRecursoDigital',$id)->get();

      $competencia = descripcion::categoria()->get();

      $recurso = recurso::find($id);


          return view('coordinador_area.RecursoCompetencia',['competencia_recurso' => $competencia_recurso,'competencia'=>$competencia,'recurso'=>$recurso]);  
    }

    public function UpdateCompetencia(Request $request,$id){
         $competencia = $request->get('competencia');
         $actualizadas = $request->get('actualizadas');
         $date = new \DateTime();

         foreach ($competencia  as $competencias) {

                   $rc= new recurso_competencia([
                      'RecursosDigitales_idRecursoDigital' => $id,
                      'DescripcionCompetencia_NumeroCompetencia' => $competencias,
                  ]);
                  $rc->save();
         }



     return redirect()
                   ->action('RecursoController@RecursoArea')
                   ->with('success', 'su solicitud se ha completado exitosamente');

    }


    public function RecursoEvaluacion(){

    }



    public function create(){
        $icono =  image::orderBy('Imagen')->get();
        $categoria = tipo_recurso::orderBy('Categoria')->get();
        $instalacion = instalacion::instalacion_academia(Auth::user()->Academias_idAcademia)->get();

        return view('coordinador_area.CrearRecursoDigital',['icono'=>$icono,'categoria'=>$categoria,'instalacion'=>$instalacion]);
    }
     
    public function edit($id) {
        $recurso = recurso::image()->where('idRecursoDigital',$id)->first();
        $icono =  image::all();
        return view('coordinador_area.EditarRecursoDigital',['recurso'=>$recurso,'icono'=>$icono]);
    }

     public function store(Request $request){

        $request->validate([
           'Categoria' => 'required',
           'RecursoDigital'=>'required',
           'DescripcionRecurso' => 'nullable|max:100|',
           'Instalaciones'  => 'required',

         ]);

        if ($request->hasFile('RecursoDigital')){
              $time = time();
              $file = $request->file('RecursoDigital');
              $nombre_archivo = $file->getClientOriginalName();
              $file->move(public_path().'/Almacenamiento/RecursosDigitales/',$nombre_archivo);
         }
         
       if ($request->hasFile('Imagen1')){
              $file = $request->file('Imagen1');
              $nombre_imagen = $file->getClientOriginalName();
              $file->move(public_path().'/Almacenamiento/Iconos/',$nombre_imagen);
              $imagen = new image([
                'Imagen' => $nombre_imagen,
             ]);
             $imagen->save();
              $id_image = $imagen->idImage;

        }else if($request->filled('Imagen2')){
             $id_image = $request->get('Imagen2'); 

        }else{
             $id_image = 1;
        }


       $recurso = new recurso([
          'TipoRecurso_idTipoRecurso' => $request->get('Categoria'),
          'DescripcionRecurso' => $request->get('DescripcionRecurso'),
          'RecursoDigital'=> $nombre_archivo,
          'Image_idImage' => $id_image,
        ]);
       $recurso->save();
        

       $instalacion = $request->get('Instalaciones');

       foreach ($instalacion as $instalaciones) {
            $rc = new recurso_instalacion([
             'RecursosDigitales_idRecursoDigital' =>$recurso->idRecursoDigital,
             'Instalacion_idInstalacion' => $instalaciones,
            ]);
        $rc->save();
       }
       
        return redirect('/recurso/area/5.1')->with('success', 'El Recurso Digital -- ['.$nombre_archivo.'-- ]se ha agregado exitosamente');
      

     }

     public function update(Request $request, $id){
        $request->validate([
           'RecursoDigital'=>'required',
           'DescripcionRecurso'=>'nullable|max:100|'],
        );

        $recurso = recurso::find($id);

        if(file_exists(public_path().'/Almacenamiento/RecursosDigitales/'.$recurso->RecursoDigital)){
          $NuevoNombre = $request->get('RecursoDigital').'.'.$request->get('Extension');
          rename (public_path().'/Almacenamiento/RecursosDigitales/'.$recurso->RecursoDigital,
          public_path().'/Almacenamiento/RecursosDigitales/'.$NuevoNombre);
        }else
             return redirect('/recurso/area/5.1')->with('error', 'El recurso digital no existe');
        

       if ($request->hasFile('Imagen1')){
              $file = $request->file('Imagen1');
              $nombre_imagen = $file->getClientOriginalName();
              $file->move(public_path().'/Almacenamiento/Iconos/',$nombre_imagen);

              $imagen = new image([
                'Imagen' => $nombre_imagen,
              ]);
              $imagen->save();
              $id_image = $imagen->idImage;
        }else if($request->filled('Imagen2'))
                  $id_image = $request->get('Imagen2'); 
        else 
                $id_image  = $request->get('Actual'); 
        
        
       
      
        $recurso->DescripcionRecurso = $request->get('DescripcionRecurso');
        $recurso->RecursoDigital = $NuevoNombre;
        $recurso->Image_idImage = $id_image;
        $recurso->save();

        return redirect('/recurso/area/5.1')->with('success', 'El recurso digital se ha actualizado correctamente');
    }

    public function destroy($id){

           $recurso = recurso::find($id);
           $nombre_archivo = $recurso->RecursoDigital;
           $archivo = public_path().'/Almacenamiento/RecursosDigitales/'.$nombre_archivo;
           
           if(file_exists($archivo)){
               unlink($archivo);
           }
           $recurso->delete();

          return redirect('/recurso/area/5.1')->with('success', 'El recurso digital -- ['.$nombre_archivo.'-- ]se ha eliminado exitosamente');
    }

    
}
