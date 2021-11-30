@extends('layouts.app')

@section('content')


    <h3 class="page-title">Edición de Parametros</h3>
    
    {!! Form::model($parametro, ['method' => 'PUT', 'route' => ['admin.system_params.update', $parametro->id], 'files' => true,]) !!}

     <div class="panel-body table-responsive">
        <div class="row" style="background: #fff;padding:20px">

    <div class="col-md-3" style="background: #fff;">

                 <a href="" target="_blank">
                            <img src="{{ asset('img_param.png')}}" style="object-fit:cover;height:100%;width:100%"/>
                        </a>
       
    </div>
    <div class="col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>
    
        <div class="panel-body">
          
          
             
                    {!! Form::label('parametro', trans('global.params.fields.nombre').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('parametro', old('empresa'), ['class' => 'form-control', 'placeholder' => 'Empresa Aseguradora', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('empresa'))
                                    <p class="help-block">
                                        {{ $errors->first('empresa') }}
                                    </p>
                                @endif
              

                
                    {!! Form::label('valor', trans('global.params.fields.valor').'*', ['class' => 'control-label']) !!}
                                {!! Form::text('valor', old('valor'), ['class' => 'form-control', 'placeholder' => 'Valor', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('valor'))
                                    <p class="help-block">
                                        {{ $errors->first('valor') }}
                                    </p>
                                @endif
           
  {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
    
         </div>      
          

  

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

