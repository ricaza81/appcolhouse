@extends('layouts.app')

@section('content')
    <h3 class="page-title">Parametros del Sistema</h3>
    @can('document_create')
    <p>
       <!-- <a href="{{ route('admin.documents.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>-->
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">

            @lang('global.app_all')</a></li> |
          
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

      <div class="panel-body table-responsive">


        
          <div class="row">

             <div class="col-md-3">
                 <a href="" target="_blank">
                            <img src="{{ asset('img_param.png')}}" style="object-fit:cover;height:100%;width:100%"/>
                        </a>
             </div>

            <div class="col-md-4">
                 <h4 class="page-title" style="font-weight:700;letter-spacing:-1px;"><b>Detalles de Parametros del Sistema</b></h4>
           


            <table class="table table-bordered table-striped">
                  @if (count($params) > 0)
                        @foreach ($params as $param)
                        <tr>
                        <th>{{$param->parametro}}</th>
                            <td> {{$param->valor*100}}%
                                  <a href="{{route('admin.system_params.edit',[$param->id])}}" data-toggle="tooltip" title="Editar Parametro">
                                     <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                                    </span>
                                </a>
                            </td>
                             @endforeach
                        </tr>
                       
                       
                        <tr> @else
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif      
                   
            </table>

            Fecha del servidor: {{$zona_horaria->toFormattedDateString()}}<br/>
            <!--Hora del servidor: {{$zona_horaria->toTimeString()}}<br/>-->
            <!--Mes del servidor: {{$mes}}<br/>-->
            Hora del servidor: {{$hora}}<br/>
            Zona Horaria del servidor: <a href="https://bit.ly/2UhZnbg" target="_blank">UTC-5 / (America/Bogota)</a><br/>
        </div>
    </div>
</div>
</div>



@stop

@section('javascript') 
    <script>
        @can('document_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.documents.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection