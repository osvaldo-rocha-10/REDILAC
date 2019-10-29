<?php

namespace App\Imports;

//Librerias.
use App\Models\instalacion;
use App\Models\tipo_instalacion;
use App\Models\academia;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


HeadingRowFormatter::default('none');  //Sin ningun formato establecido.


//Controlador para importacion de datos de instalaciones desde un archivo excel.
class InstalacionImport implements ToModel,WithHeadingRow,WithValidation, WithBatchInserts, WithChunkReading
{

     use Importable;
    

    public function busqueda($instalacion){

    }


    //Se especifica la importación por modelo. 
    //Función que realizara la llamada (n) veces para almacenar (n) registros.
    public function model(array $row){


        
        $instalacion = tipo_instalacion::select('idTipo')->where('Categoria',$row['TIPO_INSTALACION'])->first();
        $academia = academia::select('idAcademia')->where('Academia',$row['ACADEMIA-DIRECCION'])->first();

     //Retorno del objeto "instalación" que sera almacenado  directamente en la tabla instalaciones.
        return new instalacion([
           'TipoInstalacion_idTipo'=> $instalacion->idTipo,
           'Nomenclatura'=> $row['NOMENCLATURA'],
           'NoEdificio'=> $row['NOEDIFICIO'],
           'Ubicacion' => $row['UBICACION'],
           'Academia_idAcademia' => $academia->idAcademia,  
        ]);

    }

   //Función para las especificación de reglas de columnas y filas del archivo excel.
    public function rules(): array{
         return [
           'TIPO_INSTALACION'=>'required|exists:TipoInstalacion,Categoria',
           'NOMENCLATURA'=>'required|min:2|max:50|unique:Instalaciones|',
           'NOEDIFICIO' => 'nullable|max:50|',
           'UBICACION' => 'nullable|max:50',
           'ACADEMIA-DIRECCION' =>'required|exists:Academias,Academia',
       ];
     }

   //Funcion de insercción de lotes para la carga masiva de datos.
      public function batchSize(): int
    {
        return 1000;
    }

     //Función de insercción por partes para la carga masiva de datos.
    public function chunkSize(): int
    {
        return 1000;
    }

}
