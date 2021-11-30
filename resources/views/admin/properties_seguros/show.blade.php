@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.seguros.title')</h3>
     <a href="{{ route('admin.properties_sub.unidades_consulta',[$seguro->propiedad->id])}}" class="btn btn-success">@lang('global.app_back_to_list')</a>

    <div class="panel panel-default">

         <div class="inner">
        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-7">

                      @if($seguro->estado==2)
                        Este seguro está desactivado
                        @endif<br/>

                   

              @if($seguro->estado==1)

                   @can('properties_seguros_view')
                                            <a target="_blank" href="{{ route('admin.properties_seguros.edit',[$seguro->id]) }}" class="" style="color:#fff" data-toggle="tooltip" title="{{$seguro->id}}" style="color:#fff;padding:0px">
                                               <span class="btn btn-info">Editar Seguro
                                               </span>
                                            </a>
                        @endcan



                        @can('properties_seguros_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("¿Quieres eliminar este seguro?")."');",
                                        'route' => ['admin.properties_seguros.destroy', $seguro->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-danger')) !!}
                                    {!! Form::close() !!}
                        @endcan

                    <table class="table table-bordered table-striped" id="detalles">
                          <tr>
                            <th>Propiedad principal</th>
                            <td field-key='seguro_empresa'>
                                <a href="#" data-toggle="tooltip" title="Principal: {{$seguro->propiedad->name}}">
                                {{ $seguro->propiedad->name }}
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <th>Unidad Asegurada</th>
                            <td field-key='seguro_empresa'>
                                <a href="#" data-toggle="tooltip" title="Unidad: {{$seguro->unidad_seguro->nombre}}">
                                {{ $seguro->unidad_seguro->nombre }}
                                </a>

                                  

                            </td>
                            <th>@lang('global.seguros.fields.empresa')</th>
                            <td field-key='seguro_empresa'>
                                <a href="#" data-toggle="tooltip" title="Id: {{$seguro->id}}">
                                {{ $seguro->empresa }}
                                </a>

                                  

                            </td>
                             <th>Costo Anual</th>
                            <td field-key='valor'>
                                <a href="#" data-toggle="tooltip" title="Costo: {{$seguro->valor}}">
                                ${{number_format($seguro->valor), 0, ',', '.' or '' }}
                                </a>
                            </td>
                           <!--  <th>Cobertura</th>
                            <td field-key='cobertura'>
                                <a href="#" data-toggle="tooltip" title="Cobertura:  ${{number_format($seguro->cobertura), 0, ',', '.' or '' }}">
                                ${{number_format($seguro->cobertura), 0, ',', '.' or '' }}
                                </a>
                            </td>-->
                        </tr>
                    </table>
                </div>
            </div>

              <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.seguros.fields.fechainicio')</th>
                            <td field-key='fecha_inicio'>
                                <a href="#" data-toggle="tooltip" title="Fecha inicio seguro: {!! date('d/F/Y', strtotime($seguro->fecha_inicio)) !!}">
                                {!! date('d/F/Y', strtotime($seguro->fecha_inicio)) !!}
                                </a>
                            </td>
                             <th>Fecha vigencia</th>
                             <td field-key='fecha_fin'>
                                <a href="#" data-toggle="tooltip" title="Fecha Fin seguro: {!! date('d/F/Y', strtotime($seguro->fecha_fin)) !!}">
                                {!! date('d/F/Y', strtotime($seguro->fecha_fin)) !!}
                                </a>
                            </td>

                              <th>Estado</th>
                               <td field-key='estado'>
                              
                                    <h5 style="font-weight:400;">
                                        <a href="#"data-toggle="tooltip" title="Estado" style="color:#fff">

                                            @if($seguro->estado == 1)
                                         <span class="label label-success" style="padding-bottom:8px;padding-top:8px">
                                            Activo
                                        </span>
                                            @else
                                       <span class="label label-danger" style="padding-bottom:8px;padding-top:8px;">
                                            Inactivo
                                            @endif
                                        </span>


                                        </a>
                                    </h5>
                                </span>     
                            </td>
                        </tr>


                        </tr>
                    </table>
                </div>
            </div>

               <div class="row">
                <div class="col-md-7">
                      <table class="table table-bordered table-striped">
                         <tr>
 
                      <th>@lang('global.seguros.fields.observaciones')</th>
                      <td field-key='referencias'>{{ $seguro->observaciones }}</td>

                  </tr>
              </table>

                </div>
            </div>


            <p>&nbsp;</p>




    
     


    <a href="{{ route('admin.properties_sub.unidades_consulta',[$seguro->propiedad->id])}}" class="btn btn-success">@lang('global.app_back_to_list')</a>
        </div>
    </div>
    @endif
@stop