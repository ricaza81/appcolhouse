<!DOCTYPE html>
<html lang="es">

<head>
    @include('/landing/partials.header')
</head>



  <!-- ======= Intro Section ======= -->
  <div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">
         @foreach ($properties_slider as $property)
            @if ($property->inquilinos()->count()==0)
    
    <div class="carousel-item-a intro-item bg-image" style="background-image: url(landing/assets/img/slide-1.jpg)">
     
    
        <div class="overlay overlay-a" style="opacity:80%;"></div>
        <div class="intro-content display-table" >
          <div class="table-cell" style="padding-top:0px">
            <div class="container">
              <div class="row">
                <div class="col-lg-8" style="margin-top:-10px;">
                  <div class="intro-body">
                  
                    <h1 class="intro-title mb-4" style="letter-spacing:-3px">
                      <span class="color-b" style="color:#fff;-webkit-text-stroke: 0px #000;">${{number_format($property->renta), 0, ',', '.'}}
                      </span> <!--Norte-->
                    </h1>
                    <h2 class="intro-title mb-4" style="text-transform:none;font-size: 60px;margin-top:-30px;font-weight:500;">
                      <span class="color-b" style="color:#fff;-webkit-text-stroke: 0px #000;">
                      {{$property->metros_cuadrados}}m
                          <sup style="letter-spacing: -1px;margin-left:-18px;font-size:34px">2
                           </sup>
                       </span>                              
                    </h2>
                       
                      <span class="" style="text-transform:capitalize;letter-spacing:0px;font-size:30px;color:#ffffff;
                      /*-webkit-text-stroke: 1px #fff;*/
                      ">
                        {{$property->tipo_propiedad_sub->tipo}}
                     </span>
                    
                    
                   
                    <h3>
                      <span class="color-b" style="color:#ffffff;-webkit-text-stroke: 2px #fff;">
                      </span>
                    </h3>
                    <p class="intro-subtitle intro-price" >
                      <a href="{{route ('landing.contacto',[$property->id]) }}"><span class="price-a" style="background:#2eca6a;">Solicitar</span>
                      </a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      @endforeach
      <!--<div class="carousel-item-a intro-item bg-image" style="background-image: url(landing/assets/img/slide-2.jpg)">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    <p class="intro-title-top">La merced, Cali
                      <br> Centro
                    </p>
                    <h1 class="intro-title mb-4">
                      <span class="color-b" style="-webkit-text-stroke:2px #fff">$450.000 </span> Centro
                      <br> Cali, La merced
                    </h1>
                    <p class="intro-subtitle intro-price">
                      <a href="{{ route('auth.login') }}"><span class="price-a">Solicitar en línea</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item-a intro-item bg-image" style="background-image: url(landing/assets/img/slide-3.jpg)">
        <div class="overlay overlay-a"></div>
        <div class="intro-content display-table">
          <div class="table-cell">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="intro-body">
                    <p class="intro-title-top">San Fernando, Cali
                      <br> Oeste
                    </p>
                    <h1 class="intro-title mb-4">
                      <span class="color-b" style="-webkit-text-stroke:2px #fff">$430.000 </span> Oeste
                      <br> Cali, San Fernando
                    </h1>
                    <p class="intro-subtitle intro-price">
                      <a href="{{ route('auth.login') }}"><span class="price-a">Solicitar en línea</span></a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->
    

      </div>
    </div>
  </div><!-- End Intro Section -->

  <main id="main">
