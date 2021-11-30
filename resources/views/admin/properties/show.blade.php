@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.properties.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
              <a href="{{ route('admin.properties.edit',[$property->id])}}" data-toggle="tooltip" title="Editar Propiedad">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                    </span>
                </a>
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                   
                        
                     <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.properties.fields.name')</th>
                            <td field-key='name'>{{ $property->name }}</td>
                            <th>@lang('global.properties.fields.tipo')</th>
                            <td field-key='address'>
                                {{ $property->tipo_propiedad->tipo }}
                            </td>
                             <th>Valor total arrendamiento</th>
                            <td>
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($property->valor_total_arrendamiento($property->id)), 0, ',', '.'}}</h4>
                                </span>
                            </td>
                               <th>Ocupación Actual<br/>
                                 <h6 style="font-weight:700;"><br/>Fecha de creación:<br/>{{$property->created_at->format('d/F/Y')}}
                                 </h6>
                                </span>
                               </th>
                            <td>
                                <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{ number_format($property->valor_ocupacion_actual($property->id)), 0, ',', '.'}}</h4>
                                <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                               

                                </span>
                                

                            </td>
                           
                        </tr>
                        </table>
                     <table class="table table-bordered table-striped">
                        <tr>
                             <th>Propietario</th>
                             <td field-key='propietarios'>
                               @if ($property->propietarios() > 0)
                                <a href="{{
                                route('admin.properties_propietarios.show',
                                [$property->propietarios2($property->id)->id])
                                }}">
                                {{ $property->propietarios2($property->id)->nombre or ''}}
                                </a>
                                @endif
                             </td>
                            <th>@lang('global.properties.fields.address')</th>
                            <td field-key='address'>{{ $property->address or ''}}</td>
                        </tr>
                        
                        <tr>
                            <th>@lang('global.properties.fields.photo')</th>
                            <td field-key='photo'>@if($property->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $property->photo) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-pills" role="tablist">

<li role="presentation" class="active"><a href="#unidades" aria-controls="unidades" role="tab" data-toggle="tab">Unidades</a></li>

<li role="presentation" class=""><a href="#facturas2" aria-controls="facturas2" role="tab" data-toggle="tab">Facturas</a></li>

<li role="presentation" class=""><a href="#inquilinos" aria-controls="inquilinos" role="tab" data-toggle="tab">Inquilinos</a></li>

<!--<li role="presentation" class=""><a href="#seguros" aria-controls="seguros" role="tab" data-toggle="tab">Seguros</a></li>-->


</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="unidades">
<table class="table table-bordered table-striped {{ count($unidades) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
                       <th>@lang('global.properties_sub.fields.nombre')</th>
                       <th>@lang('global.properties_sub.fields.tipo_sub')</th>
                       <th>@lang('global.properties_sub.fields.renta')</th>
                       <th>@lang('global.properties_sub.fields.generales')</th>
                       <th>Inquilino(s)</th>
                       
                      <!--  @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif-->
        </tr>
    </thead>
        <tbody>   
               @foreach ($property->unidad as $unidad)
                    <tr data-entry-id="{{ $unidad->id }}">
                        <td field-key='subproperty'>

                             <a href="{{route('admin.properties_sub.show',[$unidad->id])}}">
                            {{ $unidad->nombre or '' }}
                                   @if ($unidad->seguros_unidad()->count() > 0)
                                   <div>
                                   <a href="{{ route('admin.properties_seguros.show',[$unidad->seguros->id]) }}">
                                    <span class="m-status" style="background:#5cb85c;color:#fff">
                                    Ver Seguro
                                    </span>
                                </a>
                                </div>
                                     @endif

                                    @if ($unidad->seguros_unidad()->count() == 0)
                                   <div>
                                      <a href="{{ route('admin.properties_seguros.create',[$unidad->id]) }}">
                                   <span class="m-status" style="background:#33435a;color:#fff">
                                    Crear Seguro
                                    </span>
                                </a>
                                    </div>
                                     @endif
                             </a>


                               @if ($unidad->inquilinos()->count()>0)
                                   <span class="m-status">
                                    Ocupada
                                    </span>
                                @endif

                                  @if ($unidad->inquilinos()->count()==0)
                                   <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);">
                                    Disponible
                                    </span>
                                @endif

                        </td>
                        <td field-key='subproperty_tipo'>{{ $unidad->tipo_propiedad_sub->tipo or '' }}</td>
                        <td field-key='name' style="text-align:center;">
                                        <span class="label label-info" style="padding:8px;font-size:13px">
                                        $ {{ number_format($unidad->renta), 0, ',', '.'}}
                                        </span>
                        </td>
                        <td field-key='tenant'>
                            <div class="row text-center">
                                <span class="items-round-little bg-blue" data-toggle="tooltip" title="Metros cuadrados" style="padding:5px;border-radius:2px;font-size:13px;border:2px solid #38a9ff;background-color: #fff;color:#38a9ff"> {{ $unidad->metros_cuadrados }}
                                </span>
                                <span class="items-round-little bg-blue" data-toggle="tooltip" title="Número baños" style="padding:5px;border-radius:2px;font-size:12px"> {{ $unidad->numero_banos }}
                                </span>
                                  <span class="items-round-little bg-blue" data-toggle="tooltip" title="Número cocinas" style="padding:4px;border-radius:2px;font-size:12px;border:0px solid #38a9ff;margin-left:4px"> {{ $unidad->numero_cocinas }} </span> 
                                <span class="items-round-little bg-blue" data-toggle="tooltip" title="# Parqueaderos" style="padding:5px;border-radius:2px;font-size:12px;border:2px solid #38a9ff;background-color: #fff;color:#38a9ff"> {{ $unidad->numero_parqueaderos }}
                                </span>
                            </div>
                        </td>
                       <td field-key='inquilinos' style="text-align:center;font-size:14px">
                                    @if($unidad->inquilinos()->count() > 0 )
                                    <a href="{{route('admin.tenants.show',[$unidad->inquilinos->id])}}">
                                    <!--{{ $property->inquilinos()->count() }} [Ver]-->
                                     {{ $unidad->inquilinos->name or '' }}
                                    </a>
                                    @endif
                                  
                                </td>           
                    </tr>
                @endforeach     
               <!-- <tr>
                    <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                </tr>-->

        </tbody>
