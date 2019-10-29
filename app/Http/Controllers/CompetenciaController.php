<?php

namespace App\Http\Controllers;

//Modelos
use App\Models\tipo_competencia;
use App\Models\descripcion;

use Illuminate\Http\Request;

/*
1.-Controlador => Competencia

2.-Tipo => CRUD.

3.-Funciones => 
    [index() => GET,
     create() => GET,
     store(Request $request) => POST,
     edit($id) => GET,
     update(Request $request, $id) => PUT, 
     destroy($id) => DELETE
     ]
*/


class CompetenciaController extends Controller
{
   
     //Middelware login.
     public function __construct()
    {
        $this->middleware('auth');

    }

  /*[Tipo    => GET.
     Función => index.
     Retorna => Un objeto "competencia" hacia la vista "admin/Competencia".
   ]*/
    public function index()
    {
       /*Consulta para obtener las  competencias y categorias.
        NOTA: utiliza scope-consulta "categoria" en el modelo descripción*/
        $competencia = descripcion::categoria()->get(); 
      
        return view('admin.Competencia',['competencia'=>$competencia]);
    }


   /*[Tipo    => GET.
     Función => create.
     Retorna => Un objeto "categoria" hacia la vista "admin/CrearCompetencia".
   ]*/
   
    public function create()
    {
         /*Consulta para obtener todas las categorias de competencias.*/
         $categoria = tipo_competencia::all();  
         return view('admin.CrearCompetencia',['categoria'=>$categoria]);
    }

  
  /* [Tipo    => POST.
      Función => store.
      Acción  => Crea una nueva competencia.
      Retorna => Una función de tipo redirect hacia la ruta "competencia" y una función "with" mediante un mensaje success hacia la ruta "competencia ".
   ]*/ 
    public function store(Request $request)
    {
       $request->validate([
           'NumeroCompetencia'=>'required|unique:DescripcionCompetencia|numeric|between:1,9',
           'Competencia'=>'required|max:500|',   
           'Categoria'=>'required|',      /*Reglas de campos*/
           'Disciplina'=>'required|',
       ]);

      /*Crea el objeto competencia*/
       $competencia = new descripcion([
        'NumeroCompetencia' => $request->get('NumeroCompetencia'),
        'DescripcionCompetencia' => $request->get('Competencia'),
        'TipoCompetencia_idCompetencia' => $request->get('Categoria'),  
        'Disciplina' => $request->get('Disciplina'),
      ]);
       $competencia->save(); /*Guarda la información en la tabla competencia*/
       
       return redirect('/competencia')
              ->with('success', 'El numero de competencia ['.$request->get('NumeroCompetencia').'] se ha registrado exitosamente');
    }
   
   /* [Tipo   => GET.
      Función => edit.
      Acción  => Obtiene el registro de una competencia.
      Retorna => Los objetos "competencia" y "categoria" hacia la vista "admin/EditarCompetencia".
    ]*/
    public function edit($id)
    {
        /*Consulta para obtener las competencias y categorias mediante us identificador de competencia.
        NOTA: utiliza scope-consulta "categoria" en el modelo descripción*/
        $competencia = descripcion::categoria()->where('NumeroCompetencia',$id)->first();

        /*Consulta para obtener todas las categorias de competencia*/
        $categoria = tipo_competencia::all();
        return view('admin.EditarCompetencia',['competencia'=>$competencia,'categoria'=>$categoria]);
    }

   
  /* [Tipo    => PUT.
      Función => update.
      Acción =>  Actualiza y valida una competencia.
      Retorna => Una función de tipo "with" mediante un mensaje success hacia la vista "academia".
   ]*/
    public function update(Request $request, $id)
    {
       $request->validate([
           'NumeroCompetencia'=>'required|unique:DescripcionCompetencia,NumeroCompetencia,'.$id.',NumeroCompetencia|numeric|between:1,9',
           'Competencia'=>'required|max:500|',  /*Reglas de campos*/
       ]); 

       $competencia = descripcion::find($id);
       $competencia->NumeroCompetencia = $request->get('NumeroCompetencia');
       $competencia->DescripcionCompetencia = $request->get('Competencia');      /*Actualiza los campos en la tabla competencias*/
       $competencia->TipoCompetencia_idCompetencia =  $request->get('Categoria');
       $competencia->Disciplina = $request->get('Disciplina');
       $competencia->save();
       
      return redirect('/competencia')->with('success', 'La competencia  se ha actualizado exitosamente');

    }

    /*[Tipo    => DELETE.
      Función  => destroy.
      Acción   => Elimina una competencia
      Retorna  => Una función de tipo "with" mediante un mensaje success hacia la vista "competencias".
   ]*/
    public function destroy($id)
    {
        /*Consulta para obtener los atributos de una competencia  mediante su identificador*/
        $competencia = descripcion::find($id);
        $competencia->delete(); /*Elimina una competencia en la tabla Competencias*/

       return redirect('/competencia')
              ->with('success', 'El numero de competencia ['.$id.'] se ha eliminado exitosamente');
    }
}
