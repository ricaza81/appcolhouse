@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.tenants.title')</h3>
    @can('property_create')
    <p>
     <!--   <a href="{{ route('admin.tenants.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

     <p>
        <ul class="list-inline">
           

            <li><a href="{{ route('admin.tenants.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
           
            <li><a href="{{ route('admin.tenants.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>

        </ul>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tenants) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.tenants.fields.name')</th>
                        <th>@lang('global.tenants.fields.cedula')</th>
                        <th>@lang('global.tenants.fields.email')</th>
                        <th>@lang('global.tenants.fields.property')</th>
                        <th>@lang('global.tenants.fields.subproperty')</th>
                        <th>Contrato</th>
                        <!--<th>@lang('global.tenants.fields.valor_pago_pendiente')</th>-->
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($tenants) > 0)
                        @foreach ($tenants as $tenant)
                        @if ($tenant->role_id!=1)
                            <tr data-entry-id="{{ $tenant->id }}">
                                <td field-key='name'>

                                      <a href="{{ route('admin.tenants.show',[$tenant->id])}}" data-toggle="tooltip" title="Ver inquilino" style="color:#000;margin-bottom: 10px;">  
                                        {{ $tenant->name }}
                                      </a>
                                
                                  @if($tenant->valorporpagar($tenant->id)>0)
                                <span class="m-status" style="padding-bottom:0px;padding-top:8px;float:right;color:#d2594f">
                                    <h5 style="font-weight:400;">
                                        <a href="{{ route('admin.properties_facturas.facturas_tenant_vencidas',[$tenant->id]) }}"data-toggle="tooltip" title="Ver Facturas" style="color:#d2594f">${{number_format(
                                           $tenant->valorporpagar($tenant->id)
                                            ), 0, ',', '.' }}
                                        </a>
                                    </h5>
                                </span>
                                @else <br/>
                                 <span class="label label-success" style="padding-bottom:0px;padding-top:8px;float:right">
                                    <h5 style="font-weight:400;">
                                        <a href="{{ route('admin.properties_facturas.facturas_tenant_vencidas',[$tenant->id]) }}"data-toggle="tooltip" title="Ver Facturas" style="color:#fff">${{number_format(
                                           $tenant->valorporpagar($tenant->id)
                                            ), 0, ',', '.' }}
                                        </a>
                                    </h5>
                                </span>
                                @endif


                                 @if(
                                     $tenant->facturas2($tenant->id)
                                     -
                                     $tenant->facturas_pagadas($tenant->id)
                                     >0
                                     ||
                                     $tenant->facturasvencidas($tenant->id)
                                     >0
                                     ) 
                                <a href="{{ route('admin.properties_facturas.facturas_tenant_vencidas',[$tenant->id]) }}" class="btn btn-info" data-toggle="tooltip" title="Pagar facturas" style="float:right;margin-top: 10px;">Recibir pago</a>
                                @endif
                                </td>

                                <td>  <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);float:left;text-transform:capitalize;">
                                            {{ $tenant->cedula or '' }}
                                        </span>

            @if ($tenant->seguro_tenant($tenant->id) == 1 ) 
                                   <a href="{{ route('admin.properties_sub.show',[$tenant->subproperty->id]) }}">
                                    <span class="m-status" style="background:#5cb85c;color:#fff;float:left;">
                                    Asegurado
                                    </span>
                                    </a>
            @else
             <span class="m-status" style="background:#d7564a;color:#fff;float:left;">
                                    No Asegurado
                                    </span>
            @endif

                                </td>

                                <td field-key='email'>{{ $tenant->email }}

                             
                                  @if ($tenant->estado=='1')
                                    <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);">
                                     Activo
                                    </span>
                                  @endif
                             

                             
                                   @if ($tenant->estado=='2')
                                    <span class="m-status">
                                     No Activo
                                    </span>
                                  @endif
                           
                                </td>
                                <td field-key='property'>{{ $tenant->property->name or '' }}</td>
                                <td field-key='subproperty'>{{ $tenant->subproperty->nombre or ''}}</td>
                                 <td field-key='subproperty'>

                                    Inicio: {{ date('d/F/Y', strtotime( $tenant->fecha_inicio_contrato)) }}

                                     @if($tenant->fecha_fin_contrato != '' )
                                    Fin: {{ date('d/F/Y', strtotime( $tenant->fecha_fin_contrato))  }}
                                    @endif

                                </td>
                                
                             
                              <!--  <td field-key='porpagar' style="text-align:center;">

                               @if($tenant->valorporpagar($tenant->id)>0)
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px">
                                    <h5 style="font-weight:400;">
                                        <a href="{{ route('admin.properties_facturas.facturas_tenant_vencidas',[$tenant->id]) }}"data-toggle="tooltip" title="Ver Facturas" style="color:#fff">${{number_format(
                                           $tenant->valorporpagar($tenant->id)
                                            ), 0, ',', '.' }}
                                        </a>
                                    </h5>
                                </span>
                                @else
                                 <span class="label label-success" style="padding-bottom:0px;padding-top:8px">
                                    <h5 style="font-weight:400;">
                                        <a href="{{ route('admin.properties_facturas.facturas_tenant_vencidas',[$tenant->id]) }}"data-toggle="tooltip" title="Ver Facturas" style="color:#fff">${{number_format(
                                           $tenant->valorporpagar($tenant->id)
                                            ), 0, ',', '.' }}
                                        </a>
                                    </h5>
                                </span>
                                @endif
                             
                                
                         
                                                  
                                </td>-->
                              

                                @if( request('show_deleted') == 1 )
                                  
                                <td>
                                 
                                  
                             
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tenants.restore', $tenant->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tenants.perma_del', $tenant->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('property_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.tenants.destroy', $tenant->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                          <a href="{{ route('admin.tenants.show',[$tenant->id]) }}" class="btn btn-xs btn-primary">Ver Inquilino</a>
                                 

                                
                                   <!-- <a href="{{ route('admin.tenants.edit',[$tenant->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>-->
                               

                                
                                    <a href="{{ route('admin.properties_facturas.create',[$tenant->property_sub_id]) }}" class="btn btn-xs btn-info">+ Factura</a>
                                    @endcan
                                </td>
                                @endif
                                
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
    </div>
@stop

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

@section('javascript') 
    <script>
        @can('property_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.tenants.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection

