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

class EquipoBajaExport implements FromQuery,WithTitle,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
     use Exportable;

     public function query()
    {
         $equipo = equipo::query()
        ->leftjoin('Instalaciones','idInstalacion','=','Instalaciones_idInstalacion')
        ->leftjoin('Marca','idMarca','=','Marca_idMarca')
        ->leftjoin('TipoEquipo','idTipo','=','TipoEquipo_idTipo')
        ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
        ->where('Historial.Estatus',0);

        return $equipo;
    }
    public function map($equipo): array   //Información Excel
    {
        return [
            $equipo->Categoria,
            $equipo->NoInventario,
            $equipo->Nomenclatura,
            $equipo->Serie,
            $equipo->Modelo,
            $equipo->Marca,
            $equipo->TipoAdquisicion,
            $equipo->Observacion1,
            $equipo->Observacion2,
        ];
    }

    public function headings(): array    //Nombres de Encabezados
    {
        return [
            'TIPO_EQUIPO',
            'NO_INVENTARIO',
            'NOMENCLATURA',
            'SERIE',
            'MODELO',
            'MARCA',
            'TIPO_ADQUISICION',
            'OBSERVACION1',
            'OBSERVACION2',
        ];
    }

     public function title(): string
     {
    
       return "EquiposBaja";
             
     }

       public function registerEvents(): array
       {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                 $cellRange = 'A1:IZ1';  // Todos los encabezados
                 $event->sheet->getDelegate()->getStyle ($cellRange)->getFont()->setSize (12);
            },
        ];
  }
}

