@extends('layouts.app')
<!-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
    <!-- Datepicker Files -->
    <!--<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.min.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">-->
  
@section('content')
    <h3 class="page-title">Propietarios</h3>
     <a href="{{ route('admin.properties_propietarios.index',[$property->id]) }}" class="btn btn-success">@lang('global.app_back_to_list')</a>

      <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
             <a href="{{ route('admin.properties_propietarios.edit',[$propietario->id]) }}" data-toggle="tooltip" title="Editar Propietario">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                    </span>
                </a>
        </div>

       <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-3" style="max-width: 31%;">
                      <table class="table table-bordered">

                        @can('properties_propietarios_view')
                                            <a target="_blank" href="{{ route('admin.properties_propietarios.edit',[$propietario->id]) }}" class="" style="color:#fff" data-toggle="tooltip" title="{{$propietario->id}}" style="color:#fff;padding:0px">
                                               <span class="label label-info" style="margin-left:10px;padding:10px;color:#fff">Editar propietario
                                               </span>
                                            </a>
                        @endcan
                        @can('properties_propietarios_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("¿Quieres eliminar este propietario?")."');",
                                        'route' => ['admin.properties_propietarios.destroy', $propietario->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                        @endcan

                        <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Datos de Contacto</b></h4>
                         <tr>
                            <th>Propietario</th>
                            <td field-key='propietario'>
                                <a data-toggle="tooltip" title="Propietario: {{$propietario->id_property}}">
                                {{ $propietario->nombre }}
                                </a>
                            </td>
                        </tr>
                         <tr>
                            <th>Unidad Principal<br/><br/>
                             Creada el: {{ date('d/F/Y',strtotime($property->created_at)) }}</th>
                            <td field-key='propietario_empresa'>
                                <a href="{{route ('admin.properties_sub.unidades_consulta',[($property->id)])}}" data-toggle="tooltip" title="Detalles: {{$property->name}}" target="_blank">
                                {{ $propietario->propiedad->name }}<br/>
                                {{ $property->tipo_propiedad->tipo }}<br/>

                                # Unidades: {{ $property->unidades()->count() }}<br/>
                                # Ocupadas: {{ $property->inquilinos()->count() }}<br/>
                                 <a href="{{route('admin.properties_sub.unidades_consulta',[$property->id])}}" class="friend-count-item" 
                                        data-toggle="tooltip" title="Número unidades aseguradas">
                                          <div class="title" style="float:left;"># Aseguradas:
                                          </div>
                                           <div class="items-round-little bg-primary" style="float:right">{{ $property->seguros()->count() }}
                                          </div>
                                </a>                             
                            </td>
                        </tr>
                       
                        <tr>
                             <th>Cédula</th>
                            <td field-key='propietario_empresa'>
                                <a  data-toggle="tooltip" title="Propietario: {{$propietario->id_property}}">
                                {{ $propietario->cedula }}
                                </a>
                            </td>
                         </tr>
                          <tr>
                             <th>Teléfono</th>
                            <td field-key='propietario_empresa'>
                                <a  data-toggle="tooltip" title="Propietario: {{$propietario->phone}}">
                                {{ $propietario->phone }}
                                </a>
                            </td>
                         </tr>
                          <tr>
                             <th>Email</th>
                            <td field-key='propietario_empresa'>
                                <a href="mailto:{{ $propietario->email }}" data-toggle="tooltip" title="Propietario: {{$propietario->email}}">
                                {{ $propietario->email }}
                                </a>
                            </td>
                         </tr>
                          <tr>
                             <th>Dirección propietario</th>
                            <td field-key='propietario_empresa'>
                                <a data-toggle="tooltip" title="Propietario: {{$propietario->direccion}}">
                                {{ $propietario->direccion }}
                                </a>
                            </td>
                         </tr>
                          <tr>
                             <th>Porc.(%) Administracion</th>
                            <td field-key='propietario_empresa'>
                                <a data-toggle="tooltip" title=" {{$propietario->porc_comision}}%">
                                {{ $propietario->porc_comision }} %
                                </a>
                            </td>
                         </tr>
                          <tr>
                             <th>Observaciones</th>
                            <td field-key='propietario_empresa'>
                                <a data-toggle="tooltip" title="Observaciones: {{$propietario->observaciones}}">
                                {{ $propietario->observaciones }}
                                </a>
                            </td>
                         </tr>
                    </table>
                </div>
              
          
                 <div class="col-md-3">
                     <table class="table table-bordered">
                        <!--<tr>
                            <th>@lang('global.properties.fields.name')</th>
                       
                            <td field-key='name'>{{ $property->name }}</td>
                        </tr>-->
                         <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Detalles (desde siempre)</b></h4>
                       
                        <tr>
                             <th>Valor total arrendamiento</th>

                            <td>
                                <h4 style="font-weight:700;padding-top:8px">${{number_format($property->valor_total_arrendamiento($property->id)), 0, ',', '.'}}
                                </h4>
                            </td>
                         </tr>
                         <tr>
                               <th>Ocupación Actual</th>
                            <td>
                                <h4 style="font-weight:700;padding-top:0px">
                                    ${{ number_format($property->valor_ocupacion_actual($property->id)), 0, ',', '.'}}
                                </h4>
                            </td>
                        </tr>
                          <tr>
                               <th>Ingresos por pagos de arriendo</th>
                            <td>
                                <a> <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{ number_format($property->facturas_pagadas_propiedad($property->id)), 0, ',', '.'}}</h4>
                                </span>
                            </a>
                            </td>
                        </tr>
                         <tr>
                               <th>Costo administracion</th>
                            <td>
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{ number_format($property->facturas_pagadas_propiedad($property->id)*$propietario->porc_comision/100), 0, ',', '.'}}</h4>
                                </span>
                            </td>
                        </tr>
                           <tr>
                               <th>Deducciones</th>
                            <td>
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{ number_format($total_deducciones)}}</h4>
                                </span>
                            </td>
                        </tr>
                             <th>Costo Seguros<br/>

                                @if ($property->seguros()->count() > 0 )
                                
                                 Desde: {{date('d/F/Y', strtotime($property->seguros->fecha_inicio))}}<br/>
                                 Hasta: {{date('d/F/Y', strtotime($property->seguros->fecha_fin))}}<br/>
                                 # meses corridos: {{$meses_seguro_fecha}}<br/>
                                 # meses total: {{$meses_seguro_total}}<br/>
                                @endif
                                
                             </th>
                            <td>
                                <a href="{{route('admin.properties_sub.unidades_consulta',[$property->id])}}" class="friend-count-item" 
                                        data-toggle="tooltip" title="Número unidades aseguradas">
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">
                                    <!--${{ number_format($property->facturas_pagadas_propiedad($property->id)*2/100), 0, ',', '.'}}<br/>-->
                                    ${{number_format(
                                    $property->costo_seguros($property->id)*$meses_seguro_fecha
                                    )
                                    , 0, ',', '.'}}
                                </h4>
                                </span>
                                </a>
                            </td>
                        </tr>
                         <tr>
                               <th>Ingresos Netos</th>
                            <td>
                                <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
