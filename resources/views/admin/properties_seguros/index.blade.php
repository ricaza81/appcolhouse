@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.facturas.title')</h3>
    @can('document_create')
    <p>
       <!-- <a href="{{ route('admin.documents.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.properties_facturas.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.properties_facturas.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="display table table-hover {{ count($facturas) > 0 ? 'datatable' : '' }} @can('properties_facturas_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan"  cellspacing="0" width="100%">
                <thead>
                    <tr>
                        @can('properties_facturas_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th># Factura</th>
                        <th>@lang('global.facturas.fields.property')</th>
                        <th>@lang('global.facturas.fields.unidad')</th>
                        <th style="text-align:center;width:10px">@lang('global.facturas.fields.tenant')</th>
                       <!-- <th style="text-align:center;">Período</th>-->
                        <!--<th style="text-align:center;">Fecha Corte</th>-->
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
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                 <td field-key='property'>COLH-FT-{{ $factura->id or '' }}
                                     Inicio: {{date('d/F/Y', strtotime($factura->fecha_inicio))}} <br/>
                                Corte: {{date('d/F/Y', strtotime($factura->fecha_corte))}}

                               @if (($factura->valor_neto)-($factura->pago2($factura->id))!=0)
                                @if(($factura->fecha_corte) <= Now())
                                 <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px">Vencida
                                 </span>
                                 @else 
                                   <span class="label label-success" style="text-align:center;padding:10px;font-size:15px">Sin vencer
                                 </span>
                                @endif
                                @endif</td>
                                <td field-key='property'>{{ $factura->property->name or '' }}</td>
                                <td field-key='property_sub'>{{ $factura->property_sub->nombre or '' }}</td>
                                <td WIDTH="10" field-key='user' style="text-align:center;padding:10px">
                                     <span class="label label-warning" style="text-align:center;padding:10px;font-size:12px">
                                         <a href="{{ route('admin.tenants.show',[$factura->id_tenant])}}"data-toggle="tooltip" title="Ver Inquilino" style="color:#fff;padding:0px">
                                            {{ $factura->tenant->name or '' }}
                                        </a>
                                    </span>
                                </td>
                          <!--      <td field-key='fecha_inicio'>
                                Inicio: {{date('d/F/Y', strtotime($factura->fecha_inicio))}} <br/>
                                Corte: {{date('d/F/Y', strtotime($factura->fecha_corte))}}

                               @if (($factura->valor_neto)-($factura->pago2($factura->id))!=0)
                                @if(($factura->fecha_corte) <= Now())
                                 <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px">Vencida
                                 </span>
                                 @else 
                                   <span class="label label-success" style="text-align:center;padding:10px;font-size:15px">Sin vencer
                                 </span>
                                @endif
                                @endif


                                </td>-->
                                <!--<td field-key='fecha_corte'>{{date('d/F/Y', strtotime($factura->fecha_corte))}}</td>-->
                                
                               
                                <td field-key='name' style="font-size:15px;font-weight: 700">${{ number_format($factura->valor_neto), 0, ',', '.' }}</td>
                               
                                
                               
                                <td field-key='property'>
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
                                 
                                 @if($factura->id_estado=='2')
                                    <span class="label label-success" style="text-align:center;padding:10px;font-size:15px;color:#fff">
                                            {{($factura->estado->estado)}}
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

                                    @if($factura->id_estado=='1')

                                    <a href="{{ route('admin.properties_pagos.create',[$factura->id]) }}" class="btn btn-xs btn-success">+ Pago</a>
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
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
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