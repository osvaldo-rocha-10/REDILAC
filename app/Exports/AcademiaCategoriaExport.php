<?php

namespace App\Exports;

//Librerias.
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

//Modelos
use App\Models\tipo_equipo;
use App\Models\academia;
use App\Models\equipo;

/*
1.-Controlador => AcademiaCategoria

2.-Tipo => Exportar datos Excel.

3.-Funciones => 
    [ map($equipo),
      query(),
      headings(),
      title(),
     ]
*/


class AcademiaCategoriaExport implements FromQuery,WithTitle,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
  
     use Exportable;

     /*Constructor*/
    public function __construct($_equipo,$_reporte){
       $this->equipo = $_equipo;
       $this->reporte = $_reporte;

    }
    

    public function query(){
        return $this->equipo;
    }

    //Función que extrae (n) veces la información de la tabla equipo y lo retorna para su proxima exportación. 
    public function map($equipo): array   
    {
      
        return [
            $equipo->Categoria,
            $equipo->NoInventario,
            $equipo->Serie,
            $equipo->Modelo,
            $equipo->Marca,
            $equipo->Observacion1,
            $equipo->Observacion2,
        ];
    }

    //Función de mapeo de los encabezados de la hoja excel.

    public function headings(): array   
    {
        return [
            'TIPO_EQUIPO',
            'NO_INVENTARIO',
            'SERIE',
            'MODELO',
            'OBSERVACION1',
            'OBSERVACION2',
        ];
    }

    //Función para asignar el titulo de la hoja excel.
     public function title(): string
     {
    
       return $this->reporte;
        	 
     }

      //Función de como mostrar las celdas en la hoja de excel.
       public function registerEvents(): array
       {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                 $cellRange = 'A1:F1';  // Todos los encabezados
                 $event->sheet->getDelegate()->getStyle ($cellRange)->getFont()->setSize (12);
            },
        ];
    }
}
