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
                     <input type="text" name="property_renta" value="{{$properties->cambio_canon->nuevo_canon}}" onkeyup="applyMask(this)" id="property_renta" style="color: #fff;font-size: 26px;padding:2px">
                     @else
                     <input type="text" name="property_renta" value="{{$properties->renta}}" id="property_renta" onkeyup="applyMask(this)" style="color: #fff;font-size: 26px;padding:2px">
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
                        {!! Form::label('adicionales1', trans('global.facturas.fields.adicionales').'*', ['class' => 'control-label']) !!}

                         

                                        {!! Form::text('adicionales1', old('adicionales1'), ['class' => 'form-control','onkeyup' =>'applyMask(this)', 
                                        'placeholder' => 'Valor total de costos adicionales', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('adicionales1'))
                                            <p class="help-block">
                                                {{ $errors->first('adicionales1') }}
                                            </p>
                                        @endif

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
                        {!! Form::label('deducciones1', trans('global.facturas.fields.deducciones').'*', ['class' => 'control-label']) !!}

                         
                                        {!! Form::text('deducciones1', old('deducciones1'), ['class' =>
                                        'form-control','onkeyup' =>'applyMask(this)', 'placeholder' => 'Valor total deducciones del mes', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('deducciones1'))
                                            <p class="help-block">
                                                {{ $errors->first('deducciones1') }}
                                            </p>
                                        @endif

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
                   
                     <div class="col-xs-3 form-group">
                        
                          {!! Form::label('valor_neto', 'Neto($)', ['class' => 'control-label']) !!}

                        <input type="text" name="valorNeto" id="valorNeto" class="form-control" value="" required="required" >
                        <input type="hidden" name="valor_neto" id="valor_neto" class="form-control" value="" required="required" >


                      
                                          <button class="btn btn-danger" onclick="sumar()">Calcular</button>
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


<script type="text/javascript" src="{{url('js/currency.min.js')}}"></script>
<script>

initProperyRenta();

function initProperyRenta(){
    var valorFactura = document.getElementById("property_renta");
    valorFactura.value = setCurrency(valorFactura.value);
}

function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
   valueInput.value = setCurrency(removeValue);
}

function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}


function sumar(){
   
   

    //document.getElementById("adicionales1").value= setCurrency(adicionales1);
    var adicionales1=document.getElementById("adicionales1").value;
    document.getElementById("adicionales").value= currency(adicionales1).value;

    //document.getElementById("deducciones1").value= setCurrency(deducciones1);
    var deducciones1=document.getElementById("deducciones1").value;
    document.getElementById("deducciones").value= currency(deducciones1).value;

    var valor = currency(document.getElementById("property_renta").value).value;
    var adicionales1 = currency(document.getElementById("adicionales1").value).value;
    var deducciones1 = currency(document.getElementById("deducciones1").value).value;
    var resultado = parseFloat(valor)+parseFloat(adicionales1)-parseFloat(deducciones1);

     document.getElementById("valorNeto").value= setCurrency(resultado);
    document.getElementById("valor_neto").value= currency(resultado).value;
}
</script>
@stop

