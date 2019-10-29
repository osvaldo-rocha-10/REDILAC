<?php

namespace App\Imports;

//Librerias
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\caracteristicas_equipo;
use App\Models\tipo_equipo;

//Controlador para importacion de caracteristicas de equipos de manera automatica.

class CaracteristicasImport implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{
    use Importable;
   
    //Se especifica la importación por modelo. 

   //Función que realizara la llamada (n) veces para almacenar (n) registros.

    public function model(array $row){
       
     $tipo = tipo_equipo::select('CA')->where('Categoria',$row['TIPO_EQUIPO'])->first();
     
     if($tipo->CA==1){
       return  new caracteristicas_equipo([
        'Equipos_NoInventario' => $row['NOINVENTARIO'],
       ]);
     }

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
