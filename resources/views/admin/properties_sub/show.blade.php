@extends('layouts.app2')
<link rel="stylesheet" href="{{ url('css/material') }}/style.css"/>
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" href="{{url('datePicker/css/bootstrap-datepicker3.min.css')}}">
<link rel="stylesheet" href="{{url('datePicker/css/bootstrap-datepicker.standalone.css')}}">

@section('content')
    <h3 class="page-title">Detalle Unidad</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
             <a href="{{ route('admin.properties_sub.edit',[$property->id]) }}" data-toggle="tooltip" title="Editar Unidad">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                    </span>
                </a>
        </div>

        
               

        <div class="panel-body table-responsive">
            <div class="row">

               <div class="col-md-2">
                 <a target="_blank">
                            <img src="{{ asset('img_unidad.png')}}" style="object-fit:cover;height:50%;width:100%;border-radius:10px"/>
                             <div class="text-center" style="margin-top:-120px">
                             <h1 style="font-weight:600;color:#fff">{{ $property->nombre }}</h1>
                             <h4 style="color:#fff">{{ $property->propiedad->name }}</h4>
                         </div>
                        </a>
             </div>

                <div class="col-md-3">
                    <table class="table table-bordered table-striped">
                         <tr>
                            <th>Propiedad principal</th>
                            <td field-key='name'>{{ $property->propiedad->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.properties_sub.fields.nombre')</th>
                            <td field-key='name'>
                             {{ $property->nombre }}
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.properties_sub.fields.tipo_sub')</th>
                            <td field-key='tipo_sub'>{{ $property->tipo_propiedad_sub->tipo }}</td>
                        </tr>
                         <tr>
                            <th>@lang('Canon Actual')</th>
                            <td field-key='renta'>

                             @if(count($canones)>0)
                                {{number_format($canones->last()->nuevo_canon), 0, ',', '.'}}
                             @else
                             $ {{number_format($property->renta), 0, ',', '.'}}
                             @endif
                            </td>
                        </tr>
                        <tr>
                         <th>@lang('global.properties_sub.fields.metros_cuadrados')</th>
                            <td field-key='metros_cuadrados'>{{ $property->metros_cuadrados }}</td>
                        </tr>
                         <tr>
                         <th>@lang('global.properties_sub.fields.numero_banos')</th>
                            <td field-key='numero_banos'>{{ $property->numero_banos }}</td>
                        </tr>

                         <tr>
                         <th>@lang('global.properties_sub.fields.numero_cocinas')</th>
                            <td field-key='numero_banos'>{{ $property->numero_cocinas }}</td>
                        </tr>
                         <tr>
                         <th>Fecha de creación</th>
                            <td field-key='fecha_creacion'>{{date('d/F/Y',strtotime($property->created_at)) }}</td>
                        </tr>
                         <th>Observaciones de la Unidad</th>
                            <td field-key='observaciones'>{{$property->observaciones}}</td>
                        </tr>
                    </table>
          </div>

          <div class="col-md-3">

<!--CanonCreacionPropiedad-->

              <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;padding-top:25px"><b>Canon Inicial</b></h4>
                     <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha Creación
                                    </th>
                                    <th>Canon
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                    <tr>
                                        <td field-key='canon'>{{date('d/F/Y',strtotime($property->created_at)) }}<br/>
                                           

                                        </td>
                                        <td field-key='property'>
                                                ${{number_format($property->renta), 0, ',', '.' or '' }}<br/>
                                        </td>
                                    </tr>

                          
                              
                             
                            </tbody>
                    </table>
         
<!--CanonCreacionPropiedad-->


              <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;padding-top:25px"><b>Historial Canon</b></h4>
                     <table class="table table-bordered table-striped {{ count($seguros) > 0 ? '' : '' }}">
                            <thead>
                                <tr>
                                    <th>Fecha cambio
                                    </th>
                                    <th>Nuevo Canon
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($canones))
                                  @foreach ($canones as $canon)
                                    <tr>
                                        <td field-key='canon'>{{date('d/F/Y',strtotime($canon->fecha_cambio)) }}<br/>
                                            <h6>creacion:<br/>{{date('d/F/Y',strtotime($canon->created_at)) }}</h6>


                                            <br/>
                                             {{$canon->observaciones}}

                                        </td>
                                        <td field-key='property'>
                                                ${{number_format($canon->nuevo_canon), 0, ',', '.' or '' }}<br/>

                                               <!--
                                               @if(isset($seguro))
                                               @can('properties_seguros_view')
                                                        <a target="_blank" href="{{ route('admin.properties_seguros.edit',[$seguro->id]) }}" class="" style="color:#fff" data-toggle="tooltip" title="{{$seguro->id}}" style="color:#fff;padding:0px;float:right;">
                                                                       <span class="label label-info" style="margin-left:0px;padding:10px;color:#fff;float:left;">Editar Canon
                                                                       </span>
                                                        </a>
                                                    @endcan
                                                @endif
                                                -->
                                        </td>
                                    </tr>

                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                                    </tr>
                                @endif
                            </tbody>
                    </table>

                         <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Canon de arrendamiento</b></h4>

            
<!--FormNuevoCanon-->
            {!! Form::open(['method' => 'POST', 'route' => ['admin.properties_sub.store_nuevo_canon'], 'files' => true,]) !!}

                    <input type="hidden" name="id_tenant" value="{{$property->id_tenant}}" id="id_tenant">
                    <input type="hidden" name="id_property_sub" value="{{$property->id}}" id="id_property_sub">
                        
                  <div class="row">
                                <div class="col-xs-10 form-group">
                                    {!! Form::label('nuevocanon1', 'Nuevo Canon($)'.'', ['class' => 'control-label']) !!}
                                    {!! Form::text('nuevocanon1', old('nuevocanon1'), ['class' => 'form-control','onkeyup' =>'applyMask(this)','placeholder' => '']) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('nuevocanon1'))
                                        <p class="help-block">
                                            {{ $errors->first('nuevocanon1') }}
                                        </p>
                                    @endif
                                    <input type="hidden" name="nuevo_canon" id="nuevo_canon" class="form-control" value="" required="required" >
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('fecha_cambio', 'Fecha cambio Canon'.'*', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_cambio', old('fecha_cambio'), ['class' => 'form-control', 'placeholder' => 'Fecha cambio canon', 'required ' => '']) !!}
                                                        <p class="help-block"></p>
                                                        @if($errors->has('fecha_cambio'))
                                                            <p class="help-block">
                                                                {{ $errors->first('fecha_cambio') }}
                                                            </p>
                                                        @endif
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('name', 'Observaciones', ['class' => 'control-label']) !!}
                                    {!! Form::text('observaciones', old('observaciones'), ['class' => 'form-control', 'placeholder' => '']) !!}
                                    <p class="help-block"></p>
                                    @if($errors->has('observaciones'))
                                        <p class="help-block">
                                            {{ $errors->first('observaciones') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                              {!! Form::submit(trans('Enviar nuevo canon'), ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                        </div>
<!--FormNuevoCanon-->
                
    
     <div class="col-md-3">
       <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="active"><a href="#seguros" aria-controls="seguros" role="tab" data-toggle="tab">Seguro</a></li>
       </ul>

   
       @if(empty($seguro))
       Sin seguro
        <a href="{{ route('admin.properties_seguros.create',[$property->id])}}" data-toggle="tooltip" title="Crear Seguro" target="_blank" style="float: right;">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Crear Seguro
                    </span>
        </a>
       @endif
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="seguros">
                        @if(isset($seguro))
                            @if ($seguro->estado == 2)
                                Este seguro está desactivado
                                 {!! Form::model($seguro, ['method' => 'PUT', 'route' => ['admin.properties_seguros.update', $seguro->id], 'files' => true,]) !!}
                                                  <div class="col-md-12">
                                                        <div class="checkbox">
                                                               <input type="checkbox" onchange="javascript:reactivar()" name="check_reactivar" id="check_reactivar">
                                                        <label for="check_reactivar">Reactivar seguro</label>
                                                  </div>

        <div class="col-md-12" id="tabla_reactivar">

                                                        {!! Form::submit('Reactivar',[
                                                            'class' => 'btn btn-success',
                                                            'id' => 'reactivar_seguro',
                                                           // 'style' => 'visibility:hidden',
                                                            //'style' => 'display:hidden',
                                                            ]) !!}
                                  {!! Form::close() !!}
                    <table class="table table-bordered table-striped {{ count($seguros) > 0 ? 'datatable' : '' }}">
                            <thead>
                                <tr>
                                    <th>Aseguradora / Fechas
                                    </th>
                                    <!--<th>@lang('global.seguros.fields.fechainicio')
                                    </th>-->
                                    <!--<th>@lang('global.seguros.fields.fechafin')
                                    </th>-->
                                    <th>@lang('global.seguros.fields.costo')
                                    </th>
                                    <!--<th>@lang('global.seguros.fields.cobertura')
                                    </th>-->
                                    <!--   @if( request('show_deleted') == 1 )
                                                        <th>&nbsp;</th>
                                                        @else
                                                        <th>&nbsp;</th>
                                                        @endif
                                    -->
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($seguro))
                                  @foreach ($seguros as $seguro)
                                    <tr>
                                        <td field-key='property'>{{ $seguro->empresa }}<br/>
                                            Inicio: {!! date('d/F/Y', strtotime($seguro->fecha_inicio))!!}<br/>
                                            Fin: {!! date('d/F/Y', strtotime($seguro->fecha_fin))!!}
                                        </td>
                                        <!--
                                        <td field-key='property'>
                                            {!! date('d/F/Y', strtotime($seguro->fecha_inicio))!!}
                                        </td>
                                        <td field-key='property'>{!! date('d/F/Y', strtotime($seguro->fecha_fin))!!}
                                        </td>
                                        -->
                                        <td field-key='property'>
                                                ${{number_format($seguro->valor), 0, ',', '.' or '' }}<br/>
                                                    @can('properties_seguros_view')
                                                        <a target="_blank" href="{{ route('admin.properties_seguros.edit',[$seguro->id]) }}" class="" style="color:#fff" data-toggle="tooltip" title="{{$seguro->id}}" style="color:#fff;padding:0px;float:right;">
                                                                       <span class="label label-info" style="margin-left:0px;padding:10px;color:#fff;float:left;">Editar Seguro
                                                                       </span>
                                                        </a>
                                                    @endcan
                                        </td>
                                    </tr>

                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                                    </tr>
                                @endif
                            </tbody>
                    </table>
           
                @endif
            @endif
             </div>

              @if(isset($seguro))
                            @if ($seguro->estado == 1)
                                Este seguro está activo
                                 {!! Form::model($seguro, ['method' => 'PUT', 'route' => ['admin.properties_seguros.update', $seguro->id], 'files' => true,]) !!}
                                                  <div class="col-md-12">
                                                        <div class="checkbox">
                                                               <input type="checkbox" onchange="javascript:showContent()" name="check" id="check">
                                                        <label for="check">Desactivar seguro</label>
                                                  </div>

          <div class="col-md-12" id="col_desactivar">

                                                        {!! Form::submit('Desactivar',[
                                                            'class' => 'btn btn-danger',
                                                            'id' => 'desactivar_seguro',
                                                           // 'style' => 'visibility:hidden',
                                                            ]) !!}
                                  {!! Form::close() !!}
                    <table id="tabla_desactivar" class="table table-bordered table-striped {{ count($seguros) > 0 ? 'datatable' : '' }}">
                            <thead>
                                <tr>
                                    <th>Aseguradora / Fechas
                                    </th>
                                    <!--<th>@lang('global.seguros.fields.fechainicio')
                                    </th>-->
                                    <!--<th>@lang('global.seguros.fields.fechafin')
                                    </th>-->
                                    <th>@lang('global.seguros.fields.costo')
                                    </th>
                                    <!--<th>@lang('global.seguros.fields.cobertura')
                                    </th>-->
                                    <!--   @if( request('show_deleted') == 1 )
                                                        <th>&nbsp;</th>
                                                        @else
                                                        <th>&nbsp;</th>
                                                        @endif
                                    -->
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($seguro))
                                  @foreach ($seguros as $seguro)
                                    <tr>
                                        <td field-key='property'>{{ $seguro->empresa }}<br/>
                                            Inicio: {!! date('d/F/Y', strtotime($seguro->fecha_inicio))!!}<br/>
                                            Fin: {!! date('d/F/Y', strtotime($seguro->fecha_fin))!!}
                                        </td>
                                        <!--
                                        <td field-key='property'>
                                            {!! date('d/F/Y', strtotime($seguro->fecha_inicio))!!}
                                        </td>
                                        <td field-key='property'>{!! date('d/F/Y', strtotime($seguro->fecha_fin))!!}
                                        </td>
                                        -->
                                        <td field-key='property'>
                                                ${{number_format($seguro->valor), 0, ',', '.' or '' }}<br/>
                                                    @can('properties_seguros_view')
                                                        <a target="_blank" href="{{ route('admin.properties_seguros.edit',[$seguro->id]) }}" class="" style="color:#fff" data-toggle="tooltip" title="{{$seguro->id}}" style="color:#fff;padding:0px;float:right;">
                                                                       <span class="label label-info" style="margin-left:0px;padding:10px;color:#fff;float:left;">Editar Seguro
                                                                       </span>
                                                        </a>
                                                    @endcan
                                        </td>
                                    </tr>

                                @endforeach
                                @else
                                    <tr>
                                        <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                                    </tr>
                                @endif
                            </tbody>
                    </table>
                @endif
            @endif


            </div>
        </div>
       

<p>&nbsp;</p>



            <a href="{{ route('admin.properties_sub.unidades_consulta',[$property->propiedad->id]) }}" class="btn btn-success">@lang('global.app_back_to_list')</a>
</div>



 <script>
        $(document).ready(function () {
          document.getElementById("desactivar_seguro").style.display='none';
          document.getElementById("reactivar_seguro").style.display='none';
          //document.getElementById("reactivar_seguro").hide();
          document.getElementById("tabla_reactivar").style.display='none';
          document.getElementById("tabla_desactivar").style.display='none';
        });
 </script>

<script type="text/javascript">
     document.getElementById("reactivar_seguro").style.display='none';
     document.getElementById("col_desactivar").style.display='none';
     document.getElementById("tabla_desactivar").style.display='none';
    function showContent() {
        element = document.getElementById("desactivar_seguro");
        element2 = document.getElementById("reactivar_seguro");
        tabla = document.getElementById("tabla_reactivar");
        tabla2 = document.getElementById("tabla_desactivar");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
            element2.style.display='none';
            tabla.style.display='none';
            tabla2.style.display='none';
        }
        else {
            element.style.display='none';
            element2.style.display='none';
            tabla.style.display='none';
            tabla2.style.display='none';
        }
    }

     function reactivar() {
        element = document.getElementById("desactivar_seguro");
        element2 = document.getElementById("reactivar_seguro");
        tabla = document.getElementById("tabla_reactivar");
        tabla2 = document.getElementById("tabla_desactivar");
        check_reactivar = document.getElementById("check_reactivar");
        if (check_reactivar.checked) {
            //element.style.display='none';
            //document.getElementById("reactivar_seguro").show();
            element2.style.display='block';
            //tabla.style.display='none';
            //tabla2.style.display='none';
        }
        else {
            //element.style.display='none';
            element2.style.display='none';
            //tabla.style.display='none';
            //tabla2.style.display='none';*/
            // document.getElementById("reactivar_seguro").hide();
        }
    }
</script>

<script type="text/javascript" src="{{url('js/currency.min.js')}}"></script>
<script>

function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}

function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
   valueInput.value = setCurrency(removeValue);

   var nuevocanon1 = currency(document.getElementById("nuevocanon1").value).value;
   document.getElementById("nuevo_canon").value= currency(nuevocanon1).value;
}
</script>

@stop
