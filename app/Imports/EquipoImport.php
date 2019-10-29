<?php

namespace App\Imports;

//Modelos
use App\Models\instalacion;
use App\Models\tipo_equipo;
use App\Models\equipo;

//Librerias
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;


HeadingRowFormatter::default('none'); //Sin ningun formato establecido.

//Controlador para importacion de datos de equipos desde un archivo excel.

class EquipoImport implements ToModel,WithHeadingRow,WithValidation, WithBatchInserts, WithChunkReading
{

     use Importable; 

   //Se especifica la importación por modelo. 

   //Función que realizara la llamada (n) veces para almacenar (n) registros.

    public function model(array $row){

         //Consulta para obtener el id de instalación por la columna llamada INSTALACION.
        $instalacion = instalacion::select('idInstalacion')->where('Nomenclatura',$row['INSTALACION'])->first();

       //Consulta para obtener el id de tipo por la columna llamada TIPO_EQUIPO.
        $tipo_equipo = tipo_equipo::select('idTipo')->where('Categoria',$row['TIPO_EQUIPO'])->first();

        //Retorno del objeto "equipo" que sera almacenado  directamente en la tabla equipos.
        return new equipo([
                'NoInventario'=> $row['NOINVENTARIO'],
                'TipoEquipo_idTipo'=> $tipo_equipo->idTipo,
                'Serie'=> $row['SERIE'],
                'Modelo' => $row['MODELO'],
                'Instalaciones_idInstalacion' => $instalacion->idInstalacion,
                'Disponible' => 0,
        ]);

    }

    //Función para las especificación de reglas de columnas y filas del archivo excel.
    public function rules(): array{
         return [
            'NOINVENTARIO'=>'required|numeric|digits_between:0,9|unique:Equipos',
            'TIPO_EQUIPO'=>'required|exists:TipoEquipo,Categoria',
            'SERIE' => 'nullable|alpha_dash|min:3|max:50|',
            'MODELO' => 'nullable|alpha_dash|min:3|max:50|',
            'INSTALACION' =>'required|exists:Instalaciones,Nomenclatura',
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
