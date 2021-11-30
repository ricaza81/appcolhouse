@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.properties_sub.title')</h3>
    
    {!! Form::model($property, ['method' => 'PUT', 'route' => ['admin.properties_sub.update', $property->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">

                 <input type="hidden" name="id_tenant" value="<?=$property->id_tenant;?>" id="id_tenant">
                  <input type="hidden" name="property_sub_id" value="<?=$property->id;?>" id="property_sub_id">

                <div class="col-xs-4 form-group">
                    {!! Form::label('nombre', trans('global.properties_sub.fields.nombre').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
          
          
                <div class="col-xs-4 form-group">
                    {!! Form::label('tipo', trans('global.properties_sub.fields.tipo_sub').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_tipo_sub', $tipos, old('id_tipo_sub'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_tipo_sub'))
                        <p class="help-block">
                            {{ $errors->first('id_tipo_sub') }}
                        </p>
                    @endif
                </div>
          

          
                <div class="col-xs-4 form-group">
                    {!! Form::label('renta', trans('global.properties_sub.fields.renta').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('renta', old('renta'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('renta'))
                        <p class="help-block">
                            {{ $errors->first('renta') }}
                        </p>
                    @endif
                </div>
          

            
           </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('metros_cuadrados', trans('global.properties_sub.fields.metros_cuadrados').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('metros_cuadrados', old('metros_cuadrados'), ['class' => 'form-control', 'placeholder' => 'Número metros cuadrados', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('metros_cuadrados'))
                        <p class="help-block">
                            {{ $errors->first('metros_cuadrados') }}
                        </p>
                    @endif
                </div>
          
                <div class="col-xs-3 form-group">
                     {!! Form::label('numero_banos', trans('global.properties_sub.fields.numero_banos').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('numero_banos', old('numero_banos'), ['class' => 'form-control', 'placeholder' => 'Número baños', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('numero_banos'))
                        <p class="help-block">
                            {{ $errors->first('numero_banos') }}
                        </p>
                    @endif
                </div>
                 <div class="col-xs-3 form-group">
                     {!! Form::label('numero_cocinas', trans('global.properties_sub.fields.numero_cocinas').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('numero_cocinas', old('numero_cocinas'), ['class' => 'form-control', 'placeholder' => 'Número cocinas', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('numero_cocinas'))
                        <p class="help-block">
                            {{ $errors->first('numero_cocinas') }}
                        </p>
                    @endif
                </div>
                 <div class="col-xs-3 form-group">
                    {!! Form::label('numero_parqueaderos', trans('global.properties_sub.fields.numero_parqueaderos').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('numero_parqueaderos', old('numero_parqueaderos'), ['class' => 'form-control', 'placeholder' => 'Número parqueaderos', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('numero_parqueaderos'))
                        <p class="help-block">
                            {{ $errors->first('numero_parqueaderos') }}
                        </p>
                    @endif
                </div>

                          <div class="col-xs-12 form-group">
                                {!! Form::label('observaciones', trans('global.properties_sub.fields.observaciones').'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('observaciones', old('observaciones'), ['class' => 'form-control','rows' => 1, 'placeholder' => '', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('observaciones'))
                                    <p class="help-block">
                                        {{ $errors->first('observaciones') }}
                                    </p>
                                @endif
                            </div>

          <!--  <div class="row">
                <div class="col-xs-4 form-group">
                    @if ($property->photo)
                        <a href="{{ asset(env('UPLOAD_PATH').'/'.$property->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/'.$property->photo) }}"></a>
                    @endif
                    {!! Form::label('photo', trans('global.properties.fields.photo').'', ['class' => 'control-label']) !!}
                    {!! Form::file('photo', ['class' => 'form-control', 'style' => 'margin-top: 4px;']) !!}
                    {!! Form::hidden('photo_max_size', 2) !!}
                    {!! Form::hidden('photo_max_width', 4096) !!}
                    {!! Form::hidden('photo_max_height', 4096) !!}
                    <p class="help-block"></p>
                    @if($errors->has('photo'))
                        <p class="help-block">
                            {{ $errors->first('photo') }}
                        </p>
                    @endif
                </div>-->
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

