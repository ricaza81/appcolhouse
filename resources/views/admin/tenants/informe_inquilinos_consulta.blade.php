@extends('layouts.app')

@section('content')
    <h3 class="page-title">Informe Propietario</h3>
    @can('property_create')
    <p>
     <!--   <a href="{{ route('admin.tenants.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

     <p>
        <ul class="list-inline">
           

         <!--   <li><a href="{{ route('admin.tenants.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
           
            <li><a href="{{ route('admin.tenants.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>-->

        </ul>
    </p>

    <div class="panel panel-default">
       

        <div class="row">
             <div class="col-md-1"></div>
         
        <div class="col-md-10">
            @if ($msj != NULL)
            <div class="alert alert-success" style="color:#008d4c;margin-top:20px"> {{$msj}}</div>
           
            @endif
             <div class="panel-heading" style="margin-top: 31px;">
            <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Generar Informe</b></h4>
        </div>

           <div class="col-md-3 form-group">
          
                   
                      {!! Form::open(['method' => 'POST', 'route' => ['admin.tenants.informe_inquilinos_consulta_fechas']]) !!}
                   
                     <input type="hidden" name="id_propiedad" value="<?=$id_propiedad;?>" id="id_propiedad">
                     <input type="hidden" name="id_propietario" value="<?=$id_propietario;?>" id="id_propietario">
                        {!! Form::label('fecha_inicio_informe', 'Desde *', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_inicio_informe', old('fecha_inicio_informe'), ['class' => 'form-control', 'placeholder' => 'Fecha inicio', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_inicio_informe'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_inicio_informe') }}
                                            </p>
                                        @endif
                  </div>
                  <div class="col-md-3 form-group">
                          {!! Form::label('fecha_fin_informe', 'Hasta *', ['class' => 'control-label']) !!}
                        {!! Form::date('fecha_fin_informe', old('fecha_fin_informe'), ['class' => 'form-control', 'placeholder' => 'Fecha final informe', 'required' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('fecha_fin_informe'))
                            <p class="help-block">
                            {{ $errors->first('fecha_fin_informe') }}
                            </p>
                            @endif

                       
                    </div>
                     <div class="col-md-3 form-group" style="margin-top: 7px;"><br/>
                      {!! Form::submit(trans('Consultar'), ['class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                    </div>
            </div>
                
    <div class="row">
         <div class="col-md-1"></div>

        <div class="col-md-10">
            <div class="title" style="color:#000">
                @if ($fecha_inicio_informe != NULL)
                <h3>Período consultado: {{date('d/F/Y', strtotime($fecha_inicio_informe)) }}- {{date('d/F/Y', strtotime($fecha_fin_informe))}}</h3>
                @else
                <h1>Por favor selecciona un período</h1>
                @endif
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($tenants) > 0 ? 'datatable' : '' }}">
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
                                      <a href="{{ route('admin.properties_propietarios.index',[$tenant->property->id])}}" data-toggle="tooltip" title="Consultar" style="color:#000">  
                                        {{ $tenant->property->propietarios2($tenant->property->id)->nombre }}
                                      </a><br/>
                                      <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);float:left;text-transform:capitalize;">
                                            Cédula: {{ $tenant->property->propietarios2($tenant->property->id)->cedula }}
                                        </span>
                            </td>
                            <td field-key='unidad'>{{ $tenant->subproperty->nombre or '' }}
                            </td>

                            @if(isset($tenant->subproperty->renta))
                            <td field-key='renta'>{{number_format($tenant->subproperty->renta) }}
                            </td>
                            @endif

                             @if(empty($tenant->subproperty->renta))
                            <td field-key='renta'>$0
                            </td>
                            @endif

                            <td field-key='inquilino'><a href="{{ route('admin.tenants.show',[$tenant->id]) }}">
                                {{ $tenant->name }}
                            </a>
                            </td>

                            <td field-key='seguro'>
                              
                                  @if($tenant->seguro_tenant($tenant->id) != NULL ) 
                                           <a href="{{ route('admin.properties_sub.show',[$tenant->subproperty->id]) }}">
                                            <span class="m-status" style="background:#5cb85c;color:#fff;float:left;">
                                            Si
                                            </span>
                                            </a>
                                         @else
                                            <a href="{{ route('admin.properties_sub.show',[$tenant->subproperty->id]) }}">
                                            <span class="m-status" style="background:#d7564a;color:#fff;float:left;">
                                            No
                                            </span>
                                            </a>
                                @endif
                               </td>
                               <td>
                                ${{ number_format($tenant->valor_pagado_periodo($tenant->id, $fecha_inicio_informe, $fecha_fin_informe)), 0, ',', '.' }}
                               </td>

                                <td field-key='porpagar' style="text-align:center;">
                                <!--${{number_format($tenant->valor_adeudado($tenant->id)) }}-->
                                ${{number_format($tenant->facturas2($tenant->id)-$tenant->facturas_pagadas($tenant->id)), 0, ',', '.'}}
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
        



        <div class="col-md-5" style="background:#fff;">
            Deducciones
             @if ($fecha_inicio_informe != NULL)
                <h5>Período consultado: {{date('d/F/Y', strtotime($fecha_inicio_informe)) }}- {{date('d/F/Y', strtotime($fecha_fin_informe))}}</h5>
                @else
                <h4>Por favor selecciona un período</h4>
                @endif
           <div class="panel-body table-responsive" style="background:#fff;">
            <div class="row">
         

              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                          <th>Valor</th>
                          <th>Fecha</th>
                    </tr>
                </thead>

              <tbody>
               @if (count($deducciones_detalles) > 0)
                        @foreach ($deducciones_detalles as $deduccion)
                          <tr data-entry-id="{{ $deduccion->id }}">
                             <td field-key='name'>${{number_format($deduccion->valor)}}<br/>
                                {{$deduccion->observaciones}}
                             </td>
                              <td field-key='name'>{{date('d/F/Y', strtotime($deduccion->fecha_deduccion))}}</td>
                            
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
  

        <div class="col-md-7" style="background:#fff;">
            Consolidado
            @if($fecha_inicio_informe != NULL)
             <h4>Período consultado: {{date('d/F/Y', strtotime($fecha_inicio_informe)) }}- {{date('d/F/Y', strtotime($fecha_fin_informe))}}</h4>
            @else
            <h4>Por favor selecciona un período</h4>
            @endif
        
        <div class="panel-body table-responsive" style="background:#fff;">
            <div class="row">
              <table class="table table-bordered table-striped">
        <thead>
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
           
         <tbody>
            <tr>
                <th>Valor a pagar al propietario</th>
                 <td>${{number_format(
                    $valor_pagar
                    )}}
                </td>
            </tr>
        </tbody>
    </thead>
    </table>
     @if ($fecha_inicio_informe != NULL)
               

                  {!! Form::open(['method' => 'POST', 'route' => ['admin.tenants.imprimir_informe']
                  ]) !!}
                   
                     <input type="hidden" name="id_propiedad" value="<?=$id_propiedad;?>" id="id_propiedad">
                     <input type="hidden" name="id_propietario" value="<?=$id_propietario;?>" id="id_propietario">
                     <input type="hidden" name="fecha_inicio_informe" value="<?=$fecha_inicio_informe;?>" id="fecha_inicio_informe">
                       <input type="hidden" name="fecha_fin_informe" value="<?=$fecha_fin_informe;?>" id="fecha_fin_informe">
                    <div class="form-group">
                        <!--  <label>Email Propietario</label>
                          <input type="text" style="width:300px" name="email_propietario1" value="<?=$propietario->email;?>" id="email_propietario1">-->
                    </div>
                 
                   {!! Form::submit(trans('Descargar PDF'), [
                   'class' => 'btn btn-success',
                   'style' => 'margin-top: 20px;'
                   ]) !!}
                    {!! Form::close() !!}
                @else
                <h4></h4>
                @endif
           @if ($fecha_inicio_informe != NULL)
               

                  {!! Form::open(['method' => 'POST', 'route' => ['admin.tenants.crearEXCELview']
                  ]) !!}
                   
                     <input type="hidden" name="id_propiedad" value="<?=$id_propiedad;?>" id="id_propiedad">
                     <input type="hidden" name="id_propietario" value="<?=$id_propietario;?>" id="id_propietario">
                     <input type="hidden" name="fecha_inicio_informe" value="<?=$fecha_inicio_informe;?>" id="fecha_inicio_informe">
                       <input type="hidden" name="fecha_fin_informe" value="<?=$fecha_fin_informe;?>" id="fecha_fin_informe">
                    <div class="form-group">
                       <!--   <label>Email Propietario</label>
                          <input type="hidden" style="width:300px" name="email_propietario1" value="<?=$propietario->email;?>" id="email_propietario1">-->
                    </div>
                 
                   {!! Form::submit(trans('Descargar Excel'), [
                   'class' => 'btn btn-success',
                   'style' => 'margin-top: 20px;margin-left: 39px;'
                   ]) !!}
                    {!! Form::close() !!}
                @else
                <h4></h4>
                @endif

         @if ($fecha_inicio_informe != NULL)
               

                  {!! Form::open(['method' => 'POST', 'route' => ['admin.tenants.enviar_informe']
                  ]) !!}
                   
                   <div class="row">
                          <input type="text" name="email_propietario" value="<?=$propietario->email;?>" id="email_propietario" style="margin-left: 20px;width:300px">
                    </div>
                     <input type="hidden" name="id_propiedad" value="<?=$id_propiedad;?>" id="id_propiedad">
                     <input type="hidden" name="id_propietario" value="<?=$id_propietario;?>" id="id_propietario">
                     <input type="hidden" name="fecha_inicio_informe" value="<?=$fecha_inicio_informe;?>" id="fecha_inicio_informe">
                     <input type="hidden" name="fecha_fin_informe" value="<?=$fecha_fin_informe;?>" id="fecha_fin_informe">

                  
                 
                   {!! Form::submit(trans('Enviar PDF al Propietario'), [
                   'class' => 'btn btn-info',
                   'style' => 'margin-top: 13px;margin-left: 10px;'
                   ]) !!}
                    {!! Form::close() !!}
                @else
                <h4></h4>
                @endif

</div>
</div>
</div>
</div>
</div>
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
  <!--  <script>
        @can('property_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.tenants.mass_destroy') }}'; @endif
        @endcan

    </script> -->
@endsection

