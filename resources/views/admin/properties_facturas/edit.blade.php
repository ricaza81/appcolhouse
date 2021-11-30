@extends('layouts.app')
<link rel="stylesheet" href="{{ url('css/material') }}/style.css"/>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Datepicker Files -->
<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">

@section('content')
    <h3 class="page-title">@lang('global.facturas.fields.editarfactura')</h3>
    
    {!! Form::model($document, ['method' => 'PUT', 'route' => ['admin.properties_facturas.update', $document->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('valor_neto', trans('global.facturas.fields.valor_neto').'*', ['class' => 'control-label']) !!}
                <input type="text" name="valorneto1" id="valorneto1" class="form-control" value="{{$document->valor_neto}}" required="required" onkeyup="applyMask(this)" >

                <input type="hidden" name="valor_neto" id="valor_neto" class="form-control" value="" required="required" >
                </div>
            </div>
             <div class="row">
                 <div class="col-xs-3 form-group">
                        {!! Form::label('adicionales', trans('global.facturas.fields.adicionales').'*', ['class' => 'control-label']) !!}
                           
                          <input type="text" name="adicionales1" id="adicionales1" class="form-control" value="{{$document->adicionales}}" required="required" onkeyup="applyMask(this)" >

                             <input type="hidden" name="adicionales" id="adicionales" class="form-control" value="" required="required" >

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
                                <input type="text" name="deducciones1" id="deducciones1" class="form-control" value="{{$document->deducciones}}" required="required" onkeyup="applyMask(this)" >

                             <input type="hidden" name="deducciones" id="deducciones" class="form-control" value="" required="required" >
                          {!! Form::label('obs_deducibles', trans('global.facturas.fields.obs_deducibles').'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('obs_deducibles', old('obs_deducibles'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Escribe detalles de los gastos deducibles', '' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('obs_deducibles'))
                                    <p class="help-block">
                                        {{ $errors->first('obs_deducibles') }}
                                    </p>
                                @endif
                    </div>
                </div>
           <div class="row">
                 <div class="col-xs-3 form-group">
                        {!! Form::label('fecha_inicio', trans('global.facturas.fields.fechainicio').'*', ['class' => 'control-label']) !!}
                        {!! Form::text('fecha_inicio', old('fecha_inicio'), ['class' => 'form-control datepicker', 'placeholder' => 'Fecha inicio', 'required' => '']) !!}
                        <p class="help-block"></p>
                            @if($errors->has('fecha_inicio'))
                            <p class="help-block">
                            {{ $errors->first('fecha_inicio') }}
                            </p>
                            @endif
                    </div>
                     <div class="col-xs-3 form-group">
                        {!! Form::label('fecha_corte', trans('global.facturas.fields.fechacorte').'*', ['class' => 'control-label']) !!}
                                        {!! Form::text('fecha_corte', old('fecha_corte'), ['class' => 'form-control datepicker', 'placeholder' => 'Fecha corte', 'required' => '']) !!}
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

<script type="text/javascript" src="{{url('js/currency.min.js')}}"></script>
<script>

initValorNeto();

function initValorNeto(){
    var valorNeto1 = document.getElementById("valorneto1");
    var adicionales1 = document.getElementById("adicionales1");
    var deducciones1 = document.getElementById("deducciones1");
 
    valorNeto1.value = setCurrency(valorNeto1.value);
    adicionales1.value = setCurrency(adicionales1.value);
    deducciones1.value = setCurrency(deducciones1.value);

    var valor_neto = currency(document.getElementById("valorneto1").value).value;
    document.getElementById("valor_neto").value= currency(valor_neto).value;

    var adicionales = currency(document.getElementById("adicionales1").value).value;
    document.getElementById("adicionales").value= currency(adicionales).value;

    var deducciones = currency(document.getElementById("deducciones1").value).value;
    document.getElementById("deducciones").value= currency(deducciones).value;
}

function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
   valueInput.value = setCurrency(removeValue);

   var valorneto1 = currency(document.getElementById("valorneto1").value).value;
   document.getElementById("valor_neto").value= currency(valorneto1).value;

   var adicionales1 = currency(document.getElementById("adicionales1").value).value;
   document.getElementById("adicionales").value= currency(adicionales1).value;

   var deducciones1 = currency(document.getElementById("deducciones1").value).value;
   document.getElementById("deducciones").value= currency(deducciones1).value;
}

function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}

</script>
@stop

