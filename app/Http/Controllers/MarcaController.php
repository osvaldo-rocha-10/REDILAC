<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\marca;
use DB;

class MarcaController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index()
    {
         $marca = marca::all();
         return view('admin.Marca',['marca'=>$marca]);
    }

    public function MarcaAdministrador(){
          $marca = marca::all();
         return view('admin.Marca',['marca'=>$marca]);
    }
    public function MarcaArea(){
          $marca = marca::all();
         return view('admin.Marca',['marca'=>$marca]);
    }

    public function create()
    {
          return view('admin.CrearMarca');
    }

    public function store(Request $request)
    {
      $request->validate([
           'Marca'=>'required|max:50|unique:Marca|',

       ]);


      $marca = new Marca([
        'Marca' => $request->get('Marca'),
      ]);

      $marca->save();

       return redirect('/marca/administrador/3.5')->with('success', 'la Marca de Equipo:  ['.$request->get('Marca').'] se ha agregado correctamente.');
    }


    public function edit($id)
    {
         $marca = marca::find($id);
         return view('admin.EditarMarca',['marca'=>$marca]);
    }


    public function update(Request $request, $id)
    {
        $marca = marca::find($id);

        $request->validate([
          'Marca'=>'required|max:50|unique:Marca,Marca,'.$marca->Marca.',Marca|',
         ]);
      
 
        $marca->Marca= $request->get('Marca');
        $marca->save();
       
     return redirect('/marca/administrador/3.5')->with('success', 'La marca de equipo se ha actualizado correctamente.');
    }

    public function destroy($id)
    {
         $marca = marca::find($id);
         $nombre = $marca->Marca;
         $marca->delete();
          return redirect('/marca/administrador/3.5')->with('success', 'La marca ['.$nombre.'] se ha eliminando correctamente.');
    }
}
