
<meta charset="utf-8">

<title>
    {{ trans('global.global_title') }}
</title>

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">
<meta content="width=device-width, initial-scale=1.0"
      name="viewport"/>
<meta http-equiv="Content-type"
      content="text/html; charset=utf-8">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Global site tag (gtag.js) - Google Analytics -->
  <!-- <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/css/main.css')}}">
     <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/css/fonts.min.css')}}">-->
       

<!--AdminLTE-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ url('olympus/app/css/main.css')}}">
<link href="{{ url('olympus/app/css/fonts.min.css')}}">
<link href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ url('adminlte/css') }}/select2.min.css"/>
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<link href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
<link href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
<!-- Bootstrap CSS -->
<link  href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-reboot.css')}}">
<link href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-grid.css')}}">
<link href="{{ url('olympus/app/css/main.css')}}">
<link href="{{ url('olympus/app/css/fonts.min.css')}}">
<link href="{{ url('adminlte/css/skins/skin-blue.min.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/css/custom.css') }}" rel="stylesheet">

<style>
.m-status {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 7px 12px;
    font-weight: 600;
    font-size: 18px;
    line-height: 1;
    font-family: proxima-nova,Avenir,sans-serif;
    text-align: center;
    color: #fff;
    text-transform: capitalize;
    font-style: normal;
    letter-spacing: 0;
    white-space: nowrap;
    border-radius: 100px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    color: #b44d12;
    background: #fff3c4;
}

.m-status-2 {
    font-weight: 600;
    font-size: 18px;
    background: #000;
    color: #fff;
    border-radius: 100px;
}
</style>


<div id="body" style="font-size:12px">
 <div class="row" style="text-align: center;">
 <a href="{{ route('landing.index') }}" class="main-logo"><img src="{{asset('/css/imagenes/logo-colhouse.png')}}" alt="Colhouse" style="width: 215px;padding-left:25px;padding-top:20px;" />
 </a>
