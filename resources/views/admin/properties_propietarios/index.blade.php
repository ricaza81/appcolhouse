@extends('layouts.app')

@section('content')
    <h3 class="page-title">Propietarios</h3>
    @can('document_create')
    <p>
       <!-- <a href="{{ route('admin.documents.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.properties_propietarios.index',[$property->id])}}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">

            @lang('global.app_all')</a></li> |
           <!-- <li><a href="{{ route('admin.properties_propietarios.index',[$property->id])}}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>-->
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

 

      <div class="panel-body table-responsive">

           @if (count($seguros) > 0)
                        @foreach ($seguros as $seguro)
          <div class="row">

             <div class="col-md-3">
                 <a href=" {{route('admin.properties_propietarios.show',[$seguro->id])}}" target="_blank">
                            <img src="{{ asset('img_user.png')}}" style="object-fit:cover;height:100%;width:100%;border-radius:10px"/>
                              <div class="text-center" style="margin-top:-120px">
                             <h2 style="font-weight:600;color:#fff">{{ $seguro->nombre }}</h2>
                             <h4 style="color:#fff">{{ $seguro->propiedad->name }}</h4>
                         </div>
                        </a>
             </div>

            <div class="col-md-4">
                 <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Detalles del propietario</b></h4>
            <table class="table {{ count($seguros) > 0 ? '' : '' }} @can('property_delete') @if ( request('show_deleted') != 1 ) display @endif @endcan">
             
            
                   <!-- <tr>
                        @can('properties_facturas_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                    </tr>-->

                        <tr>
                        <th>Nombre Propietario</th>
                            <td> {{$seguro->nombre}}
                                  <a href="{{ route('admin.properties_propietarios.edit',[$seguro->id]) }}" data-toggle="tooltip" title="Editar Unidad">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                    </span>
                </a>
                            </td>
                        </th>
                        </tr> 
                        <tr>
                        <th>Cédula</th>
                            <td> {{$seguro->cedula}}</td>
                        </th>
                        </tr> 
                        <tr>
                        <th>Teléfono</th>
                            <td> {{$seguro->phone}}</td>
                        </th>
                        </tr> 
                        <tr>
                        <th>Email</th>
                            <td> {{$seguro->email}}</td>
                        </th>
                        </tr> 
                        <tr>
                        <th>Dirección</th>
                            <td> {{$seguro->direccion}}</td>
                        </th>
                        </tr> 
                        <tr>
                        <th>Porcentaje administración(%)<br/>

                        </th>
                            <td> {{$seguro->porc_comision}}%<br/>
                            <a href="{{route('admin.tenants.informe_inquilinos_consulta',[$seguro->propiedad->id])}}" class="btn btn-primary" target="_blank">Ver Informes</a></td>
                           
                        </th>
                        </tr>
                        <tr>
                        <th>Observaciones</th>
                            <td> {{$seguro->observaciones}}</td>
                      
                        </tr> 
                   
                    </tr>

                    <!--    <tr>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                        </tr>-->

                              @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif      
                   
            </table>
        </div>

         <div class="col-md-2">
            <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Deducciones del propietario</b></h4>

        {!! Form::open(
        ['method' => 'POST', 
        'route' => ['admin.propietarios_deducciones.store',
        ]]
        )  !!}

        
          <input type="hidden" name="id_propietario" value="<?=$property->propietarios2($property->id)->id;?>" id="id_propietario">
          <input type="hidden" name="id_property" value="<?=$property->id;?>" id="id_property">


                        {!! Form::label('fecha_deduccion', 'Fecha deducción', ['class' => 'control-label']) !!}
                                        {!! Form::date('fecha_deduccion', old('fecha_deduccion'), ['class' => 'form-control', 'placeholder' => 'Fecha deducción', 'required' => '']) !!}
                                        <p class="help-block"></p>
                                        @if($errors->has('fecha_deduccion'))
                                            <p class="help-block">
                                                {{ $errors->first('fecha_deduccion') }}
                                            </p>
                                        @endif
                        
                        {!! Form::label('valordeducciones', 'Valor deducción', ['class' => 'control-label']) !!}
                                 <input class="form-control" type="text" id="valordeducciones" value="" placeholder="Valor($)" name="valordeducciones" onkeyup="applyMask(this)" onChange="entero()" required >
                         <input type="hidden" name="valor" id="valor" class="form-control" value="" required>
                            
       

       
                                {!! Form::label('observaciones', 'Observaciones de la deducción', ['class' => 'control-label']) !!}
                                {!! Form::textarea('observaciones', old('observaciones'), ['class' => 'form-control','rows' => 1, 'placeholder' => 'Observaciones de la deducción', 'required' => '']) !!}
                                <p class="help-block"></p>
                                @if($errors->has('observaciones'))
                                    <p class="help-block">
                                        {{ $errors->first('observaciones') }}
                                    </p>
                                @endif



                                 {!! Form::submit('Crear', ['class' => 'btn btn-success', 
                                 //'onclick' => "valor()"
                                 ]) !!}
    {!! Form::close() !!}
             
 
        </div>
        <div class="col-md-3">
            <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Detalles deducciones</b></h4>

              <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                          <th>Valor</th>
                          <th>Fecha</th>
                    </tr>
                </thead>

              <tbody>
               @if (count($deducciones) > 0)
                        @foreach ($deducciones as $deduccion)
                          <tr data-entry-id="{{ $deduccion->id }}">
                             <td field-key='name'>${{number_format($deduccion->valor)}}<br/>
                                {{$deduccion->observaciones}}
                             </td>
                              <td field-key='name'>{{$deduccion->fecha_deduccion}}
                                <a href="{{ route('admin.propietarios_deducciones.edit',[$deduccion->id]) }}" class="btn btn-primary" target="_blank">Editar</button></td>
                              </td>
                            
                          </tr>
                        @endforeach
                @endif
             </tbody>
             </table>

             
              <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">Total Deducciones
                                <h4 style="font-weight:700;">${{number_format($total_deducciones)}}</h4>
                                </span>


        </div>
    </div>
</div>






 <script>
        @can('document_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.documents.mass_destroy') }}'; @endif
        @endcan

    </script>

<script type="text/javascript" src="{{url('js/currency.min.js')}}"></script>

<script>

        function editar(id) {
            $("#mostrarmodal").modal("show");
            var id_usuario= document.getElementById("id_propietario").value;
            var fecha_deduccion= document.getElementById("fecha_deduccion").value;
            var url = "admin.propietarios_deducciones.editdeduccion"+id_usuario+"";
            //var fechadeduccion=$url->fecha_deduccion;
            //$("#fecha_deduccion1").value = url.value;
            //document.getElementById("fecha_deduccion1").value = id_usuario
            document.getElementById("fecha_deduccion1").value = fecha_deduccion
           
            console.log(id_usuario);
        };

        function applyMask(valueInput){
   var removeValue = currency(valueInput.value).value;
    valueInput.value = setCurrency(removeValue);
  
}


function setCurrency(value){
    return currency(value, { fromCents: true, precision: 0 }).format();;
}

</script>

<script>

function entero(){
    var valordeducciones=document.getElementById("valordeducciones").value;
    document.getElementById("valor").value= currency(valordeducciones).value;
}

</script>

@stop

