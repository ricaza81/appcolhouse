@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.seguros.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.properties_seguros.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row" style="padding:10px;">
                    <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Propiedad principal:
                          <h3><b>{{$property->propiedad_create->name}}</b></h3>
                    </div>
                     <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Unidad:
                      
                          <h3><b>{{$property->nombre}}</b></h3>
                    </div>
                     <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Arriendo:
                        <h3><b>${{number_format($property->renta), 0, ',', '.'}}</b></h3>
                    </div>
                     <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Costo Seguro:
                        <h3><b>${{number_format($property->renta*2.02/100), 0, ',', '.'}}</b></h3>
                    </div>

                     <div id="porc_seguro" style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">% Seguro:
                        <!--<h3><b>{{number_format($property->renta*2.02/100/($property->renta)*100), 2, ',', '.'}}%</b></h3>-->
                         <h3><b>2.02%</b></h3>
                    </div>
             
                    <input type="hidden" name="id_property" value="<?=$property->propiedad_create->id;?>" id="id_property">
                    <input type="hidden" name="id_property_sub" value="<?=$property->id;?>" id="id_property_sub">
                     <input type="hidden" name="valor" value="<?=$property->renta*2.02/100;?>" id="valor">

                   
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
                        {!! Form::label('fechainicio', trans('global.facturas.fields.fechainicio').'*', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_inicio', old('fecha_inicio'), ['class' => 'form-control', 'placeholder' => 'Fecha inicio', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_inicio'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_inicio') }}
                                            </p>
                                        @endif
                </div>
                <div class="col-xs-3 form-group">
                        {!! Form::label('fechafin', trans('global.seguros.fields.fechafin').' (Opcional)', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_fin', old('fecha_fin'), ['class' => 'form-control', 'placeholder' => 'Fecha Fin', '' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_fin'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_fin') }}
                                            </p>
                                        @endif
                </div>
            
            </div>
            <div class="row">

                    <!--<div class="col-xs-3 form-group">
                     {!! Form::label('valor', trans('global.seguros.fields.costo').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('valor', old('valor'), ['class' => 'form-control', 'placeholder' => 'Valor Poliza', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('valor'))
                        <p class="help-block">
                            {{ $errors->first('valor') }}
                        </p>
                    @endif
                </div>-->

                 <div class="col-xs-3 form-group">
                     <label for="nombre">Costo($)*</label>
                     <input type="text" name="valor2" value="<?=$property->renta*2.02/100;?>" id="valor2" onkeyup="applyMask(this);">
                    </div>
         
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

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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
divId=document.getElementById('porc_seguro');
window.onload = applyMask(inputId);
window.onload = applyMask(divId)
</script>
@stop

