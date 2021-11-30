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
           

            <li><a href="{{ route('admin.properties.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
              <li><a href="{{ route('admin.properties.index_tabla') }}" style="">Buscar</a></li> |
            <li><a href="{{ route('admin.properties.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>

        </ul>
    </p>

        <aside class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
            <div class="panel panel-default" style="margin-top: 20px;border:0px;border-color:#fff">
                <div class="panel-heading" style="background-color:#fff;border-color:#fff;">
                    <div class="widget w-wethear" style="height: 119px;border-radius:10px;border-bottom: 2px solid #fff;background: #fff;border: 2px solid #2c587b;color:#2c587b">
                            <div class="wethear-now inline-items" style="margin-top:0px">
                                    <div class="temperature-sensor" style="margin-top:-15px;font-size: 65px;font-weight: 600;">
                                       <a href="{{ route('admin.properties.index_tabla') }}"> 
                                        {{$properties->count()}}
                                        </a>
                                    </div>
                                    <div class="max-min-temperature" style="line-height: 22px;">
                                            <span>
                                               <a href="{{ route('admin.properties.index_tabla') }}">   
                                                Propiedades
                                                </a>
                                            </span>
                                         

                                   <a href="{{ route('admin.system_params.index') }}" class="post-category bg-primary" style="font-size:12px;border: 1px solid #fff;
    border-radius: 4px;background: #e36b6a;">Ver Parametros</a>
                                    </div>
                            </div>
                    </div>
                   

                     <div class="widget w-birthday-alert" style="height: 100px;border-radius:10px;margin-top:-2px;color:#fff;border-top: 2px solid #fff;padding-top:0px;padding: 18px;background: #2c587b;">
                              <div class="wethear-now inline-items" style="margin-top:0px">
                                    <div class="max-min-temperature" style="font-size: 42px;">{{$unidades->count()}}
                                    </div>
                                    <div class="max-min-temperature">
                                        <span style="line-height: 1;">Unidadas<br/>
                                            Administradas
                                        </span>
                                    </div>
                                     <div class="max-min-temperature" style="float:right;">
                                   
                                             <a href="{{ route('admin.properties_sub.index') }}" class="btn btn-sm bg-blue" style="margin-top:8px; border: 2px solid #fff;">Ver
                                             </a>
                                    
                                    </div>
                                </div>
                    </div>

                     <div class="widget w-birthday-alert" style="height: 102px;border-radius:10px;margin-top:-10px;color:#fff;border-top: 2px solid #fff;padding-top:0px;padding: 18px;background: #2c587b;">
                              <div class="wethear-now inline-items" style="margin-top:-17px">
                                    <div class="max-min-temperature" style="font-size: 52px;">{{$inquilinos->count()}}
                                    </div>
                                    <div class="max-min-temperature">
                                        <span style="line-height: 1;">Inquilinos<br/>
                                            Gestionados
                                        </span>
                                    </div>
                                     <div class="max-min-temperature" style="float:right;">
                                   
                                             <a href="{{ route('admin.tenants.index') }}" class="btn btn-sm bg-blue" style="margin-top: 13px; border: 2px solid #fff;">Ver
                                             </a>
                                    
                                    </div>
                                </div>
                    </div>

                       <div class="widget w-birthday-alert" style="height: 100px;border-radius:10px;margin-top:-18px;color:#fff;border-top: 2px solid #fff;padding-top:0px;padding: 18px;background: #2c587b;">
                              <div class="wethear-now inline-items" style="margin-top:-20px">
                                    <div class="max-min-temperature" style="font-size: 52px;padding-left:20px">{{$seguros->count()}}
                                    </div>
                                    <div class="max-min-temperature">
                                        <span style="line-height: 1;">Unidades<br/>
                                            Aseguradas
                                        </span>
                                    </div>
                                     <div class="max-min-temperature" style="float:right;">
                                   
                                             <a href="{{ route('admin.properties_sub.index') }}" class="btn btn-sm bg-blue" style="margin-top: 13px;float: right; border: 2px solid #fff;">Ver
                                             </a>
                                    
                                    </div>
                                </div>
                    </div>

                      <div class="widget w-birthday-alert" style="height: 105px;border-radius:10px;margin-top:-18px;color:#fff;border-top: 2px solid #fff;padding-top:0px;padding: 18px;background: #2c587b;">
                              <div class="wethear-now inline-items" style="margin-top:-20px">
                                    <div class="max-min-temperature" style="font-size: 52px;padding-left:20px">{{$propietarios->count()}}
                                    </div>
                                    <div class="max-min-temperature">
                                        <span style="line-height: 1;">Propietarios<br/>
                                            Satisfechos
                                        </span>
                                    </div>
                                     <div class="max-min-temperature" style="float:right;">
                                   
                                             <a href="{{ route('admin.properties_propietarios.indextotal') }}" class="btn btn-sm bg-blue" style="margin-top: 13px;float: right; border: 2px solid #fff;">Ver
                                             </a>
                                    
                                    </div>
                                </div>
                    </div>
                    
                     
                  
                    
                     <div class="widget w-action" style="border-radius:10px;margin-top:-25px;color:#fff;padding-left: 45px;border-top: 2px solid #fff;padding-top:0px;background: #e36b6a;">
                              <div class="wethear-now inline-items" style="margin-top:0px">
                                <div class="temperature-sensor" style="font-size:30px;padding-top:25px;padding-top: 27px;
    margin-left: -17px;font-weight: 600;">
                                     <span style="line-height: 0.8px;font-size:16px;float: left;font-weight: 600;">Cartera total
                                        </span>
                                ${{number_format($facturas)}}</div>
                                   
                                </div>
                              </div>
                    </div>
        </aside>


    

    <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#fff;border-color:#fff;">
             <h3 class="page-title" style="font-weight:700;"></h3>
        </div>
