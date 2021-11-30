@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.pagos.title')</h3>
    @can('document_create')
    <p>
        <a href="#" class="btn btn-success" data-toggle="tooltip" title="Crealo desde la unidad" style="color:#fff;padding:10px">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.properties_pagos.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.properties_pagos.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pagos) > 0 ? 'datatable' : '' }} @can('properties_pagos_delete') @if ( request('show_deleted') != 1 ) display @endif @endcan">
                <thead>
                    <tr>
                       <!-- @can('properties_pagos_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan-->

                        <th># Factura</th>
                        <th>@lang('global.facturas.fields.property')</th>
                        <th>@lang('global.facturas.fields.unidad')</th>
                        <th style="text-align:center;">@lang('global.facturas.fields.tenant')</th>
                        <th style="text-align:center;">Fecha de Pago</th>
                        <!--<th style="text-align:center;">Fecha Corte</th>-->
                        <th>Valor Pagado</th>
                        <th>Estado</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pagos) > 0)
                        @foreach ($pagos as $pago)
                            <tr data-entry-id="{{ $pago->id }}">
                               <!-- @can('properties_pagos_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan-->

                                 <td field-key='pago'>COLH-FT-{{ $pago->id_factura or '' }}<br/>
                                

                                 </td>
                                <td field-key='property'>{{ $pago->propiedad->name or '' }}</td>
                                <td field-key='property_sub'>{{ $pago->unidad->nombre or '' }}</td>
                                <td field-key='user' style="text-align:center;padding:10px">
                                    <span class="label label-warning" style="float: left;padding:10px;font-size:12px">
                                         <a href="{{ route('admin.tenants.show',[$pago->id_tenant])}}"data-toggle="tooltip" title="Ver Facturas" style="color:#fff;padding:0px">
                                            {{ $pago->tenant->name or '' }}
                                        </a>
                                    </span><br/>
                            @if ($pago->unidad->seguros_unidad()->count() >= 1) 
                                   <a href="{{ route('admin.properties_sub.show',[$pago->unidad->id]) }}">
                                    <span class="m-status" style="background:#5cb85c;color:#fff;float:left;">
                                    Asegurado
                                    </span>
                                    </a> 
                                     @else 

                                   <a href="{{ route('admin.properties_sub.show',[$pago->unidad->id]) }}">
                                    <span class="m-status" style="background:#d25948;color:#fff;float:left;">
                                    No Asegurado
                                    </span>
                                    </a>
                                     @endif
                                   
                                </td>
                                <td field-key='fecha_inicio'>{{date('d/F/Y', strtotime($pago->fecha_pago))}}
        <a href="{{route('admin.properties_pagos.show',[$pago->id])}}"> Editar </a>
                                </td>
                              
                                
                               
                                <td field-key='name' style="font-size:15px;font-weight: 700">${{ number_format($pago->valor), 0, ',', '.' }}</td>
                               <!-- <td field-key='property'> <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px">
                                {{$factura->factura->estado->estado or ''}}
                                </span></td>-->

                                <td field-key='property'>
                                  @if ($pago->valor!=0)
                                    <span class="label label-success" style="text-align:center;padding:10px;font-size:15px;color:#000">Al dia
                                    </span>
                                    @endif
                                     @if ($pago->valor='')
                                    <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px;color:#000">Pendiente
                                    </span>
                                  @endif
                                </td>
                               <!-- <td>
                                  <a target="_blank" href="{{ route('admin.properties_pagos.show',[$pago->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                </td>-->


                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_pagos.restore', $pago->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_pagos.perma_del', $pago->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('properties_pago_view')
                                    <a href="{{ route('admin.properties_pagos.show',[$pago->id]) }}" class="btn btn-xs btn-primary" target="_blank">@lang('global.app_view')</a>
                                    @endcan
                                    @can('properties_pago_edit')
                                    <a href="{{ route('admin.properties_pagos.edit',[$pago->id]) }}" class="btn btn-xs btn-info" target="_blank">@lang('global.pagos.fields.editar_pago')</a>
                                    <!--<a href="{{ route('admin.properties_pagos.create',[$pago->id]) }}" class="btn btn-xs btn-success" target="_blank">+ Pago</a>-->
                                    @endcan
                                    @can('properties_pagos_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("ESTAS SEGURO")."');",
                                        'route' => ['admin.properties_pagos.destroy', $pago->id])) !!}
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
        @can('properties_pagos_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.properties_pagos.mass_destroy') }}'; @endif
        @endcan

    </script>

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
@endsection