<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tipo_equipo;
use DB;


class TipoEquipoController extends Controller
{
    

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function TipoEquipoAdministrador()
    {
         $categoria= tipo_equipo::all();
         return view('admin.TipoEquipo',['categoria'=>$categoria]);
    }
    public function TipoEquipoArea()
    {
         $categoria= tipo_equipo::all();
         return view('admin.TipoEquipo',['categoria'=>$categoria]);
    }
    public function create()
    {
         return view('admin.CrearTipoEquipo');
    }

    public function store(Request $request)
    {
       $request->validate([
           'Categoria'=>'required|max:50|unique:TipoEquipo|',

       ]);
       
      if($request->get('CA'))
        $marca = 1;
      else 
        $marca = 0;

      $TipoEquipo = new tipo_equipo([
        'Categoria' => $request->get('Categoria'),
        'CA' => $marca,
      ]);


      $TipoEquipo->save();
      return redirect('tipo_equipo/administrador/3.6')->with('success', 'La Categoria de Equipo:  ['.$request->get('Categoria').'] se ha agregado correctamente.');
    }


    public function edit($id)
    {
         $TipoEquipo = tipo_equipo::find($id);
         return view('admin.EditarTipoEquipo',['TipoEquipo'=>$TipoEquipo]);
    }

    public function update(Request $request, $id)
    {
        $TipoEquipo = tipo_equipo::find($id);

        $request->validate([
          'Categoria'=>'required|max:50|unique:TipoEquipo,Categoria,'.$TipoEquipo->Categoria.',Categoria|',
         ]);
      
 
        $TipoEquipo->Categoria= $request->get('Categoria');
        $TipoEquipo->save();
       
     return redirect('tipo_equipo/administrador/3.6')->with('success', 'La Categoria de Equipo se ha actualizado correctamente.');
    }

 
    public function destroy($id)
    {
        $TipoEquipo = tipo_equipo::find($id);
        $nombre = $TipoEquipo->Categoria;
        $TipoEquipo->delete();
         return redirect('tipo_equipo/administrador/3.6')->with('success', 'La CategoriaEquipo ['.$nombre.'] se ha eliminando correctamente.');
    }
}
