@extends('layouts.app')
<link rel="stylesheet" href="{{ url('css/material') }}/style.css"/>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Datepicker Files -->
<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker.standalone.css')}}">

@section('content')
    <h3 class="page-title">@lang('global.pagos.title')</h3>
    
    {!! Form::model($pago, ['method' => 'PUT', 'route' => ['admin.properties_pagos.update', $pago->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>


        
 <div class="panel-body">

       <div  style="border:1px solid #000;padding:10px;background-color:#e66a6a;margin-bottom:10px;border-radius:5px;color:#fff" data-toggle="tooltip" data-html="true" title="Valor base arrendamiento">Valor del Pago:
                
                      <input type="" name="valor2" value="${{number_format($pago->valor), 0, ',', '.'}}" id="valor2" style="color: #fff;font-size: 26px;padding:2px">

                      <input type="hidden" name="valor" value="{{$pago->valor}}" id="valor" style="color: #fff;font-size: 26px;padding:2px">

                      <input type="hidden" name="porc_comision" value="<?=$pago->unidad->porc_comision;?>" id="porc_comision">
                    
                      <input type="hidden" name="id_factura" value="<?=$pago->factura->id;?>" id="id_factura">

        </div>

         <div class="panel-body">

          <div class="row">

         <div class="col-xs-3 form-group">


                        {!! Form::label('fecha_pago', 'Fecha del pago', ['class' => 'control-label']) !!}
                                        {!! Form::text('fecha_pago', old('fecha_pago'), ['class' => 'form-control datepicker', 'placeholder' => 'Fecha del pago', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_pago'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_pago') }}
                                            </p>
                                        @endif
             

       

       
                                {!! Form::label('observaciones', trans('global.pagos.fields.observaciones').'*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('observaciones', old('observaciones'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Observaciones del pago', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('observaciones'))
                                    <p class="help-block">
                                        {{ $errors->first('observaciones') }}
                                    </p>
                                @endif
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

@stop

