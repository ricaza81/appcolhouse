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
          
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
           <table id="lista_facturas" class="table table-bordered table-striped {{ count($inquilinos) > 0 ? 'datatable' : '' }}"> 
                <thead>
                    <tr>
                       

                        <th>@lang('global.facturas.fields.tenant')</th>
                        <th>@lang('global.facturas.fields.property')</th>
                        <th>@lang('global.facturas.fields.unidad')</th>
                        <th>Estado</th>
                        <th style="text-align:center;">Seguro</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                     @if (count($inquilinos) > 0)
                        @foreach ($inquilinos as $inquilino)
                            <tr data-entry-id="{{ $inquilino->id }}">
                               

                                <td field-key='user'>
                                   <a href="{{ route('admin.tenants.show',[$inquilino->id]) }}" target="_blank" style="font-size: 23px;font-weight:700;">{{ $inquilino->name}}
                                   </a><br/>

                                     
                                       <span class="label label-info" style="padding-bottom:0px;padding-top:8px;font-weight:200;">
                               
                                 <h4 style="font-weight:200;font-size:15px">Valor total facturas:<br/>${{number_format(($inquilino->facturas2($inquilino->id))), 0, ',', '.'}}
                                </h4>
                                 <h4 style="font-weight:200;font-size:15px">Valor total pagado:<br/>${{number_format(($inquilino->facturas_pagadas($inquilino->id))), 0, ',', '.'}}
                                </h4>
                            
                         </span>
                                   </a>
                                </td>
                                <td field-key='property'>{{ $inquilino->property->name}}
                                </td>
                                <td field-key='property_sub'>
                                    <a href="{{route('admin.properties_sub.show',[$inquilino->property_sub_id])}}">
                                        {{ $inquilino->subproperty->nombre or ''}}
                                    </a>
                                </td>
                                <td field-key='user'>
                                 
                                @if($inquilino->facturas2($inquilino->id)-$inquilino->facturas_pagadas($inquilino->id) > 0)
                                  <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h5 style="float:left;">En mora</h5><br/>
                                <h4 style="font-weight:700;float:left;">${{number_format(($inquilino->facturas2($inquilino->id)-$inquilino->facturas_pagadas($inquilino->id))), 0, ',', '.'}}
                                </h4><br/>
                                  </span><br/>
                                  <a href="{{ route('admin.tenants.show',[$inquilino->id]) }}" data-toggle="tooltip" title="Ver Facturas" style="color:#fff;width:200px;font-size:18px;font-weight:700;" class="label label-success" target="_blank">Ver facturas
                                     </a>
                          
                                @endif
                                @if($inquilino->facturas2($inquilino->id)-$inquilino->facturas_pagadas($inquilino->id) == 0)
                                <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h5 style="float:left;">Al día</h5><br/>
                                <h4 style="font-weight:700;float:left;">${{number_format(($inquilino->facturas2($inquilino->id)-$inquilino->facturas_pagadas($inquilino->id))), 0, ',', '.'}}
                                </h4><br/>
                                </span><br/>
                                <a href="{{ route('admin.tenants.show',[$inquilino->id]) }}" data-toggle="tooltip" title="Ver Facturas" style="color:#fff;width:200px;font-size:18px;font-weight:700;" class="label label-success" target="_blank">Ver facturas
                                     </a>
                                @endif
                               
                                </td>
                                <td>
                                    
                                     @if($inquilino->seguro_tenant($inquilino->id) != NULL ) 
                                           <a href="{{ route('admin.properties_sub.show',[$inquilino->subproperty->id]) }}">
                                            <span class="m-status" style="background:#5cb85c;color:#fff;float:left;">
                                            Si
                                            </span>
                                            </a>
                                         @else
                                            <a href="{{ route('admin.properties_sub.show',[$inquilino->subproperty->id]) }}">
                                            <span class="m-status" style="background:#d7564a;color:#fff;float:left;">
                                            No
                                            </span>
                                            </a>
                                @endif
                                    
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