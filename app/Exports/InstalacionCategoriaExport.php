<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\tipo_equipo;
use App\Models\instalacion;
use App\Models\academia;
use App\Models\equipo;

class InstalacionCategoriaExport implements FromQuery,WithTitle,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
    
    use Exportable;

      public function __construct($_equipo,$_reporte){
       $this->equipo = $_equipo;
       $this->reporte = $_reporte;

    }

    public function query()
    {

       return $this->equipo;

    }
    public function map($equipo): array   //Información Excel
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

    public function headings(): array    //Nombres de Encabezados
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

     public function title(): string
     {
    
       return $this->reporte;
        	 
     }
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