<h4 style="font-weight:700;">
${{number_format(
$property->facturas_pagadas_propiedad($property->id) -
$property->facturas_pagadas_propiedad($property->id)*$propietario->porc_comision/100 -
$property->costo_seguros($property->id)*$meses_seguro_fecha -
$total_deducciones
), 0, ',', '.'}}
</h4>
                                </span>
                            </td>
                        </tr>
                        </table>
                    
                 </div>
               
                   
              
                   <div class="col-md-5" style="border:4px solid #eee;padding:7px;background:#f9f9f9;border-radius: 5px;">
                     
                      <table class="table table-bordered table-striped">
                    <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Consulta</b></h4>
                   
                      {!! Form::open(['method' => 'POST', 'route' => ['admin.properties_propietarios.informe_fechas']]) !!}
                    <input type="hidden" name="id_propietario" value="<?=$propietario->id;?>" id="id_propietario">
                    <input type="hidden" name="id_property" value="<?=$property->id;?>" id="id_property">
                      <div class="col-md-6 form-group">
                        {!! Form::label('fecha_inicio_informe', 'Desde *', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_inicio_informe', old('fecha_inicio_informe'), ['class' => 'form-control', 'placeholder' => 'Fecha inicio', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_inicio_informe'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_inicio_informe') }}
                                            </p>
                                        @endif
   <!--                 <div class="form-group">
                            <label for="date">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="fechaproximavisita">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>-->
                 </div>
                  <div class="col-md-6 form-group">
                          {!! Form::label('fecha_fin_informe', 'Hasta *', ['class' => 'control-label']) !!}
                        {!! Form::date('fecha_fin_informe', old('fecha_fin_informe'), ['class' => 'form-control', 'placeholder' => 'Fecha final informe', 'required' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('fecha_fin_informe'))
                            <p class="help-block">
                            {{ $errors->first('fecha_fin_informe') }}
                            </p>
                            @endif

                         {!! Form::submit(trans('Consultar'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
                    </div>
                     <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Resultados de la Consulta</b></h4>
                           <tr>
                               <th># Meses consultados</th>
                                <td>
                                    {{$meses_seguro_consulta}}
                                </td>

                     
                          <tr>
                               <th>Ingresos por pagos de arriendo</th>
                            <td>
                                <a> <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{ number_format($resul), 0, ',', '.'}}</h4>
                                </span>

                            </a>
                            </td>
                        </tr>
                         <tr>
                               <th>Costo administracion</th>
                            <td>
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{ number_format($resul *$propietario->porc_comision/100), 0, ',', '.'}}</h4>
                                </span>
                            </td>
                        </tr>
                              <th>Deducciones</th>
                            <td>
                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">
                                ${{ number_format($total_deducciones)}}</h4>
                                </span>
                            </td>
                        </tr>
                          <tr>
                               <th>Costo Seguros consulta: <br/>
                                   @if ($property->seguros()->count() > 0 )
                                    # meses corridos: {{$meses_seguro_consulta}}<br/>
                                 $ / mes: ${{
                                    number_format
                                    ($property->costo_seguros($property->id)*($meses_seguro_consulta)), 0, ',', '.'}}
                                    @endif
                               </th>
                            <td>

                                <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">
                                    ${{number_format(
                                    $property->costo_seguros($property->id)*$meses_seguro_consulta
                                    )
                                    , 0, ',', '.'}}</h4>
                                </span>
                            </td>
                        </tr>
                         <tr>
                               <th>Ingresos Netos Consulta</th>
                            <td>
                                <span class="label label-success" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                               <h4 style="font-weight:700;">
${{number_format(
$resul - 
$resul *$propietario->porc_comision/100 -
 $property->costo_seguros($property->id)*$meses_corridos
), 0, ',', '.'}}
</h4>
                                </span>
                            </td>
                        </tr>
                        </table>
                    
                 </div>  
            </div>

          
            


            <p>&nbsp;</p>




    
     


      <a href="{{ route('admin.properties_propietarios.index',[$property->id]) }}" class="btn btn-success">@lang('global.app_back_to_list')</a>
        </div>
    </div>
 <!--     <script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>-->
    <!-- Languaje -->
 <!--   <script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
<script>
 $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: "es",
        autoclose: true
    });
</script>-->

@stop