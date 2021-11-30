<!--@inject('request', 'Illuminate\Http\Request')-->

@extends('layouts.app')

@section('content')
@if(isset($property))
    <h3 class="page-title">Consolidado de @lang('global.facturas.title') de la propiedad {{$property->name}}
    </h3>
@endif
    
    @can('document_create')
    <p>
       <!-- <a href="{{ route('admin.documents.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

     <p>
        <ul class="list-inline">
           
@if(isset($property))
            <li><a href="{{ route('admin.properties_facturas.facturas_propiedad_consulta',[$property->id]) }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
              <li><a href="{{ route('admin.properties_facturas.facturas_vencidas_propiedad_consulta',[$property->id]) }}" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">Por pagar</a></li> |
            <li><a href="{{ route('admin.properties_facturas.facturas_propiedad_consulta',[$property->id]) }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
@endif
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

              

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($facturas) > 0 ? 'datatable' : '' }} @can('properties_facturas_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('properties_facturas_delete')
                            @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;">
                                <input type="checkbox" id="select-all" />
                            </th>@endif
                        @endcan

                        <th># Factura</th>
                        <th>@lang('global.facturas.fields.unidad')</th>
                        <th style="text-align:center;width:10px">@lang('global.facturas.fields.tenant')</th>
                        <th>@lang('global.facturas.fields.valor_neto')</th>
                        <th>Valor Pagado</th>
                        <th>Saldo</th>
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
                                    @if ( request('show_deleted') != 1 )<td style="width:5px"></td>@endif
                                @endcan

                                 <td field-key='factura' style="width:310px;font-size:15px">COLH-FT-{{ $factura->id or '' }}<br/>
                                 Inicio: {{date('d/F/Y', strtotime($factura->fecha_inicio))}} <br/>
                                Corte: {{date('d/F/Y', strtotime($factura->fecha_corte))}}
                                <br/>
                                 <div class="row">
                                 <a href="{{ route('admin.properties_facturas.show',[$factura->id]) }}" class="btn btn-xs btn-primary" style="margin-left:12px">Ver factura</a>
                                 <a href="{{ route('admin.properties_facturas.imprimir',[$factura->id]) }}" class="btn btn-xs btn-primary" target="_blank" style="margin-left:3px">PDF</a>
                                </div>

                             
                              
                                @if(($factura->fecha_corte) <= Now())
                                 <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px">Vencida
                                 </span>

                                   <span class="label label-success" style="text-align:center;padding:10px;font-size:12px">
                                         <a href="{{ route('admin.properties_pagos.create',[$factura->id])}}"data-toggle="tooltip" title="Pagar" style="color:#fff;padding:0px">
                                            Recibir pago
                                        </a>
                                    </span>
                                     @else 
                                   <span class="label label-success" style="text-align:center;padding:10px;font-size:15px">Sin vencer
                                 </span>
                                  <span class="label label-success" style="text-align:center;padding:10px;font-size:12px">
                                         <a href="{{ route('admin.properties_pagos.create',[$factura->id])}}"data-toggle="tooltip" title="Pagar" style="color:#fff;padding:0px">
                                            Recibir pago
                                        </a>
                                    </span>
                                @endif
                              
                           

                               </td>
                                <!--<td field-key='property'></td>-->
                                <td field-key='property_sub'>{{ $factura->property_sub->nombre or '' }}<br/>
                                Principal: {{ $factura->property->name or '' }}</td>
                                <td field-key='user' style="text-align:center;padding:10px;width:55px;">
                                     <span class="m-status" style="float:left;">
                                         <a href="{{ route('admin.tenants.show',[$factura->id_tenant])}}"data-toggle="tooltip" title="Ver Inquilino" style="padding:0px;color:#b44d12;text-transform:capitalize;word-break: break-all;">
                                            {{ $factura->tenant->name or '' }} 
                                        </a>
                                    </span>
                                        <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);float:left;text-transform:capitalize;">
                                            Cédula: {{ $factura->tenant->cedula or '' }}<br/>
                                            fecha creación factura ><br/>{{$factura->created_at->format('d/F/Y')}}
                                        </span>
                                   
                                </td>
                     
                                
                               
                                <td field-key='name' style="font-size:15px;font-weight: 700">${{ number_format($factura->valor_neto), 0, ',', '.' }}</td>
                               
                                
                               
                                <td field-key='valorpagado'>
                                    <span class="label label-success" style="text-align:center;padding:10px;font-size:15px">${{number_format($factura->pago2($factura->id)), 0, ',', '.' or '0'}}
                                    </span>
                                    


                                  
                                </td>

<!--Saldo-->

                                 <td field-key='property'>
                                 
                                @if (($factura->valor_neto)-($factura->pago2($factura->id))>0)

                                 <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px">${{number_format(($factura->valor_neto)-($factura->pago2($factura->id))), 0, ',', '.' or '0'}}
                                    </span>
                                @endif

                                 @if (($factura->valor_neto)-($factura->pago2($factura->id))==0)
                                   <span class="label label-success" style="text-align:center;padding:10px;font-size:15px">${{number_format(($factura->valor_neto)-($factura->pago2($factura->id))), 0, ',', '.' or '0'}}
                                    </span>
                                @endif


                                 </td>
<!--Saldo-->
                      


                                <td field-key='estado'>
                                 
                                  @if($factura->saldo_factura($factura->id)==0)
                                  <span class="label label-success" style="text-align:center;padding:10px;font-size:15px;">
                                     {{($factura->estado->estado)}}
                                         
                                    </span>
                                 @endif


                                 @if($factura->id_estado=='2' && $factura->saldo_factura($factura->id)>0)
                                    <span class="label label-success" style="text-align:center;padding:10px;font-size:15px;color:#b44d12;background:#fff3c4">
                                             Con saldo por pagar <br/><br/>
                                            <span style="padding-top:24px">
                                            @if(isset($factura->valor)) 
                                             {{number_format($factura->saldo_factura($factura->id) / $factura->valor, 3, '.', ',')*100}}%
                                            @endif
                                            </span>
                                    </span>
                                 @endif
                                 @if($factura->id_estado=='1')
                                    <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px;color:#fff">
                                            {{($factura->estado->estado)}}
                                    </span>
                                 @endif
                                
                        
                                   
                                </td>
                                
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_facturas.restore', $factura->id])) !!}
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
                                    @can('properties_facturas_view')
                                    <a href="{{ route('admin.properties_facturas.show',[$factura->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('properties_facturas_edit')
                                    <a href="{{ route('admin.properties_facturas.edit',[$factura->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>

                                    @if($factura->id_estado=='1' || $factura->saldo_factura($factura->id)>0)

                                    <a href="{{ route('admin.properties_pagos.create',[$factura->id]) }}" class="btn btn-xs btn-success">+ Abono / Pago</a>
                                    @endif
                                    @endcan
                                    @can('properties_facturas_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_facturas.destroy', $factura->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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



@stop

@section('javascript') 
    <script>
        @can('document_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.documents.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection

<style>
.m-status {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 7px 12px;
    font-weight: 600;
    font-size: 13px;
    line-height: 1;
    font-family: proxima-nova,Avenir,sans-serif;
    text-align: center;
    color: #fff;
    text-transform: lowercase;
    font-style: normal;
    letter-spacing: 0;
    white-space: nowrap;
    background-color: #627d98;
    border-radius: 100px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    color: #b44d12;
    background-color: #fff3c4;
}
</style>