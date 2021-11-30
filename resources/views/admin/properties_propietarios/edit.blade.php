@extends('layouts.app')

@section('content')
    <h3 class="page-title">Editar Propietario</h3>
     {!! Form::model($propietario, ['method' => 'PUT', 'route' => ['admin.properties_propietarios.update', $propietario->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
           Editar
        </div>
        <div class="panel-body">



               <div class="row" style="padding:10px;">
                    <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Propiedad principal:
                        <h3><b>{{$propietario->propiedad->name}}</b></h3>
                   
             
                    <input type="hidden" name="id_property" value="<?=$propietario->id_property;?>" id="id_property">
                   
                  

              
                 <!--<div class="col-xs-3 form-group">
                        {!! Form::label('fecha_inicio_contrato', trans('global.tenants.fields.fecha_inicio_contrato').'*', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_inicio_contrato', old('fecha_inicio_contrato'), ['class' => 'form-control', 'placeholder' => 'Fecha inicio', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_inicio_contrato'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_inicio_contrato') }}
                                            </p>
                                        @endif
                 </div>
                  <div class="col-xs-3 form-group">
                          {!! Form::label('duracion_contrato', trans('global.tenants.fields.duracion_contrato').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('duracion_contrato', old('duracion_contrato'), ['class' => 'form-control', 'placeholder' => 'Duración del contrato', 'required' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('duracion_contrato'))
                            <p class="help-block">
                            {{ $errors->first('duracion_contrato') }}
                            </p>
                            @endif
                    </div>
                </div>-->

                <div class="panel panel-default" style="padding:20px;padding-bottom:0px;">
                    <div class="panel-heading" style="font-size:18px;font-weight:700;background-color:#d1ecf1;color:#0c5460;border:2px solid #bee5eb;">
                            Propietario
                    </div>
                    <div class="row" style="padding-top:15px;">
                            <div class="col-xs-2 form-group">
                                {!! Form::label('nombre', trans('global.tenants.fields.name').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre propietario', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('nombre'))
                                    <p class="help-block">
                                        {{ $errors->first('nombre') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-xs-2 form-group">
                                {!! Form::label('cedula', trans('global.tenants.fields.cedula').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('cedula', old('cedula'), ['class' => 'form-control', 'placeholder' => 'Cédula del propietario', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('cedula'))
                                    <p class="help-block">
                                        {{ $errors->first('cedula') }}
                                    </p>
                                @endif
                            </div>
                             <div class="col-xs-2 form-group">
                                {!! Form::label('phone', trans('global.tenants.fields.phone').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Télefono del propietario', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('phone'))
                                    <p class="help-block">
                                        {{ $errors->first('phone') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-xs-2 form-group">
                                {!! Form::label('email', trans('global.tenants.fields.email').'*', ['class' => 'control-label']) !!}
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email del propietario', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('email'))
                                    <p class="help-block">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                             <div class="col-xs-4 form-group">
                                {!! Form::label('direccion', 'Dirección', ['class' => 'control-label']) !!}
                                {!! Form::text('direccion', old('direccion'), ['class' => 'form-control', 'placeholder' => 'Dirección del propietario', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('direccion'))
                                    <p class="help-block">
                                        {{ $errors->first('direccion') }}
                                    </p>
                                @endif
                            </div>
                               <div class="col-xs-4 form-group">
                                {!! Form::label('porc_comision', 'Porcentaje de Administración (%)', ['class' => 'control-label']) !!}
                                {!! Form::number('porc_comision', old('porc_comision'), ['class' => 'form-control', 'placeholder' => 'Escribe el (%)', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('porc_comision'))
                                    <p class="help-block">
                                        {{ $errors->first('porc_comision') }}
                                    </p>
                                @endif
                            </div>
                       <div class="col-xs-12 form-group">
                                {!! Form::label('observaciones','Observaciones', ['class' => 'control-label']) !!}
                                {!! Form::textarea('observaciones', old('referencias'), ['class' => 'form-control','rows' => 1, 'placeholder' => '¿Alguna nota para este propietario?', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('observaciones'))
                                    <p class="help-block">
                                        {{ $errors->first('observaciones') }}
                                    </p>
                                @endif
                            </div>
                            
                    </div>
                </div>
                </div>
            </div>
        </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

