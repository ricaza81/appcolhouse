@extends('layouts.app')
<link rel="stylesheet" href="{{ url('css/material') }}/style.css"/>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Datepicker Files -->
<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">

@section('content')
    <h3 class="page-title">@lang('global.seguros.title')</h3>
    
    {!! Form::model($seguro, ['method' => 'PUT', 'route' => ['admin.properties_seguros.update', $seguro->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

             <div class="row" style="padding:10px;">
                    <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Propiedad principal:
                        <h3><b>{{$seguro->propiedad->name}}</b></h3>
                    </div>
                     <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Unidad:
                        <h3><b>{{$seguro->unidad_seguro->nombre}}</b></h3>
                    </div>
                      <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Arriendo:
                        <h3><b>${{number_format($seguro->unidad_seguro->renta), 0, ',', '.'}}</b></h3>
                    </div>
                     <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Costo Seguro:
                        <h3><b>${{number_format($seguro->unidad_seguro->renta*$porc_seguro->valor), 0, ',', '.'}}</b></h3>
                    </div>

                     <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">% Seguro:
                        <h3><b>{{$porc_seguro->valor*100}}</b></h3>
                    </div>
             
                    <input type="hidden" name="id_property" value="<?=$seguro->id_property;?>" id="id_property">
                     <input type="hidden" name="id_property_sub" value="<?=$seguro->id_property_sub;?>" id="id_property_sub">
                     <input type="hidden" name="valor" value="<?=$seguro->unidad_seguro->renta*$porc_seguro->valor;?>" id="valor">
                   
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('empresa', trans('global.seguros.fields.empresa').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('empresa', old('empresa'), ['class' => 'form-control', 'placeholder' => 'Empresa Aseguradora', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('empresa'))
                                    <p class="help-block">
                                        {{ $errors->first('empresa') }}
                                    </p>
                                @endif
                </div>

                 <div class="col-xs-3 form-group">
                        {!! Form::label('fecha_inicio', trans('global.seguros.fields.fechainicio').'*', ['class' => 'control-label']) !!}
                                        {!! Form::text('fecha_inicio', old('fecha_inicio'), ['class' => 'form-control datepicker', 'placeholder' => 'Fecha Inicio', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_inicio'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_inicio') }}
                                            </p>
                                        @endif
                    </div>
                <div class="col-xs-3 form-group">
                        {!! Form::label('fecha_fin', trans('global.seguros.fields.fechafin').'*', ['class' => 'control-label']) !!}
                                        {!! Form::text('fecha_fin', old('fecha_fin'), ['class' => 'form-control datepicker', 'placeholder' => 'Fecha Fin', '' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_fin'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_fin') }}
                                            </p>
                                        @endif
                    </div>
            </div>

              <div class="row">

                  <!--  <div class="col-xs-3 form-group">
                     {!! Form::label('valor', trans('global.seguros.fields.costo').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('$seguro->unidad_seguro->renta*2/100', old('$seguro->unidad_seguro->renta*2/100'), ['class' => 'form-control', 'placeholder' => 'Valor Poliza', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('valor'))
                        <p class="help-block">
                            {{ $errors->first('valor') }}
                        </p>
                    @endif-->

                    <div class="col-xs-3 form-group">
                     <label for="nombre">Costo($)*</label>
                     <input type="text" name="valor2" value="<?=$seguro->unidad_seguro->renta*$porc_seguro->valor;?>" id="valor2" onkeyup="applyMask(this);">
                    </div>

                 <!--<div class="col-xs-4 form-group">
                     {!! Form::label('cobertura', trans('global.seguros.fields.cobertura').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('cobertura', old('cobertura'), ['class' => 'form-control', 'placeholder' => 'Cobertura en millones $', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cobertura'))
                        <p class="help-block">
                            {{ $errors->first('cobertura') }}
                        </p>
                    @endif
                </div>-->
         
                 <div class="col-xs-12 form-group">
                                {!! Form::label('observaciones', trans('global.seguros.fields.observaciones').'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('observaciones', old('observaciones'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Escribe detalles importantes del Seguro', 'required' => '']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

<!-- FastClick -->
<script src="{{asset('/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/plugins/fastclick/fastclick.js')}}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="{{asset('datePicker/js/bootstrap-datepicker.js')}}"></script>
<!-- Languaje -->
<script src="{{asset('datePicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
<script>
 $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        language: "es",
        autoclose: true
    });
</script>

<script>
    window.applyMask = function(input){
        console.log('applyMask');
        var unmasked = input.value.replace(/\./g,' ').replace(/ /g, '');
        input.value = addDots(unmasked);
     
  }

window.addDots = function(value){
    x = value.split(',');
    x1 = x[0]; // parte entera
    x2 = x.length > 1 ? ',' + x[1] : ''; // parte decimal
    // 3 digitos precedidos por una cantidad de 1 o mas digitos.
    // aplico regex para obtener 2 grupos cada 3 digitos
    var rgx = /(\d+)(\d{3})/;
    // $1 corresponde a los digitos predecesores, $2 al segundo grupo, los 3 dígitos que indican miles.
    while (rgx.test(x1)) {
     //reemplaza la parte entera concatenando el primer grupo, un punto y el segundo grupo.
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    // concatena con parte decimal
    return x1 + x2;
}

inputId = document.getElementById('valor2');
window.onload = applyMask(inputId)
</script>

@stop

