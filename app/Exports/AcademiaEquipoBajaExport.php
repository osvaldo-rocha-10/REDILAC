<?php

namespace App\Exports;

//Librerias
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
1.-Controlador => AcademiaBajaExport

2.-Tipo => Exportar datos Excel.

3.-Funciones => 
    [map($equipo),
     query(),
     headings(),
     title(),
     ]
*/
class AcademiaEquipoBajaExport implements FromQuery,WithTitle,WithMapping,WithHeadings,ShouldAutoSize,WithEvents
{
  
     use Exportable;

    /*Constructor*/
    public function __construct(int $_academia,int $_categoria,string $_reporte){
       $this->academia = $_academia;
       $this->categoria = $_categoria;
       $this->reporte = $_reporte;
    }

      public function query()
    {

        if($this->categoria!=0){
             $equipo = equipo:: leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                                ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                                ->where('Equipos.TipoEquipo_idTipo',$this->categoria)
                                ->where('Historial.Estatus',0)
                                ->whereIn('Instalaciones_idInstalacion',
                                        function ($query) {
                                            $query->select('Instalaciones.idInstalacion')
                                            ->from('Instalaciones')
                                            ->where('Instalaciones.Academia_idAcademia',$this->academia);
                                          }

           );
        }else{
             $equipo = equipo::leftjoin('TipoEquipo','idTipo','=','Equipos.TipoEquipo_idTipo')
                                ->leftjoin('Historial','Equipos_NoInventario','=','NoInventario')
                                ->where('Historial.Estatus',0)
                                ->whereIn('Instalaciones_idInstalacion',
                                        function ($query) {
                                            $query->select('Instalaciones.idInstalacion')
                                            ->from('Instalaciones')
                                            ->where('Instalaciones.Academia_idAcademia',$this->academia);
                                          }

           );             
        }

       return $equipo;

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
    
       return "Academia_Equipo";
        	 
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
