<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\tipo_competencia;
use DB;
use Validator;

class TipoCompetenciaController extends Controller
{
    


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $categoria = tipo_competencia::get();
        return view('admin.TipoCompetencia',['categoria'=>$categoria]);
    }

  
    public function create()
    {
        return view('admin.CrearTipoCompetencia');
    }


    public function store(Request $request)
    {
    
       $request->validate([
            'TipoCompetencia'=>'required|max:50|unique:TipoCompetencia',
            'Objetivo'=> 'max:400',
       ]);
      
      $categoria = new tipo_competencia([
        'TipoCompetencia' => $request->get('TipoCompetencia'),
        'Objetivo'=> $request->get('Objetivo'),
      ]);

      $categoria ->save();
      return redirect('/competencia_categoria')->with('success', 'La categoria de competencia '.$request->get('TipoCompetencia').' se ha agregado correctamente');
    }

 
    public function edit($id)
    {
        
        $categoria = tipo_competencia::find($id);
        return view('admin.EditarTipoCompetencia',['categoria'=>$categoria]);
    }


    public function update(Request $request, $id)
    {

       $request->validate([
            'TipoCompetencia'=>'required|max:50|unique:TipoCompetencia,TipoCompetencia,'.$request->get('TipoCompetencia').',TipoCompetencia|',
            'Objetivo'=> 'max:400',
       ]);


      $categoria = tipo_competencia::find($id);
      $categoria->TipoCompetencia = $request->get('TipoCompetencia');
      $categoria->Objetivo = $request->get('Objetivo');
      $categoria->save();

      return redirect('/competencia_categoria')->with('success', 'La categoria de competencia se ha actualizado exitosamente');
    }

    public function destroy($id)
    {
        $categoria = tipo_competencia::find($id);
        $nombre = $categoria->TipoCompetencia;
        $categoria->delete();
        return redirect('/competencia_categoria')->with('success','La categoria de competencia "'.$nombre.'" se ha eliminado exitosamente');
         
    }
}