<!--{{$fecha}} {{$fecha2}}-->
        <!--Olympus-->
        <!-- Friends -->

<div class="container">
    <div class="row" style="padding-bottom:0px;margin-bottom:0px;">
         @if (count($properties) > 0)
                        @foreach ($properties as $property)
        <div class="col col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="ui-block" style="height: 411px;">
                
                <!-- Friend Item -->

               
                
                <div class="friend-item">
                    <div class="friend-header-thumb">
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_self">
                            <img src="{{ asset('olympus/app/img/img-mapa.jpg')}}" style="object-fit:cover;height:100px;width:100%"/>
                        </a>
                           @if ($property->inquilinos()->count() > 0 && $property->unidades()->count() > 0)
                            <div class="control-block-button post-control-button"  style="float:left;">
                                <a href="{{route('admin.properties_sub.unidades_consulta',[$property->id])}}" class="btn btn-control featured-post" style="width:93px;padding-top:7px;background:#41a541;margin-top: -91px;border-radius:4px;padding-right: 15px;padding-left: 8px; border:2px solid #fff;height:46px;" data-toggle="tooltip" title="Nivel de ocupación: {{number_format($property->inquilinos()->count()/$property->unidades()->count()*100)}}%">
                                    <div class="title">
                                        <h5 style="text-align:left;">Ocupada
                                        <br/>
                                         <div class="skills-item-meter responsive" style="padding-top:10px;padding-right:23px;">
                                              <span class="skills-item-meter-active skills-animate" style="width:38px; opacity:1;background:linear-gradient(to right,#ff9432,#79a42e);height:8px;border:1px solid #fff"></span>
                                        <h5 class="skills-item-meter-active skills-animate" style="opacity:1;">{{number_format($property->inquilinos()->count()/$property->unidades()->count()*100)}}%
                                        </h5>
                                        </div>
                                        
                                    </div>
                                </a>
                            </div>
                            @endif
                            @if ($property->facturas_valor($property->id)-$property->facturas_pagadas_propiedad($property->id) == 0 )
                            <div class="control-block-button post-control-button"  style="float:right;">
                                <a href="{{ route('admin.properties_facturas.facturas_propiedad_consulta',[$property->id]) }}" class="btn btn-control featured-post" style="width:132px;padding-top:9px;background:#41a541;margin-top: -91px;border-radius:4px;border:0.8px solid #fff"data-toggle="tooltip" title="Pagos al dia ${{number_format($property->facturas_pagadas_propiedad($property->id)), 0, ',', '.'}}">
                                    <div class="title"><h5> Al día <!--${{number_format($property->facturas_valor($property->id)-$property->facturas_pagadas_propiedad($property->id)), 0, ',', '.'}}-->
                                    </h5></div>
                                </a>
                            </div>
                             @endif

    
                      
                            @if($property->valor_vencido($property->id)> 0)
       
                            <div class="control-block-button post-control-button"  style="float:right;z-index:5000000" >
                            <a href="{{ route('admin.properties_facturas.facturas_propiedad_consulta',[$property->id]) }}" class="btn btn-control featured-post" style="width:133px;padding-top:9px;background:#e66a6a;margin-top:-91px;border-radius:4px;"data-toggle="tooltip" title="Por recaudar">
                                    <div class="title" style="padding-left:4px;"><h5>Cartera:
                                        ${{number_format($property->valor_vencido($property->id)), 0, ',', '.'}}</h5></div>
                                </a>
                        
                            </div>
                            @endif
                            @if ($property->inquilinos()->count() == 0)
                             <div class="control-block-button post-control-button"  style="float:left;z-index:5000000" >
                                <a href="{{route('admin.properties_sub.unidades_consulta',[$property->id])}}" class="btn btn-control featured-post" style="width:86px;padding-top:7px;background:#e66a6a;margin-top: -91px;border-radius:4px;padding-right: 25px;padding-left: 8px; border:2px solid #fff" data-toggle="tooltip" title="Nivel de ocupación:0%">
                                    <div class="title"><h5>Por Ocupar</h5></div>
                                </a>
                            </div>
                            @endif
                    </div>
                
                    <div class="friend-item-content">
                        <div class="friend-avatar">
                            <div class="author-thumb">
                                @if($property->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $property->photo) }}"/></a>@endif
                            </div>

 <div class="author-content">
                                <div class="control-block-button post-control-button"  style="z-index:6000000" >
          
             @if($property->propietarios() > 0)
              <a target="_self" href="{{ route('admin.tenants.informe_inquilinos_consulta',[$property->id]) }}" class="btn btn-control featured-post" style="width:100%;padding-top:7px;background:rgba(104,111,219,.2);color:#262d9e;margin-top:0px;border-radius:4px;padding-right: 15px;padding-left: 8px; border:2px solid rgba(104,111,219,.2);z-index:6000000;border-radius: 100px;font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;" data-toggle="tooltip" title="Ver Informes">
                <div class="title" style="line-height:1px;color:#262d9e;border-radius: 100px; font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;">
                    <h5 style="font-weight: 700;">Ver Informes
                   </h5>
                </div>
            </a>
            @else
              <a target="_self" href="{{ route('admin.properties_propietarios.create',[$property->id])}}" class="btn btn-control featured-post" style="width:100%;padding-top:7px;background:#e36b6a;color:#fff;margin-top:0px;border-radius:4px;padding-right: 15px;padding-left: 8px; border:2px solid rgba(104,111,219,.2);z-index:6000000;border-radius: 100px;font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;border: 2px solid #e36b6a;" data-toggle="tooltip" title="Crear Propietario">
                <div class="title" style="line-height:1px;color:#fff;border-radius: 100px; font-family: proxima-nova,Avenir,sans-serif;letter-spacing: 0;font-weight: 600;border:0px">
                    <h5 style="font-weight: 700;">Crear Propietario
                   </h5>
                </div>
            </a>            
            @endif
        </div>
    </div>
                            <div class="author-content">




                                <a href="{{ route('admin.properties.show',[$property->id]) }}" target="_self" class="h4 author-name" style="font-weight:800">{{ $property->name }}

                                        @can('property_view')
                                            <a target="_self" href="{{ route('admin.properties.show',[$property->id]) }}" class="" style="color:#fff" data-toggle="tooltip" title="{{$property->id}}" style="color:#fff;padding:0px">
                                               <span class="label label-info" style="margin-left:10px;padding:10px;color:#fff">Ver
                                               </span>
                                            </a>
                                        @endcan
                                    
                                </a>
                                 
                                <div class="country">{{ $property->tipo_propiedad->tipo }}</div>
                                <div class="country">{{ $property->address }}</div>
                            </div>
                        </div>
                
                        <div class="swiper-container" data-slide="fade" style="padding-bottom:3px;overflow: unset;">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="friend-count" data-swiper-parallax="-500">

                                        <a href="{{route('admin.properties_sub.unidades_consulta',[$property->id])}}" class="friend-count-item" 
                                        data-toggle="tooltip" title="Ver">
                                          <div class="items-round-little bg-primary">{{ $property->unidades()->count() }}
                                          </div>
                                          <div class="title text-center">@lang('global.properties.fields.unidades')
                                          </div>
                                        </a>
                                        @if($property->propietarios() == 0) 
                                        <a href="{{ route('admin.properties_propietarios.create',[$property->id]) }}" class="friend-count-item" 
                                        data-toggle="tooltip" title="Crear">
                                            <div class="items-round-little bg-blue" style="text-align:center;">{{ $property->propietarios()}}
                                            </div>
                                            <div class="title" style="text-align:center;">#Propietarios</div>
                                        </a>
                                        @endif
                                      @if($property->propietarios() >= 1) 
                                          <a href="{{ route('admin.properties_propietarios.index',[$property->id]) }}" class="friend-count-item" 
                                        data-toggle="tooltip" title="Ver">
                                            <div class="items-round-little bg-blue" style="text-align:center;">{{ $property->propietarios()}}
                                            </div>
                                            <div class="title" style="text-align:center;">#Propietarios</div>
                                        </a>
                                    
                                    @endif
                                        <a href="{{ route('admin.properties_sub.create',[$property->id]) }}" class="btn btn-success" 
                                        data-toggle="tooltip" title="Crear Unidad">+ Unidad
                                        </a>

                                  
                                 
                                       
                                    </div>

                                    <div class="control-block-button" data-swiper-parallax="-100">
                                        <!--<div class="title">@lang('global.properties.fields.unidades')
                                        </div>-->
                                        <a href="{{route('admin.tenants.inquilinos_consulta',[$property->id])}}" class="btn btn-control bg-blue" data-toggle="tooltip" title="# Inquilinos" style="height:39px;border-radius:20px">
                                            <div class="h4" style="color:#fff;font-weight: 500;font-size:25px;margin-top:5px">{{ $property->inquilinos()->count() }}
                                           </div>
                                        </a>
                                        <!--<div class="title">@lang('global.properties.fields.unidades')
                                        </div>-->
                                        <a href="{{ route('admin.properties_facturas.facturas_propiedad_consulta',[$property->id]) }}" class="btn btn-control bg-primary" data-toggle="tooltip" title="# facturas" style="height:40px;border-radius:20px">
                                            <div class="h4" style="color:#fff;font-weight: 500;font-size:25px;margin-top:5px">{{ $property->facturas()->count() }}                        
                                            </div>
                                        </a>

                
                                    </div>  
                                   
                                </div>
                
                              
                            </div>
                
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>@endforeach @endif</div></div></div>


   

<!-- ... end Friends -->


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
                                <td field-key='photo'>@if($property->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_self"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $property->photo) }}"/></a>@endif</td>
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

.birthday-item.badges .skills-item-meter-active {
    background: linear-gradient(to right,#ff9432,#79a42e);
}

.birthday-item.badges .birthday-date {
    font-size: 15px;
}

.birthday-item.badges .skills-item {
    min-width: 184px;
    display: block;
    float: right;
    margin-bottom: 0;
    margin-top: 4px;
    margin-right:-50px;
}



.skills-item .skills-item-meter {
    padding: 0;
    width: 71%;
    border-radius: 10px;
    background-color: #fff;
    position: relative;
    height: 6px;
}

.birthday-item.badges .skills-item {
    min-width: 184px;
    display: block;
    float: right;
    margin-bottom: 0;
    margin-top: 4px;
    margin-right:-50px;
}


</style>

@section('javascript') 
    <script>
        @can('property_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.properties.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection