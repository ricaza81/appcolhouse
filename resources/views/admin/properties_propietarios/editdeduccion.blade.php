@extends('layouts.app')

@section('content')

 {!! Form::model($deduccion, ['method' => 'PUT', 'route' => ['admin.propietarios_deducciones.update', $deduccion->id], 'files' => false,]) !!}
    
  <input type="hidden" name="id_propietario" value="<?=$property->propietarios2($property->id)->id;?>" id="id_propietario">
          <input type="hidden" name="id_property" value="<?=$property->id;?>" id="id_property">
<div class="panel panel-default" style="padding:20px;padding-bottom:0px;">
        <div class="panel-heading" style="font-size:18px;font-weight:700;">
        Editar deducción
        </div>     

        <div class="panel-body">
            <!--Tenant-->
                <div class="row">
               {!! Form::label('fecha_deduccion', 'Fecha deducción', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_deduccion', old('fecha_deduccion'), ['class' => 'form-control', 'placeholder' => 'Fecha deducción', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_deduccion'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_deduccion') }}
                                            </p>
                                        @endif
                  {!! Form::label('valor_deduccion', 'Valor deducción', ['class' => 'control-label']) !!}       
                  <input type="text" name="valor_deduccion" id="valor_deduccion" class="form-control" value="{{$deduccion->valor}}" onkeyup="applyMask(this)" onChange="entero()">
                 <input type="hidden" name="valor" id="valor" class="form-control" value="">
                            
       

       
                                {!! Form::label('observaciones', 'Observaciones de la deducción', ['class' => 'control-label']) !!}
                                {!! Form::textarea('observaciones', old('observaciones'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Observaciones de la deducción', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('observaciones'))
                                    <p class="help-block">
                                        {{ $errors->first('observaciones') }}
                                    </p>
                                @endif

                  {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

<script type="text/javascript" src="{{url('js/currency.min.js')}}"></script>

<script>
initDeduccion();

function initDeduccion(){
    var valorDeduccion = document.getElementById("valor_deduccion");
    valorDeduccion.value = setCurrency(valorDeduccion.value);
}

function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
   valueInput.value = setCurrency(removeValue);
}

function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}

function entero(){
    var valordeducciones=document.getElementById("valor_deduccion").value;
    document.getElementById("valor").value= currency(valordeducciones).value;
}

/*function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
   valueInput.value = setCurrency(removeValue);

    //document.getElementById("valor_deduccion").value= setCurrency(resultado);
    var valor_deduccion=document.getElementById("valor_deduccion").value;
    document.getElementById("valor").value= currency(valor_deduccion).value;
}

function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}*/
</script>
         
@stop

