@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!--<h3 class="page-title">@lang('global.properties.title')</h3>-->
    <h3 class="page-title" style="font-weight:700;">@lang('global.properties.title')</h3>
    @can('property_create')
    <p>
        <a href="{{ route('admin.properties.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
           <li><a href="{{ route('admin.properties.index') }}" style="{{ request('show_deleted') == 1 ? '' : '' }}">@lang('global.app_all')</a></li> |
              <li><a href="{{ route('admin.properties.index_tabla') }}" style="font-weight: 700">Tabla</a></li> |
            <li><a href="{{ route('admin.properties.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>

        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#fff;border-color:#fff;">
             <h3 class="page-title" style="font-weight:700;">@lang('global.app_list')</h3>
        </div>
      <div class="panel-body table-responsive" style="padding:15px;margin-top:0px;">
            <table class="table table-bordered table-striped {{ count($properties) > 0 ? 'datatable' : '' }} @can('property_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('property_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.properties.fields.name')</th>
                        <th>@lang('global.properties.fields.tipo')</th>
                        <th># Propietarios</th>
                        <th>@lang('global.properties.fields.unidades')</th>
                        <th># Inquilinos</th>
                         <th>@lang('global.properties.fields.address')</th>
                        <th>@lang('global.properties.fields.photo')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($properties) > 0)
                        @foreach ($properties as $property)
                            <tr data-entry-id="{{ $property->id }}">
                                @can('property_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='name'>{{ $property->name }}

            @if($property->propietarios() > 0)
              <a target="_self" href="{{ route('admin.tenants.informe_inquilinos_consulta',[$property->id]) }}" class="btn btn-control featured-post" style="height:23px; width:60%;padding-top:7px;background:rgba(104,111,219,.2);color:#262d9e;margin-top:0px;border-radius:4px;padding-right: 15px;padding-left: 8px; border:2px solid rgba(104,111,219,.2);z-index:6000000;border-radius: 100px;font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;" data-toggle="tooltip" title="Ver Informes">
                <div class="title" style="line-height:0.2px;color:#262d9e;border-radius: 100px; font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;">
                    <h5 style="font-weight: 700;">Ver Informes
                   </h5>
                </div>
            </a>
            @else
             <a target="_self" href="{{ route('admin.properties_propietarios.create',[$property->id]) }}" class="btn btn-control featured-post" style="height:23px; width:60%;padding-top:7px;background:#262d9e;color:#262d9e;margin-top:0px;border-radius:4px;padding-right: 15px;padding-left: 8px; border:2px solid rgba(104,111,219,.2);z-index:6000000;border-radius: 100px;font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;" data-toggle="tooltip" title="Crear Propietario">
                <div class="title" style="line-height:0.2px;color:#fff;border-radius: 100px; font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;">
                    <h5 style="font-weight: 700;">Crear Propietario
                   </h5>
                </div>
            </a>
            @endif


                                </td>
                                <td field-key='tipo'>{{ $property->tipo_propiedad->tipo }}</td>
                                <td field-key='propietarios'>{{ $property->propietarios() }}</td>
                                <td field-key='unidades'>
                                    <a href="{{route('admin.properties_sub.unidades_consulta',[$property->id])}}">{{ $property->unidades()->count() }}</a></td>
                                
                              
                                <td field-key='inquilinos'>
                                
                                    <a href="{{route('admin.tenants.inquilinos_consulta',[$property->id])}}">{{ $property->inquilinos()->count() }}
                                    </a>
                               
                                </td>
                                
                                

                                <td field-key='address'>{{ $property->address }}</td>
                                <td field-key='photo'>@if($property->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $property->photo) }}"/></a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties.restore', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties.perma_del', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('property_view')
                                    <a href="{{ route('admin.properties.show',[$property->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('property_edit')
                                    <a href="{{ route('admin.properties.edit',[$property->id]) }}" class="btn btn-xs btn-info">editar</a>
                                    
                                    @if($property->id_tipo==2)
                                     <a href="{{ route('admin.properties_sub.create',[$property->id]) }}" class="btn btn-xs btn-success">+ Unidad</a>

                                    <a href="{{ route('admin.properties_sub.create',[$property->id]) }}" class="btn btn-xs btn-warning">+ Inquilino</a>

                                     @endif
                                    
                                    @endcan
                                    @can('property_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties.destroy', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

        <!--Olympus-->
        <!-- Friends -->




   

<!-- ... end Friends -->



      



@stop

<style>
.author-thumb img {
    border-radius: 100%;
    overflow: hidden;
    width: 100px;
}

.friend-item-content {
    margin-bottom: -174px;
}

.friend-avatar {
    margin-top: -75px;
    position: relative;
    margin-bottom: -17px;
}

.friend-avatar .author-thumb {
    /* margin: 0 auto; */
    height: 98px;
    width: 98px;
    margin-bottom: 2px;
    margin-top: -20px;
}

.content {
    min-height: 250px;
    padding: 15px;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
    background: #fff;
}



.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 0px solid transparent;
    border-radius: 4px;
}

.panel-default {
    border-color: #fff;
}

.friend-item .btn-control {
    margin-bottom: 0;
    margin-right: 14px;
    width: 40px;
}

.swiper-container {
    margin: 0 auto;
    position: relative;
    overflow: unset;
    z-index: 3;
}

.items-round-little.bg-primary {
margin:auto;
}

.items-round-little.bg-blue {
margin:auto;
}

.friend-count {
    margin-bottom: 35px;
    margin-top: 4px;
    border: 2px solid #ffffff;
    padding-top:0px;
    border-radius: 6px;
}

.friend-count-item {
    display: inline-block;
    margin-right: 0px;
    border-right: 1px solid #dae2ec;
    margin: auto;
    padding: 9px;
    margin-top: 4px;
}

.btn-success {
    background-color: #00a65a;
    border-color: #008d4c;
    margin-top: -5px;
    margin-left: 5px;
}

</style>

@section('javascript') 
    <script>
        @can('property_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.properties.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection