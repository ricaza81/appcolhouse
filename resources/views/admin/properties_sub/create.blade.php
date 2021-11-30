@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.properties_sub.title')</h3>
    <!--{!! Form::open(['method' => 'POST', 'route' => ['admin.properties_sub.store'], 'files' => true,]) !!}-->

    {!! Form::open(['method' => 'POST', 'route' => ['admin.properties_sub.store' ]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
        

        
            <div class="row" style="padding:10px;">
                <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Crear unidad para: <h3><b>{{$property->name}}</b></h3> </div>
            </div>
           
           <input type="hidden" name="property_id" value="<?=$property->id;?>" id="property_id">
           



            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('nombre', trans('global.properties_sub.fields.nombre').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => 'Escribe el Nombre de la Unidad', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nombre'))
                        <p class="help-block">
                            {{ $errors->first('nombre') }}
                        </p>
                    @endif
                </div>
          
                <div class="col-xs-4 form-group">
                     {!! Form::label('renta1', trans('global.properties_sub.fields.renta').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('renta1', old('renta1'), ['class' => 'form-control', 'onkeyup' => 'applyMask(this)','placeholder' => 'Valor mensual', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('renta1'))
                        <p class="help-block">
                            {{ $errors->first('renta1') }}
                        </p>
                    @endif

                     <input type="hidden" name="renta" id="renta" class="form-control" value="" required="required" >
                </div>
                 <div class="col-xs-4 form-group">
                    {!! Form::label('tipo', trans('global.properties.fields.tipo').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_tipo_sub', $tipos, old('id_tipo_sub'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_tipo_sub'))
                        <p class="help-block">
                            {{ $errors->first('id_tipo_sub') }}
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
                    {!! Form::number('numero_cocinas', old('numero_cocinas'), ['class' => 'form-control', 'placeholder' => 'Número Cocinas', 'required' => '']) !!}
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
           </div>
              <div class="row">
           <!-- <div class="row">
                <div class="col-xs-12 form-group">
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
                </div>
            </div>-->

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
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

<script type="text/javascript" src="{{url('js/currency.min.js')}}"></script>

<script>
function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}

function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
   valueInput.value = setCurrency(removeValue);

   var renta1 = currency(document.getElementById("renta1").value).value;
   document.getElementById("renta").value= currency(renta1).value;
}
</script>


@stop

