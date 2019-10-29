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
use App\Models\historial;


HeadingRowFormatter::default('none');  //Sin ningun formato establecido.


//Controlador para importacion de datos de historial de un equipo.

class HistorialImport implements ToModel,WithHeadingRow, WithBatchInserts, WithChunkReading
{

    use Importable;


    //Se especifica la importacion por modelo.
    
     //Función que realizara la llamada (n) veces para registrar (n) registros.
    public function model(array $row){
          $date = new \DateTime();
          
          //Retorno del objeto "historial" que sera almacenado  directamente en la tabla historial.
           return  new historial([
          'Equipos_NoInventario' => $row['NOINVENTARIO'],
          'Alta' => $date->format('Y-m-d H:i:s'),
          'Estatus' => 1,
          'Registro' => 1,
       ]);

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