</div>

    <h3 class="page-title" style="margin-top:10px">Informe Propietario: {{$propietario->nombre}}</h3>
     <!--<a href="{{ route('admin.properties_facturas.index') }}" class="btn btn-success">@lang('global.app_back_to_list')</a>-->

     <div class="panel panel-default">

        <div class="col-md-10">
            <div class="title" style="color:#000;margin-top:-20px">
                @if ($fecha_inicio_informe != NULL)
                <h3>Período consultado: {{date('d/F/Y', strtotime($fecha_inicio_informe)) }}- {{date('d/F/Y', strtotime($fecha_fin_informe))}}</h3>
                @else
                <h1>Por favor selecciona un período</h1>
                @endif
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tenants) > 0 ? '' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.tenants.fields.property')</th>
                        <th>Direccion</th>
                        <th>Propietario</th>
                        <th>@lang('global.tenants.fields.subproperty')</th>
                        <th>Vlr. Arriendo</th>
                        <th>Inquilino</th>
                        <th>Seguro</th>
                        <th>Valor pago</th>
                        <th>Adeudado</th>
                        <!--<th>&nbsp;</th>-->
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($tenants) > 0)
                        @foreach ($tenants as $tenant)
                        @if ($tenant->role_id!=1)
                            <tr data-entry-id="{{ $tenant->id }}">
                            <td field-key='property'>{{ $tenant->property->name or '' }}
                            </td>
                            <td field-key='property'>{{ $tenant->property->address or '' }}
                            </td>
                            <td field-key='propietario'>
                                      <a href="{{ route('admin.properties_propietarios.index',[$tenant->property->id])}}" data-toggle="tooltip" title="Consultar" style="color:#000" target="_blank">  
                                        {{ $tenant->property->propietarios2($tenant->property->id)->nombre }}
                                      </a><br/>
                                   <!--   <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);float:left;text-transform:capitalize;">
                                            Cédula: {{ $tenant->property->propietarios2($tenant->property->id)->cedula }}
                                        </span>-->
                            </td>
                            <td field-key='unidad'>{{ $tenant->subproperty->nombre or '' }}
                            </td>

                            <td field-key='renta'>${{number_format($tenant->subproperty->renta) }}
                            </td>

                            <td field-key='inquilino'><a href="{{ route('admin.tenants.show',[$tenant->id]) }}" target="_blank">
                                {{ $tenant->name }}
                            </a>
                            </td>

                            <td field-key='seguro' style="text-align: center;">
                              
                                  @if ($tenant->subproperty->seguros_unidad()->count() > 0) 
                                   
                                    <span class="" style="background:#5cb85c;color:#fff;text-align:center;padding-top:20px;">
                                        <a href="{{ route('admin.properties_sub.show',[$tenant->subproperty->id]) }}" style="padding-top:20px" target="_blank" >
                                    Si
                                     </a>
                                    </span>
                                   
                                     @endif

                                        @if ($tenant->subproperty->seguros_unidad()->count() == 0) 
                                   
       <span class="" style="background:#d7564a;color:#fff;text-align:center;padding-top:20px;">
                                        <a href="{{ route('admin.properties_sub.show',[$tenant->subproperty->id]) }}" style="padding-top:20px" target="_blank">
                                    No
                                     </a>
                                    </span>
                                     @endif
                               </td>
                                 <td>
                                ${{ number_format($tenant->valor_pagado_periodo($tenant->id, $fecha_inicio_informe, $fecha_fin_informe)), 0, ',', '.' }}
                               </td>
                                <td field-key='porpagar' style="text-align:center;">
                                  <!--${{number_format($tenant->valor_adeudado($tenant->id)) }}-->
                                ${{number_format(($tenant->facturas2($tenant->id)-$tenant->facturas_pagadas($tenant->id))), 0, ',', '.'}}
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
             </div>
        

    @if ($deducciones > 0)
        <div class="col-md-5" style="background:#fff;width:100%;">
            Deducciones
             @if ($fecha_inicio_informe != NULL)
                <h4>Período consultado: {{date('d/F/Y', strtotime($fecha_inicio_informe)) }}- {{date('d/F/Y', strtotime($fecha_fin_informe))}}</h4>
                @else
                <h4>Por favor selecciona un período</h4>
                @endif
           <div class="panel-body table-responsive" style="background:#fff;">
            <div class="row">
         

              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                          <th style="margin-left:10px">Valor Deducción</th>
                          <th>Fecha Deducción</th>
                          <th>Explicación Deducción</th>
                    </tr>
                </thead>

              <tbody>
               @if (count($deducciones_detalles) > 0)
                        @foreach ($deducciones_detalles as $deduccion)
                          <tr data-entry-id="{{ $deduccion->id }}">
                             <td style="margin-left:10px">${{number_format($deduccion->valor)}}
                             </td>
                              <td field-key='name'>{{date('d/F/Y', strtotime($deduccion->fecha_deduccion))}}</td>
                              <td style="font-size:14px;font-family">
                                {{$deduccion->observaciones}}
                              </td>
                            
                          </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
             </tbody>
             </table>
        </div>
    </div>
</div>
@endif
  

        <div class="col-md-7" style="margin-left: 200px;background:#fff;width:65%;border:2px solid #000;padding:20px;border-radius:4px;margin-top:10px;background:#f9f9f9">
            Consolidado
         @if ($fecha_inicio_informe != NULL)
                <h4>Período consultado: {{date('d/F/Y', strtotime($fecha_inicio_informe)) }}- {{date('d/F/Y', strtotime($fecha_fin_informe))}}</h4>
                
                            <div class="row">
              <table class="table table-bordered table-striped">
    
             <tr>
                <th>Ingresos por arrendamiento</th>
                 <td>${{number_format($ingresos)}}
                </td>
            </tr>
            <tr>
                <th>Administración de la propiedad</th>
                 <td>${{number_format($administracion)}}
                </td>
            </tr>
             <tr>
                <th>Deducciones</th>
                 <td>${{number_format($deducciones)}}
                </td>
            </tr>
            <tr>
                <th>Valor a pagar al propietario</th>
                 <td>${{number_format(
                    $valor_pagar
                    )}}
                </td>
            </tr>
    </table>
</div>

                @else
                <h4>Por favor selecciona un período</h4>
                @endif
            </div>
        </div>
    </div>
</div>
</div>