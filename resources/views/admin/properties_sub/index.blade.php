@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!--<h3 class="page-title">@lang('global.properties.title')</h3>-->
    <h3 class="page-title">@lang('global.properties_sub.title')</h3>
  

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.properties_sub.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.properties_sub.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($properties) > 0 ? 'datatable' : '' }} @can('property_delete') @if ( request('show_deleted') != 1 ) display @endif @endcan">
                <thead>
                    <tr>
                       <!-- @can('property_sub_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan-->

                        <th>@lang('global.properties.fields.name')</th>
                        <th>@lang('global.properties_sub.fields.nombre')</th>
                        <th>@lang('global.properties_sub.fields.tipo_sub')</th>
                        <th>@lang('global.properties_sub.fields.renta')</th>
                        <th>@lang('global.properties_sub.fields.generales')</th>
                        <th>Costo seguro</th>
                      
                        <th># Inquilinos</th>
                        <!--<th>@lang('global.properties.fields.photo')</th>-->
                        
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($properties) > 0)
                        @foreach ($properties as $property)
                        
                         
                            <tr data-entry-id="{{ $property->id }}">
                              <!--  @can('property_sub_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan-->

                                <!--<td field-key='name'>{{ $property->name_propiedad($property->id) }}</td>-->
                                 <td field-key='name' style="font-size: 12px;">
                               
                                    {{$property->propiedad->name}}
                                
                                 

                                  </td>
                                <td field-key='unidad' data-toggle="tooltip" title="" style="font-size: 12px;">

                                     <a href="{{ route('admin.properties_sub.show',[$property->id]) }}" style="font-size:15px">{{ $property->nombre }}
                                     </a><br/>

                             


                                 @if ($property->inquilinos()->count()>0)
                                   <span class="m-status">
                                    Ocupada
                                    </span>
                                @endif

                                  @if ($property->inquilinos()->count()==0)
                                   <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);">
                                    Disponible
                                    </span>
                                @endif


                               <!-- {{$property->estado_seguro_unidad($property->id)}}-->
                               
                               @if ($property->estado_seguro_unidad($property->id) == 2 )
                                 <a href="{{ route('admin.properties_sub.show',[$property->id]) }}">
                                    <span class="m-status" style="background:#eee;color:#000">
                                    Seguro desactivado
                                    </span>
                                      </a>
                               @endif

                                 @if ($property->estado_seguro_unidad($property->id) == 1 )
                                 <a href="{{ route('admin.properties_sub.show',[$property->id]) }}">
                                     <span class="m-status" style="background:#5cb85c;color:#fff">
                                    Seguro Activado
                                    </span>
                                      </a>
                               @endif

                                  

                                    @if ($property->seguros_unidad()->count() == 0)
                                   <div>
                                      <a href="{{ route('admin.properties_seguros.create',[$property->id]) }}">
                                   <span class="m-status" style="background:#33435a;color:#fff">
                                    Crear Seguro
                                    </span>
                                </a>
                                    </div>
                                     @endif


                                </td>
                                <td field-key='tipo'>{{ $property->tipo_propiedad_sub->tipo }}

                 @if ($property->facturas_vencidas($property->id) > 0)
                                <a href="{{ route('admin.properties_facturas.facturas_consulta',[$property->id]) }}" class="btn btn-info" data-toggle="tooltip" title="Pagar facturas" style="float:right;margin-top: 10px;">Recibir pago</a>
                @endif
                         


                                </td>
                                <td field-key='name' style="text-align:center;">
                                    <span class="label label-info" style="padding:8px;font-size:13px">
                                    $ {{ number_format($property->renta), 0, ',', '.'}}
                                    </span>
                                </td>
                                 <td field-key='tipo'>

                                    <div class="row text-center">

                                   <span class="items-round-little bg-blue" data-toggle="tooltip" title="Metros cuadrados" style="padding:3px;border-radius:2px;font-size:13px;border:2px solid #38a9ff;background-color: #fff;color:#38a9ff;margin-left:8px"> {{ $property->metros_cuadrados }} </span>
                                  
                                    <span class="items-round-little bg-blue" data-toggle="tooltip" title="Número baños" style="padding:4px;border-radius:2px;font-size:12px;border:0px solid #38a9ff;margin-left:5px;"> {{ $property->numero_banos }} </span>

                                     <span class="items-round-little bg-blue" data-toggle="tooltip" title="Número cocinas" style="padding:4px;border-radius:2px;font-size:12px;border:0px solid #38a9ff;margin-left:4px"> {{ $property->numero_cocinas }} </span> 
                                   
                                 
                                    <span class="items-round-little bg-blue" data-toggle="tooltip" title="# Parqueaderos" style="padding:3px;border-radius:2px;font-size:12px;border:2px solid #38a9ff;background-color: #fff;color:#38a9ff;margin-left:6px;margin-right:0px"> {{ $property->numero_parqueaderos }} </span>

                                </div>
                                   
                                  
                               
                                 </td>
                                   <td field-key='costo_seguro' style="text-align:center;">
                               @if (
                                        ($property->estado_seguro_unidad
                                        ($property->id))
                                        == 1)
                                   % seguro: {{ ($porc_seguro)*100}}% <br/>
                                   Costo/mes: ${{number_format($property->renta * ($porc_seguro))}} <br/>
                                @endif
                                  
                                </td>
                                <td field-key='inquilinos' style="text-align:center;font-size:14px">
                                    @if($property->inquilinos()->count() > 0 )
                                    <a href="{{route('admin.tenants.show',[$property->inquilinos->id])}}" data-toggle="tooltip" title="Id: {{$property->inquilinos->id}}" >
                                    <!--{{ $property->inquilinos()->count() }} [Ver]-->
                                     {{ $property->inquilinos->name or '' }}
                                    </a>
                                    @endif
                                  
                                </td>
                                <!--<td field-key='address'>{{ $property->address }}</td>-->
                                <!--<td field-key='inquilinos'>{{ $property->inquilinos()->count() }}</td>-->
                                <!--<td field-key='photo'>@if($property->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $property->photo) }}"/></a>@endif</td>-->
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_sub.restore', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_sub.perma_del', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                  
                                    <a href="{{ route('admin.properties_sub.show',[$property->id]) }}" class="btn btn-xs btn-primary" target="_blank">Ver unidad</a>
                                 
                                
                                    <a href="{{ route('admin.properties_sub.edit',[$property->id]) }}" target="_blank" class="btn btn-xs btn-info">editar</a>
                             
                                      @if($property->inquilinos()->count() == 0 )

                                     <a href="{{route('admin.tenants.create_tenant_propiedad_unidad',[$property->id])}}" class="btn btn-xs btn-success">+ Inquilino</a>

                                     @endif

                                    @if($property->inquilinos()->count() > 0 )

                                      <a href="{{ route('admin.properties_facturas.create',[$property->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Crear Factura">+ Factura</a>

                                    <a href="{{ route('admin.properties_facturas.facturas_consulta',[$property->id]) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" title="{{$property->facturas()->count()}}">Facturas</a>
                                    @endif

                                    @can('property_sub_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_sub.destroy', $property->id])) !!}
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
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.properties.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection