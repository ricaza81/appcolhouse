<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use App\PropertiesFacturas;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class PropertiesFacturasExportView implements FromView
{
    use Exportable;

    public function view(): View
    {
      
        
        $input = $request->all();
        $fecha_inicio_informe = $input['fecha_inicio_informe'];
        $fecha_fin_informe = $input['fecha_fin_informe'];
        $id_propiedad = $input['id_propiedad'];
        $id_propietario = $input['id_propietario'];
        $propiedad=Property::findOrFail($id_propiedad);
        $id_propiedad=$propiedad->id;
        $tenants=User::where('property_id','=',$id_propiedad)->get();
        $ingresos=$propiedad->facturas_pagadas_propiedad_fechas($propiedad->id, $fecha_inicio_informe,$fecha_fin_informe);
        $propietario=PropertiesPropietarios::find($input['id_propietario']);
        $administracion=$ingresos*$propietario->porc_comision/100;
        $deducciones=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->sum('valor');
        $deducciones_detalles=PropietariosDeducciones::where('id_propietario','=',$propietario->id)->where('fecha_deduccion','>=',$fecha_inicio_informe)->where('fecha_deduccion','<=',$fecha_fin_informe)->get();
            $valor_pagar=$ingresos-$administracion-$deducciones;

        return view('admin.tenants.informe_inquilinos_consulta_imprimir',
        
        [   'tenants'               =>  $tenants,
            'id_propiedad'          =>  $id_propiedad,
            'ingresos'              =>  $ingresos,
            'administracion'        =>  $administracion,
            'deducciones'           =>  $deducciones,
            'valor_pagar'           =>  $valor_pagar,
            'id_propietario'        =>  $id_propietario,
            'deducciones_detalles'  =>  $deducciones_detalles,
            'fecha_inicio_informe'  =>  $fecha_inicio_informe,
            'fecha_fin_informe'     =>  $fecha_fin_informe,
            'propietario'           =>  $propietario
        ]);

    /* return view('admin.tenants.informe_inquilinos_consulta_imprimir',compact('tenants','id_propiedad','ingresos','administracion','deducciones','valor_pagar','id_propietario','deducciones_detalles','fecha_inicio_informe','fecha_fin_informe','propietario'),*/
    }
}
