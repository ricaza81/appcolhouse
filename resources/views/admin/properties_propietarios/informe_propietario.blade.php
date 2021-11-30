@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Informe Propietario</h3>
    @can('document_create')
    <p>
       <!-- <a href="{{ route('admin.documents.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

    <p>
      
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="display table table-hover {{ count($facturas) > 0 ? 'datatable' : '' }} @can('properties_facturas_delete') @if ( request('show_deleted') != 1 ) display @endif @endcan"  cellspacing="0" width="100%"> <!--style="table-layout:collapse">-->
                <thead>
                    <tr>
                        <!--@can('properties_facturas_delete')
                            @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;">
                                <input type="checkbox" id="select-all" />
                            </th>@endif
                        @endcan-->

                        <th>Propiedad</th>
                        <th>Direccion propiedad</th>
                        <th style="text-align:center;width:10px">Propietario</th>
                        <th>Unidad</th>
                        <th>Vlr. Arriendo</th>
                        <th>Inquilino</th>
                        <th>Seguro</th>
                        <th>Adeudado</th>
                        <!--@if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif-->
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($facturas) > 0)
                        @foreach ($facturas as $factura)
                            <tr data-entry-id="{{ $factura->id }}">
                                <!--@can('properties_facturas_delete')
                                    @if ( request('show_deleted') != 1 )<td style="width:5px"></td>@endif
                                @endcan-->

                                 <td field-key='factura' style="width:310px;font-size:15px">{{ $factura->property->name or '' }}
                                </td>
                                <td field-key='property_sub'>{{ $factura->property->address or '' }}
                                </td>
                                <td field-key='user' style="text-align:center;padding:10px;width:55px;">
                                     <span class="m-status" style="float:left;">
                                         <a href="{{ route('admin.tenants.show',[$factura->id_tenant])}}"data-toggle="tooltip" title="Ver Inquilino" style="padding:0px;color:#b44d12;text-transform:capitalize;word-break: break-all;">
            {{ $factura->factura_propietario_id($factura->id)}}<br/>
           
                                        </a>
                                    </span>
                                        <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);float:left;text-transform:capitalize;">
                                            Cédula: {{ $factura->factura_propietario_id_cedula($factura->id) }}
                                        </span>
                                   
                                </td>
                       
                                
                               
                                <td field-key='name' style="font-size:15px;font-weight: 700">
                                   {{ $factura->property_sub->nombre or '' }}
                                </td>
                               
                                
                               
                                <td field-key='renta'>
                               ${{ number_format($factura->property_sub->renta)}}
                                </td>

<!--Saldo-->

                                 <td field-key='inquilinos'>
                                 
                                {{ $factura->tenant->name or '' }} 


                                 </td>
<!--Saldo-->
<!--comision-->
                                  <td field-key='name' style="font-size:15px;font-weight: 700">
                                   <!-- ${{ number_format($factura->comision), 0, ',', '.' }}-->
        @if ($factura->property_sub->seguros_unidad()->count() >= 1) 
                                   <a href="{{ route('admin.properties_sub.show',[$factura->property_sub->id]) }}">
                                    <span class="m-status" style="background:#5cb85c;color:#fff;float:left;">
                                    Si
                                    </span>
                                    </a> 
                                     @else 

                                   <a href="{{ route('admin.properties_sub.show',[$factura->property_sub->id]) }}">
                                    <span class="m-status" style="background:#d25948;color:#fff;float:left;">
                                    No
                                    </span>
                                    </a>
                                     @endif


                                </td>
<!--comision-->                                  


                                <td field-key='adeudado'>
                                 


                    <!--{{ $factura->tenant->id or ''}}-->
                     {{ $factura->factura_adeudado_tenant($factura->id) }}

                                   
                                </td>
                                
                                <!--@if( request('show_deleted') == 1 )
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
                                @endif-->
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