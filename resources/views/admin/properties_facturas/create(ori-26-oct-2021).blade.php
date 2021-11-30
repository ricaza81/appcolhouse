@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.facturas.fields.crearfactura')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.properties_facturas.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row" style="padding:10px;">
                    <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Propiedad principal:
                        <h3><b>{{$properties->propiedad->name}}</b></h3>
                    </div>
                    <div  style="border:1px solid #000;padding:10px;background-color:#d4edda;margin-bottom:10px;border-radius:5px">Unidad:
                        <h3><b>
                               <a href="{{ route('admin.properties_sub.show',[$properties->id]) }}" target="_blank">
                               
                                {{$properties->nombre}}</b></h3>
                                </a>
                    </div>
                    <div  style="border:1px solid #000;padding:10px;background-color:#e66a6a;margin-bottom:10px;border-radius:5px;color:#fff" data-toggle="tooltip" data-html="true" title="Valor base arrendamiento">Valor factura (base*valor arrendamiento):
                
                    @if(isset($properties->cambio_canon->nuevo_canon))
                     <input type="text" name="property_renta" value="{{number_format($properties->cambio_canon->nuevo_canon), 0, ',', '.' }}" id="property_renta" style="color: #fff;font-size: 26px;padding:2px">
                     @else
                     <input type="text" name="property_renta" value="{{number_format($properties->renta), 0, ',', '.'}}" id="property_renta" style="color: #fff;font-size: 26px;padding:2px">
                     @endif
                 

                    </div>
                    <input type="hidden" name="id_property" value="<?=$properties->propiedad->id;?>" id="id_property">
                    <input type="hidden" name="nombre_property" value="<?=$properties->propiedad->name;?>" id="nombre_property">
                    <input type="hidden" name="id_property_sub" value="<?=$properties->id;?>" id="id_property_sub">
                    <input type="hidden" name="nombre_unidad" value="<?=$properties->nombre;?>" id="nombre_unidad">
                    <input type="hidden" name="id_tenant" value="<?=$properties->inquilinos->id;?>" id="id_tenant">
                    <input type="hidden" name="email_tenant" value="<?=$properties->inquilinos->email;?>" id="email_tenant">
                    <input type="hidden" name="nombre_tenant" value="<?=$properties->inquilinos->name;?>" id="nombre_tenant">
                    <input type="hidden" name="valor" value="<?=$properties->renta;?>" id="valor">
            </div>

               <div class="row">
                 <div class="col-xs-3 form-group">
                        {!! Form::label('adicionales', trans('global.facturas.fields.adicionales').'*', ['class' => 'control-label']) !!}
                                        {!! Form::number('adicionales', old('adicionales'), ['class' => 'form-control','onkeyup' =>'applyMask(this)', 
                                        'placeholder' => 'Valor total de costos adicionales', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('adicionales'))
                                            <p class="help-block">
                                                {{ $errors->first('adicionales') }}
                                            </p>
                                        @endif
                         {!! Form::label('obs_adicionales', trans('global.facturas.fields.obs_adicionales').'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('obs_adicionales', old('obs_adicionales'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Escribe detalles de los gastos adicionales', '' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('obs_adicionales'))
                                    <p class="help-block">
                                        {{ $errors->first('obs_adicionales') }}
                                    </p>
                                @endif

                    </div>
                     <div class="col-xs-3 form-group">
                        {!! Form::label('deducciones', trans('global.facturas.fields.deducciones').'*', ['class' => 'control-label']) !!}
                                        {!! Form::number('deducciones', old('deducciones'), ['class' =>
                                        'form-control','onkeyup' =>'applyMask(this)', 'placeholder' => 'Valor total deducciones del mes', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('deducciones'))
                                            <p class="help-block">
                                                {{ $errors->first('deducciones') }}
                                            </p>
                                        @endif
                         {!! Form::label('obs_deducibles', trans('global.facturas.fields.obs_deducibles').'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('obs_deducibles', old('obs_deducibles'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Escribe detalles de los gastos deducibles', '' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('obs_deducibles'))
                                    <p class="help-block">
                                        {{ $errors->first('obs_deducibles') }}
                                    </p>
                                @endif
                    </div>
                   
                     <div class="col-xs-3 form-group">
                        
                        {!! Form::label('valor_neto', trans('global.facturas.fields.valor_neto').'', ['class' => 'control-label']) !!}
                                        {!! Form::number('valor_neto', old('valor_neto'), [
                                        'class' => 'form-control',
                                        'onkeyup' =>'applyMask(this)',
                                        'placeholder' => '', '' => '']
                                        ) !!}
                         <button class="btn btn-danger" onclick="sumar()">Calcular</button>
                                        <p class="help-block"></p>
                                        @if($errors->has('valor_neto'))
                                            <p class="help-block">
                                                {{ $errors->first('valor_neto') }}
                                            </p>
                                        @endif
                    </div>
                    
            </div>

            <div class="row">
                 <div class="col-xs-3 form-group">
                        {!! Form::label('fechainicio', trans('global.facturas.fields.fechainicio').'*', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_inicio', old('fechainicio'), ['class' => 'form-control', 'placeholder' => 'Fecha inicio', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_inicio'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_inicio') }}
                                            </p>
                                        @endif
                    </div>
                     <div class="col-xs-3 form-group">
                        {!! Form::label('fechainicio', trans('global.facturas.fields.fechacorte').'*', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_corte', old('fecha_corte'), ['class' => 'form-control', 'placeholder' => 'Fecha corte', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_corte'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_corte') }}
                                            </p>
                                        @endif
                    </div>
            </div>
          
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

<script>
function sumar(){
var valor = document.getElementById("property_renta").value;
var adicionales = document.getElementById("adicionales").value*1000;
var deducciones = document.getElementById("deducciones").value*1000;
var resultado = parseFloat(valor)+parseFloat(adicionales)-parseFloat(deducciones)
document.getElementById("valor_neto").value=resultado*1;
}
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

input_valor_neto = document.getElementById('valor_neto');
input_deducciones = document.getElementById('deducciones');
window.onload = applyMask(input_valor_neto)
</script>

