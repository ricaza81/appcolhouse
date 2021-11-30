@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.facturas.fields.consultarfactura')</h3>
     <a href="{{ route('admin.tenants.show',[$factura->tenant->id])}}" class="btn btn-success">@lang('global.app_back_to_list')</a>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
                <a href="{{ route('admin.properties_facturas.edit',[$factura->id])}}" data-toggle="tooltip" title="Editar Factura">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                    </span>
                </a>
                <a href="{{ route('admin.properties_facturas.imprimir',[$factura->id])}}" data-toggle="tooltip" title="Descargar PDF">
                    <span class="label label-warning" style="margin-left:10px;padding:10px">Descargar PDF
                    </span>
                </a>
        </div>
        <div class="inner">
        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered table-striped">

                         <tr>
                            <th>@lang('global.facturas.fields.valor_neto')</th>
                            <td field-key='porpagar'>
                             <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($factura->valor_neto), 0, ',', '.'}}</h4>
                                </span>
                            </td>
                             <th>@lang('global.facturas.fields.valorpago')</th>
                            <td field-key='porpagar'>
                             <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($factura->pago2($factura->id)), 0, ',', '.'}}</h4>
                                </span>
                            </td>
                             <th>@lang('global.facturas.fields.saldo')</th>
                            <td field-key='porpagar'>
                             <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($factura->valor_neto - $factura->pago3($factura->id)), 0, ',', '.'}}</h4>
                                </span>
                            </td>

                          
                        </tr>
                            <tr>
                            <!--<th>@lang('global.facturas.fields.valor_arrendamiento')</th>-->
                            <td field-key='porpagar'>
                            <!-- <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($factura->valor), 0, ',', '.'}}</h4>
                                </span>-->
                            </td>
                            <td></td>
                             <th>@lang('global.facturas.fields.adicionales')</th>
                            <td field-key='porpagar'>
                             <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($factura->adicionales), 0, ',', '.'}}</h4>
                                </span>
                               
                                <h4 style="font-weight:700;font-size:16px;letter-spacing:0px">{{$factura->obs_adicionales}}</h4>
                              
                            </td>
                             <th>@lang('global.facturas.fields.deducciones')</th>
                            <td field-key='porpagar'>
                             <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($factura->deducciones), 0, ',', '.'}}</h4>
                                </span>

                                  <h4 style="font-weight:700;font-size:16px;letter-spacing:0px">{{$factura->obs_deducibles}}</h4>
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.facturas.fields.fechafactura')</th>
                                <td field-key='porpagar'>
                                 {{date('d/F/Y',strtotime($factura->created_at))}}
                                </td>
                            <th>@lang('global.facturas.fields.fechainicio')</th>
                                <td field-key='porpagar'>
                                 {{date('d/F/Y',strtotime($factura->fecha_inicio))}}
                                </td>
                            <th>Fecha Corte</th>
                                <td field-key='porpagar'>
                                 {{date('d/F/Y',strtotime($factura->fecha_corte))}}
                                </td>
                        </tr>

                      
                       
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>
                            @lang('global.tenants.fields.inquilino')
                            </th>
                            <td field-key='address'>
                                <a href="{{ route('admin.tenants.show',[$factura->tenant->id]) }}" data-toggle="tooltip" title="Consultar Inquilino">    <span class="label label-info" style="margin-left:10px;padding:10px">Consultar
                    </span>
                                     </a>
                           </td>
                
                </a></td>
                        </tr>
                        <tr>
                            <th>@lang('global.tenants.fields.email')</th>
                            <td field-key='photo'>
                                {{ $factura->tenant->email }}
                               
                            </td>
                        </tr>
                         <tr>
                            <th>@lang('global.tenants.fields.phone')</th>
                            <td field-key='photo'>
                                {{ $factura->tenant->phone }}
                               
                            </td>
                        </tr>
                    </table>
                </div>

                

                <div class="col-md-4">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Codeudor</th>
                            <td field-key='name'>{{ $factura->tenant->codeudor }}</td>
                            <th>Cédula</th>
                            <td field-key='porpagar'>{{$factura->tenant->cc_codeudor}}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.tenants.fields.email')</th>
                            <td field-key='address'>{{ $factura->tenant->email_codeudor }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tenants.fields.phone')</th>
                            <td field-key='address'>{{ $factura->tenant->tel_codeudor }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tenants.fields.dir_codeudor')</th>
                            <td field-key='address'>{{ $factura->tenant->dir_codeudor }}</td>
                        </tr>
                    </table>
                </div>

            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#pagos" aria-controls="pagos" role="tab" data-toggle="tab">@lang('global.pagos.title')</a></li>
<!--<li role="presentation" class=""><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>-->
</ul>

<!-- Tab panes -->
<div class="tab-content">

   

<div role="tabpanel" class="tab-pane active" id="pagos">

<table class="table table-bordered table-striped {{ count($facturas) > 0 ? 'datatable' : '' }} @can('properties_facturas_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('properties_facturas_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.facturas.fields.property')</th>
                        <th>@lang('global.facturas.fields.unidad')</th>
                        <th>@lang('global.facturas.fields.tenant')</th>
                         <th style="text-align:center;">Fecha Pago</th>
                       
                        
                        <th>@lang('global.facturas.fields.valorpago')</th>
                        <th>Estado</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($facturas) > 0)
                        @foreach ($facturas as $factura)
                            <tr data-entry-id="{{ $factura->id }}">
                                @can('properties_facturas_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='property'>{{ $factura->propiedad->name or '' }}</td>
                                <td field-key='property_sub'>{{ $factura->unidad->nombre or '' }}</td>
                                <td field-key='user'>{{ $factura->tenant->name or '' }}</td>
                                <td field-key='fecha_inicio'>{{date('d/F/Y', strtotime($factura->created_at)) }}
                                    
                                </td>
                               
                               
                                <td field-key='name'style="font-size:15px;font-weight: 700">${{ number_format($factura->valor), 0, ',', '.' }}</td>
                               
                                   <td field-key='estado'>
                                  {{ $factura->factura->estado->estado or '' }}
                                   
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_pagos.restore', $factura->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_facturas.perma_del', $factura->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('properties_pagos_view')
                                    <a href="{{ route('admin.properties_pagos.show',[$factura->id]) }}" class="btn btn-xs btn-primary">Ver pago</a>
                                    @endcan
                                    @can('properties_pagos_edit')
                                    <a href="{{ route('admin.properties_pagos.edit',[$factura->id]) }}" class="btn btn-xs btn-info">Editar pago</a>
                                    @endcan
                                    @can('properties_pagos_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_pagos.destroy', $factura->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>

</div>

</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.tenants.show',[$factura->tenant->id])}}" class="btn btn-success">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