<!--
{!! Form::open(['method' => 'POST', 'route' => ['admin.properties_sub.store']]) !!}

    <div class="container" style="padding-top:45px">
    <div class="row">
    <div class="col-md-12 mb-2">
        <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>-->
      <!-- <div class="click-closed"></div>-->
     <!--   <div class="box-collapse">-->
 <!--   <div class="title-box-d">
      <h3 class="title-d">Buscar propiedad</h3>
    </div>-->
    <!-- <span class="close-box-collapse right-boxed ion-ios-close"></span>-->
    <!--<div class="box-collapse-wrap form">-->
   
    <!--  <form class="form-a">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              <label for="Type">Palabra clave</label>
              <input type="text" class="form-control form-control-lg form-control-a" placeholder="Palabra clave">
            </div>
          </div>
          <div class="col-md-6 mb-2">
           {!! Form::label('tipo', trans('global.properties.fields.tipo').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_tipo_sub', $tipos, old('id_tipo_sub'), ['class' => 'form-control', 'placeholder' => 'Tipo', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_tipo_sub'))
                        <p class="help-block">
                            {{ $errors->first('id_tipo_sub') }}
                        </p>
                    @endif
          </div>
          <div class="col-md-6 mb-2">
            {!! Form::label('ciudad', trans('global.ciudades.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_ciudad', $ciudades, old('id_ciudad'), ['class' => 'form-control', 'placeholder' => 'Ciudad', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_ciudad'))
                        <p class="help-block">
                            {{ $errors->first('id_ciudad') }}
                        </p>
                    @endif
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="bedrooms">Baños</label>
              <select class="form-control form-control-lg form-control-a" id="bedrooms">
                <option>Ver todos</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="garages">Parqueadero</label>
              <select class="form-control form-control-lg form-control-a" id="garages">
                <option>Ver todos</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="bathrooms">Area(m2)</label>
              <select class="form-control form-control-lg form-control-a" id="bathrooms">
                <option>Cualquiera</option>
                <option>50</option>
                <option>100</option>
                <option>400</option>
              </select>
            </div>
          </div>
          <div class="col-md-6 mb-2">
            <div class="form-group">
              <label for="price">Valor arrendamiento</label>
              <select class="form-control form-control-lg form-control-a" id="price">
                <option>Todas</option>
                <option>$250,000</option>
                <option>$500,000</option>
                <option>$1,500,000</option>
                <option>$2,000,000</option>
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-b" style="color:#fff;background:#00b2f0">Buscar propiedades</button>
          </div>
        </div>
      </form>
    </div>
  </div>-->
  </div>
</div>
</div>

        <!-- ======= Latest Properties Section ======= -->
    <section class="section-property section-t8" style="margin-top:-50px">
      <div class="container" style="margin-top: -51px;
    padding-top: 25px;">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box" style="padding-top:52px">
                <h2 class="title-a">Inmuebles disponibles</h2>
              </div>
              <!--<div class="title-link">
                <a href="#">Ver todas
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>-->
            </div>
          </div>
        </div>

    <div class="container" style="margin-top:-40px">
        <div class="row" style="margin-bottom:30px;">
           @foreach ($properties as $property)
            @if ($property->inquilinos()->count()==0)

           
           <div class="col-md-4" style="border-radius:7px;">
              <div class="carousel-item-b" style="margin-bottom:31px;border-radius:7px;">
                      <div class="card-box-a card-shadow" style="border-radius:7px;">
                        <div class="img-box-a" style="background-size:contain;border-radius:7px;">
                          <a href="https://colhouse.com.co/crm/public/1631575533-BellaSuiza-ColHouse.jpg" target="_blank">
                          <img src="https://colhouse.com.co/crm/public/1631575533-BellaSuiza-ColHouse.jpg" alt="" class="img-a img-fluid" style="background-size:contain;width: 389px;
    height: 457px;border-radius:7px;"></a>
                        </div>S
                        <div class="card-overlay">
                          <div class="card-overlay-a-content" style="margin-bottom:53px;">
                            <div class="card-header-a" style="margin-top:20px;">
                              <h2 class="card-title-a">
                                <a href="{{route ('landing.contacto',[$property->id]) }}" target="_blank">
                                <!-- {{$loop->iteration}}-->
                                  {{$property->nombre}}
                                  <br /> {{$property->name}}</a>
                                  <br/>
                                  <h4 class="card-title-a" style="color:#fff;font-size:18px;line-height:20px">{{$property->address}}</h4>
                                
                                   <h4 class="card-title-a" style="color:#fff;font-size:18px;line-height:20px">{{$property->tipo_propiedad_sub->tipo}}</h4>
                              </h2>
                            </div>
                            <div class="card-body-a" style="margin-top:30px">
                             <!-- <div class="price-box d-flex" style="float: right;">
                                 <a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" class="link-a" target="_blank"><span class="price-a">Ver detalles</span></a>
                              </div>-->

                              <div class="price-box d-flex" style="float: right;">
                                 <a href="{{route ('landing.contacto',[$property->id]) }}" class="link-a" target="_blank"><span class="price-a">Ver detalles</span></a>
                              </div>
                              <a href="{{route ('landing.contacto',[$property->id]) }}" class="link-a" target="_blank">Solicitar en línea
                                <span class="ion-ios-arrow-forward"></span>
                              </a>
                            </div>
                            <div class="card-footer-a" style="margin-top: 16px;background:#16a2de;">
                              <ul class="card-info d-flex justify-content-around">
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Area</h4>
                                  <span>{{$property->metros_cuadrados}}m
                                    <sup>2</sup>
                                  </span>
                                </li>
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Baños</h4>
                                  <span>{{$property->numero_banos}}</span>
                                </li>
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Cocina</h4>
                                  <span>{{$property->numero_cocinas}}</span>
                                </li>
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Parqueadero</h4>
                                    <span>{{$property->numero_parqueaderos}}</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                  </div>
              </div>
            </div>@endif @endforeach
          </div>
        </div>
      
         
          <div class="container">
        <div class="row" style="margin-bottom:-20px;padding-top:20px">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Detalle de las propiedades</h2>
              </div>
              <!--<div class="title-link">
                <a href="#">Ver todas
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>-->
            </div>
          </div>
        </div>
   <div class="panel-body table-responsive">
           <!-- <table id="" class="table table-bordered table-striped {{ count($properties) > 0 ? 'datatable' : '' }} @can('property_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">-->
               <table id="" class="table table-bordered table-striped {{ count($properties) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <!--@can('property_sub_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan-->

                        <!--<th>@lang('global.properties.fields.name')</th>-->
                        <th>@lang('global.properties_sub.fields.nombre')</th>
                         <th>@lang('global.properties_sub.fields.tipo_sub')</th>
                        <!--<th>@lang('global.properties.fields.address')</th>-->
                       
                        <th>@lang('global.properties_sub.fields.renta')</th>
                        <th>@lang('global.properties_sub.fields.generales')</th>
                        <!--<th>@lang('global.properties_sub.fields.comision')</th>-->
                        <!--<th>@lang('global.properties.fields.photo')</th>-->
                        
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
                             @if ($property->inquilinos()->count()==0)
                        
                         
                            <tr data-entry-id="{{ $property->id }}">
                                <!--@can('property_sub_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan-->

                                <!--<td field-key='name'>{{ $property->name_propiedad($property->id) }}</td>-->
                                <!-- <td field-key='name' style="font-size: 12px;">
                                    {{ $property->name }}-->
                                  <!--  {{ $property->seguros_unidad()->count()}}-->

                                <!--  </td> -->
                                <td field-key='unidad' data-toggle="tooltip" title="" style="font-size: 12px;">

                                     <a href="{{ route('admin.properties_sub.show',[$property->id]) }}">{{ $property->name }}
                                     </a>

                             
                                   <span class="m-status" style="color:#262d9e;background-color:rgba(104,111,219,.2);">
                                    Disponible
                                    </span>
                              

                              


                                </td>
                                <td field-key='tipo'>{{ $property->tipo_propiedad_sub->tipo }}<br/>
                                  Dirección: {{ $property->address }}</td>

                                <!--<td field-key='tipo'></td>-->
                                <td field-key='name' style="text-align:center;">
                                    <span class="label label-info" style="padding:8px;font-size:13px">
                                    $ {{ number_format($property->renta), 0, ',', '.'}}
                                    </span>
                                </td>
                                 <td field-key='detalles' style="width:158px;padding-bottom:30px;" >

                                    <div class="row text-center" style="padding:10px">

                                   <span class="items-round-little bg-blue" data-toggle="tooltip" title="Metros cuadrados" style="padding:3px;border-radius:2px;font-size:13px;border:2px solid #38a9ff;background-color: #fff;color:#38a9ff;margin:5px"> {{ $property->metros_cuadrados }}<br/>m2 </span>
                                    <span class="items-round-little bg-blue" data-toggle="tooltip" title="Número baños" style="padding:4px;border-radius:2px;font-size:12px;border:0px solid #38a9ff;margin:5px"> {{ $property->numero_banos }}<br/>Baño </span>

                                     <span class="items-round-little bg-blue" data-toggle="tooltip" title="Número cocinas" style="padding:4px;border-radius:2px;font-size:12px;border:0px solid #38a9ff;margin:5px;width:43px;/*background:#eaeb13;color:#000*/"> {{ $property->numero_cocinas }}<br/>Cocina</span> 
                               
                                  </div>
                                    <div class="row text-center" style="padding-top:0px;margin-top_-10px">
                                    <span class="items-round-little bg-blue" data-toggle="tooltip" title="# Parqueaderos" style="padding:3px;border-radius:2px;font-size:12px;border:2px solid #38a9ff;background-color: #fff;color:#38a9ff;margin:auto;width:86px"> {{ $property->numero_parqueaderos }}<br/>Parqueadero </span>
                                  </div>

                               
                                   
                                  
                               
                                 </td>
                                
                               
                                <!--<td field-key='address'>{{ $property->address }}</td>-->
                                <!--<td field-key='inquilinos'>{{ $property->inquilinos()->count() }}</td>-->
                                <!--<td field-key='photo'>@if($property->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $property->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $property->photo) }}"/></a>@endif</td>-->
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_sub.restore', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_sub.perma_del', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td style="padding-top:20px ;">
                                  
                                 <!-- 
                                    <a href="{{ route('admin.properties_sub.show',[$property->id]) }}" class="btn btn-xs btn-primary" target="_blank">Ver unidad
                                    </a>-->

                                     <a href="{{route('landing.contacto',$property->id)}}" class="btn btn-xs btn-primary" target="_blank">
                                      Ver unidad
                                     </a>
                                 
                                
                                  
                             
                                 

                                     <a href="{{route('landing.contacto',$property->id)}}" class="btn btn-xs btn-success">Solicitar</a>

                                 

                                   

                                   <!-- @can('property_sub_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.properties_sub.destroy', $property->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan-->
                                </td>
                                @endif
                            </tr>
                          @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
          </div>
      
     


      
    </section><!-- End Latest Properties Section -->

    <!-- ======= Services Section ======= -->
    <!--<section class="section-services section-t8" style="margin-top:-100px;">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Our Services</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card-box-c foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="fa fa-gamepad"></span>
                </div>
                <div class="card-title-c align-self-center">
                  <h2 class="title-c">Lifestyle</h2>
                </div>
              </div>
              <div class="card-body-c">
                <p class="content-c">
                  Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta. Praesent sapien massa,
                  convallis a pellentesque
                  nec, egestas non nisi.
                </p>
              </div>
              <div class="card-footer-c">
                <a href="#" class="link-c link-icon">Read more
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-c foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="fa fa-usd"></span>
                </div>
                <div class="card-title-c align-self-center">
                  <h2 class="title-c">Loans</h2>
                </div>
              </div>
              <div class="card-body-c">
                <p class="content-c">
                  Nulla porttitor accumsan tincidunt. Curabitur aliquet quam id dui posuere blandit. Mauris blandit
                  aliquet elit, eget tincidunt
                  nibh pulvinar a.
                </p>
              </div>
              <div class="card-footer-c">
                <a href="#" class="link-c link-icon">Read more
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-c foo">
              <div class="card-header-c d-flex">
                <div class="card-box-ico">
                  <span class="fa fa-home"></span>
                </div>
                <div class="card-title-c align-self-center">
                  <h2 class="title-c">Sell</h2>
                </div>
              </div>
              <div class="card-body-c">
                <p class="content-c">
                  Sed porttitor lectus nibh. Cras ultricies ligula sed magna dictum porta. Praesent sapien massa,
                  convallis a pellentesque
                  nec, egestas non nisi.
                </p>
              </div>
              <div class="card-footer-c">
                <a href="#" class="link-c link-icon">Read more
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!-- End Services Section -->



    <!-- ======= Agents Section ======= -->
    <!--<section class="section-agents section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Best Agents</h2>
              </div>
              <div class="title-link">
                <a href="agents-grid.html">All Agents
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="card-box-d">
              <div class="card-img-d">
                <img src="landing/assets/img/agent-4.jpg" alt="" class="img-d img-fluid">
              </div>
              <div class="card-overlay card-overlay-hover">
                <div class="card-header-d">
                  <div class="card-title-d align-self-center">
                    <h3 class="title-d">
                      <a href="agent-single.html" class="link-two">Margaret Sotillo
                        <br> Escala</a>
                    </h3>
                  </div>
                </div>
                <div class="card-body-d">
                  <p class="content-d color-text-a">
                    Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                  </p>
                  <div class="info-agents color-a">
                    <p>
                      <strong>Phone: </strong> +54 356 945234
                    </p>
                    <p>
                      <strong>Email: </strong> agents@example.com
                    </p>
                  </div>
                </div>
                <div class="card-footer-d">
                  <div class="socials-footer d-flex justify-content-center">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-dribbble" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-d">
              <div class="card-img-d">
                <img src="landing/assets/img/agent-1.jpg" alt="" class="img-d img-fluid">
              </div>
              <div class="card-overlay card-overlay-hover">
                <div class="card-header-d">
                  <div class="card-title-d align-self-center">
                    <h3 class="title-d">
                      <a href="agent-single.html" class="link-two">Stiven Spilver
                        <br> Darw</a>
                    </h3>
                  </div>
                </div>
                <div class="card-body-d">
                  <p class="content-d color-text-a">
                    Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                  </p>
                  <div class="info-agents color-a">
                    <p>
                      <strong>Phone: </strong> +54 356 945234
                    </p>
                    <p>
                      <strong>Email: </strong> agents@example.com
                    </p>
                  </div>
                </div>
                <div class="card-footer-d">
                  <div class="socials-footer d-flex justify-content-center">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-dribbble" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-box-d">
              <div class="card-img-d">
                <img src="landing/assets/img/agent-5.jpg" alt="" class="img-d img-fluid">
              </div>
              <div class="card-overlay card-overlay-hover">
                <div class="card-header-d">
                  <div class="card-title-d align-self-center">
                    <h3 class="title-d">
                      <a href="agent-single.html" class="link-two">Emma Toledo
                        <br> Cascada</a>
                    </h3>
                  </div>
                </div>
                <div class="card-body-d">
                  <p class="content-d color-text-a">
                    Sed porttitor lectus nibh, Cras ultricies ligula sed magna dictum porta two.
                  </p>
                  <div class="info-agents color-a">
                    <p>
                      <strong>Phone: </strong> +54 356 945234
                    </p>
                    <p>
                      <strong>Email: </strong> agents@example.com
                    </p>
                  </div>
                </div>
                <div class="card-footer-d">
                  <div class="socials-footer d-flex justify-content-center">
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                        </a>
                      </li>
                      <li class="list-inline-item">
                        <a href="#" class="link-one">
                          <i class="fa fa-dribbble" aria-hidden="true"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!-- End Agents Section -->

    <!-- ======= Latest News Section ======= -->
    <!--<section class="section-news section-t8">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Latest News</h2>
              </div>
              <div class="title-link">
                <a href="#">All News
                  <span class="ion-ios-arrow-forward"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div id="new-carousel" class="owl-carousel owl-theme">
          <div class="carousel-item-c">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="landing/assets/img/post-2.jpg" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="#" class="category-b">House</a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">House is comming
                        <br> new</a>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b">18 Sep. 2017</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item-c">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="landing/assets/img/post-5.jpg" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="#" class="category-b">Travel</a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">Travel is comming
                        <br> new</a>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b">18 Sep. 2017</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item-c">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="landing/assets/img/post-7.jpg" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="#" class="category-b">Park</a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="blog-single.html">Park is comming
                        <br> new</a>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b">18 Sep. 2017</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item-c">
            <div class="card-box-b card-shadow news-box">
              <div class="img-box-b">
                <img src="landing/assets/img/post-3.jpg" alt="" class="img-b img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-header-b">
                  <div class="card-category-b">
                    <a href="#" class="category-b">Travel</a>
                  </div>
                  <div class="card-title-b">
                    <h2 class="title-2">
                      <a href="#">Travel is comming
                        <br> new</a>
                    </h2>
                  </div>
                  <div class="card-date">
                    <span class="date-b">18 Sep. 2017</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!-- End Latest News Section -->

    <!-- ======= Testimonials Section ======= -->
    <!--<section class="section-testimonials section-t8 nav-arrow-a">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Testimonials</h2>
              </div>
            </div>
          </div>
        </div>
        <div id="testimonial-carousel" class="owl-carousel owl-arrow">
          <div class="carousel-item-a">
            <div class="testimonials-box">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="testimonial-img">
                    <img src="landing/assets/img/testimonial-1.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="testimonial-ico">
                    <span class="ion-ios-quote"></span>
                  </div>
                  <div class="testimonials-content">
                    <p class="testimonial-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cupiditate ea nam praesentium
                      debitis hic ber quibusdam
                      voluptatibus officia expedita corpori.
                    </p>
                  </div>
                  <div class="testimonial-author-box">
                    <img src="landing/assets/img/mini-testimonial-1.jpg" alt="" class="testimonial-avatar">
                    <h5 class="testimonial-author">Albert & Erika</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item-a">
            <div class="testimonials-box">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="testimonial-img">
                    <img src="landing/assets/img/testimonial-2.jpg" alt="" class="img-fluid">
                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="testimonial-ico">
                    <span class="ion-ios-quote"></span>
                  </div>
                  <div class="testimonials-content">
                    <p class="testimonial-text">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, cupiditate ea nam praesentium
                      debitis hic ber quibusdam
                      voluptatibus officia expedita corpori.
                    </p>
                  </div>
                  <div class="testimonial-author-box">
                    <img src="landing/assets/img/mini-testimonial-2.jpg" alt="" class="testimonial-avatar">
                    <h5 class="testimonial-author">Pablo & Emma</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!-- End Testimonials Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <section class="section-footer">
    @include('/landing/partials.footer')
   </section> 


</body>

</html>