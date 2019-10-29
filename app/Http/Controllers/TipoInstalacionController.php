<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\tipo_instalacion;
use DB;


class TipoInstalacionController extends Controller
{
      public function __construct()
    {
        $this->middleware('auth');
    }

    public function CategoriaAdministrador(){
         $categoria= tipo_instalacion::all();
         return view('admin.TipoInstalacion',['categoria'=>$categoria]);
    }
    
    public function CategoriaArea(){
        $categoria= tipo_instalacion::all();
         return view('coordinador_area.TipoInstalacion',['categoria'=>$categoria]);
    }
    

    public function create()
    {
         return view('admin.CrearTipoInstalacion');
    }

    public function store(Request $request)
    {
        $request->validate([
           'Categoria'=>'required|max:50|unique:TipoInstalacion|',

       ]);

      $TipoInstalacion = new tipo_instalacion([
        'Categoria' => $request->get('Categoria'),
      ]);


      $TipoInstalacion->save();
      return redirect('/instalacion_categoria/administrador')->with('success', 'El Tipo de Instalacion:  ['.$request->get('Categoria').'] se ha agregado correctamente.');
    }


    public function edit($id)
    {
         $TipoInstalacion = tipo_instalacion::find($id);
         return view('admin.EditarTipoInstalacion',['TipoInstalacion'=>$TipoInstalacion]);
    }

    public function update(Request $request, $id)
    {
        $TipoInstalacion= tipo_instalacion::find($id);

        $request->validate([
          'Categoria'=>'required|max:50|unique:TipoInstalacion,Categoria,'.$TipoInstalacion->Categoria.',Categoria|',
         ]);
      
 
        $TipoInstalacion->Categoria= $request->get('Categoria');
        $TipoInstalacion->save();
       
     return redirect('/instalacion_categoria/administrador')->with('success', 'El tipo de instalación se ha actualizado correctamente.');
    }

    public function destroy($id)
    {
        $TipoInstalacion= tipo_instalacion::find($id);
        $nombre = $TipoInstalacion->Categoria;
        $TipoInstalacion->delete();
         return redirect('/instalacion_categoria/administrador')->with('success', 'El tipo de Instalación ['.$nombre.'] se ha eliminando correctamente.');
    }


}