</table>
</div>

<div role="tabpanel" class="tab-pane" id="facturas2">
     <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($facturas) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('global.notes.fields.property')</th>
                        <th># Factura</th>
                        <th>@lang('global.facturas.fields.valor_neto')</th>
                        <th>@lang('global.facturas.fields.fechafactura')</th>
                        <th>@lang('global.facturas.fields.fechainicio')</th>
                        <th>@lang('global.facturas.fields.fechacorte')</th>
                        <th>@lang('global.facturas.fields.valorpago')</th>
                        <th>Comision</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($facturas) > 0)
                                    @foreach ($facturas as $note)
                                        <tr data-entry-id="{{ $note->id }}">
                                            <td field-key='property'>{{ $note->property->name or '' }}</td>
                        <td field-key='user'>COL-FT-{{ $note->id or '' }} <br/>

                                                 @if (($note->valor_neto)-($note->pago2($note->id))!=0)
                                                @if(($note->fecha_corte) <= Now())
                                 <span class="label label-danger" style="text-align:center;padding:10px;font-size:15px">Vencida
                                 </span>
                                                @endif
                                                @endif

                                    @if($note->id_estado=='2')
                                      <span class="label label-warning" style="text-align:center;padding:10px;font-size:12px">
                                        @if(isset($note->pago_valor->id))
                                         <a target="_blank" href="{{ route('admin.properties_pagos.show',[$note->pago_valor->id])}}"data-toggle="tooltip" title="Ver Pago" style="color:#fff;padding:0px">
                                            Ver pago
                                        </a>
                                        @endif
                                    </span>
                                      <span class="label label-success" style="text-align:center;padding:10px;font-size:15px;color:#fff">
                                            {{($note->estado->estado)}}
                                    </span>
                                    @endif


                                                @if($note->id_estado=='1')
                                                     
                                                        <a href="{{ route('admin.properties_pagos.create',[$note->id]) }}" class="label label-success" style="padding:10px;font-size:16px">Recibir pago</a>
                                                 
                                                @endif

                        </td>
                                            <td field-key='valor'>${{number_format($note->valor_neto), 0, ',', '.' or '' }}</td>
                                            <td field-key='fechafactura'>{!! $note->created_at->format('d/F/Y') !!}</td>
                                            <td field-key='fecha_inicio'>{!! date('d/F/Y', strtotime($note->fecha_inicio)) !!}</td>
                                            <td field-key='fecha_corte'>{!! date('d/F/Y', strtotime($note->fecha_corte)) !!}</td>
                                            <td field-key='valor'>${{number_format($note->pago2($note->id)), 0, ',', '.' or '' }}
                                            </td>
                                            <td field-key='comision'>
                                            </td>
                                                @if( request('show_deleted') == 1 )
                                            <td>
                                                            {!! Form::open(array(
                                                                'style' => 'display: inline-block;',
                                                                'method' => 'POST',
                                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                                'route' => ['properties_facturas.restore', $note->id])) !!}
                                                            {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                                            {!! Form::close() !!}
                                                                                            {!! Form::open(array(
                                                                'style' => 'display: inline-block;',
                                                                'method' => 'DELETE',
                                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                                'route' => ['facturas.perma_del', $note->id])) !!}
                                                            {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                                            {!! Form::close() !!}
                                            </td>
                                                        @else
                                            <td>
                                                            @can('properties_facturas_access')
                                                              <a href="{{ route('admin.properties_facturas.show',[$note->id]) }}" class="btn btn-xs btn-primary">Ver factura</a>

                                                            @endcan
                                                            @can('properties_facturas_edit')
                                                            <a href="{{ route('admin.properties_facturas.edit',[$note->id]) }}" class="btn btn-xs btn-info">Editar factura</a>
                                                            @endcan
                                                            @can('delete')
                                                            {!! Form::open(array(
                                                                'style' => 'display: inline-block;',
                                                                'method' => 'DELETE',
                                                                'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                                                'route' => ['admin.properties_facturas.destroy', $note->id])) !!}
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



<div role="tabpanel" class="tab-pane" id="inquilinos">
<table class="table table-bordered table-striped {{ count($inquilinos) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.tenants.fields.name')</th>
            <th>@lang('global.tenants.fields.cedula')</th>
            <th>@lang('global.properties.fields.name')</th>
            <th>@lang('global.properties_sub.fields.nombre')</th>
            <th>@lang('global.tenants.fields.email')</th>
            <th>@lang('global.tenants.fields.codeudor')</th>
            <th>@lang('global.tenants.fields.fechainicio')</th>
            
              
        </tr>
    </thead>

    <tbody>
        @if (count($inquilinos) > 0)
            @foreach ($inquilinos as $inquilino)
             <tr">
                <td field-key='inquilino'>
                    <a href="{{ route('admin.tenants.show',[$inquilino->id])}}" data-toggle="tooltip" title="Consultar" style="color:#000">  
                            {{ $inquilino->name }}
                      </a>

                         @if($inquilino->facturas2($inquilino->id)-
                                            $inquilino->facturas_pagadas($inquilino->id)!=0)

                                <a href="{{ route('admin.properties_facturas.facturas_tenant',[$inquilino->id]) }}" class="btn btn-xs btn-info" style="float:right;">Recibir pago</a>
                                @endif
                </td>
                <td field-key='property'>{{ $inquilino->cedula or '' }}</td>
                <td field-key='property'>{{ $inquilino->property->name or '' }}</td>
                <td field-key='unidad'>{{ $inquilino->subproperty->nombre or ''}}</td>
                <td field-key='inquilinoemail'>{{ $inquilino->email or '' }}</td>
                <td field-key='inquilinocodeudor'>{{ $inquilino->codeudor or ''}}</td>
                <td field-key='inquilinocodeudor'>{{ date('d/F/Y', strtotime($inquilino->fecha_inicio_contrato)) or '' }}</td>
                
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

<!--<div role="tabpanel" class="tab-pane" id="seguros">

      <div class="panel-heading">
              @if (count($seguros) == 0)
              <a href="{{ route('admin.properties_seguros.create',[$property->id])}}" data-toggle="tooltip" title="Crear Seguro" target="_blank">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Crear Seguro
                    </span>
                </a>
                @endif
        </div>


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>@lang('global.seguros.fields.empresa')</th>
            <th>@lang('global.seguros.fields.property')</th>
            <th># Unidades</th>
            <th>@lang('global.seguros.fields.fechainicio')</th>
            <th>@lang('global.seguros.fields.fechafin')</th>
            <th>@lang('global.seguros.fields.costo')</th>
            <th>@lang('global.seguros.fields.cobertura')</th>
             @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
           
        </tr>
    </thead>

    <tbody>
        @if (count($seguros) > 0)
            @foreach ($seguros as $seguro)
             <tr>
            <td field-key='property'>{{ $seguro->empresa }}</td>
             <td field-key='property'>{{ $seguro->propiedad->name }}</td>
             <td field-key='#unidades'>{{ count($unidades) }}</td>
             <td field-key='property'>{!! date('d/F/Y', strtotime($seguro->fecha_inicio))!!}</td>
             <td field-key='property'>{!! date('d/F/Y', strtotime($seguro->fecha_fin))!!}</td>
             <td field-key='property'>${{number_format($seguro->valor), 0, ',', '.' or '' }}</td>
             <td field-key='property'>${{number_format($seguro->cobertura), 0, ',', '.' or '' }}</td>
               <td>
                                
                                    <a href="{{ route('admin.properties_seguros.show',[$seguro->id]) }}" class="btn btn-xs btn-primary" target="_blank">@lang('global.app_view')</a>
                                 

                                    
                </td>
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

-->

</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.properties.index') }}" class="btn btn-success">@lang('global.app_back_to_list')</a>
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
