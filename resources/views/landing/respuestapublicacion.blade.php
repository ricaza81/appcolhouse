<!DOCTYPE html>
<html lang="es">

<head>
    @include('/landing/partials.header')
</head>





    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">

        <div class="row">
         
                <span class="color-text-a">Tu inmueble ha sido publicado</span>
                <a href="#contacto">
                  <span class="m-status" style="margin-top:-2px;margin-left: 3px">
                     Pronto te enviaremos un mensaje de notificación
                  </span>
                </a>
            
        </div>

        <div class="row">
          <div class="col-sm-6 section-t8" style="padding:10px">
            <div class="title-single-box"><br/>
               <!-- <span class="color-text-a">¿Estás interesado en esta Propiedad?</h1> Te contactarte. Por favor registra los siguientes datos</span>-->

              <h1 class="title-single" style="margin-top:-19px">{{$unidad->nombre}}</h1>

             <table class="table table-bordered table-striped">
                       
                        <tr>
                            <th>@lang('global.properties_sub.fields.nombre')</th>
                            <td field-key='name'>{{ $unidad->nombre }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.properties_sub.fields.tipo_sub')</th>
                            <td field-key='tipo_sub'>{{ $unidad->tipo_propiedad_sub->tipo }}</td>
                        </tr>
                         <tr>
                            <th>@lang('global.properties_sub.fields.renta')</th>
                            <td field-key='renta'>$ {{ number_format($unidad->renta), 0, ',', '.'}}</td>
                        </tr>
                         <tr>
                            <th>@lang('global.properties.fields.address')</th>
                            <td field-key='direccion'>{{$unidad->address}}</td>
                        </tr>
                        <tr>
                         <th>@lang('global.properties_sub.fields.metros_cuadrados')</th>
                            <td field-key='metros_cuadrados'>{{ $unidad->metros_cuadrados }}</td>
                        </tr>
                         <tr>
                         <th>@lang('global.properties_sub.fields.numero_banos')</th>
                            <td field-key='numero_banos'>{{ $unidad->numero_banos }}</td>
                        </tr>

                         <tr>
                         <th>@lang('global.properties_sub.fields.numero_cocinas')</th>
                            <td field-key='numero_banos'>{{ $unidad->numero_cocinas }}</td>
                        </tr>
                         <tr>
                         <th>Fecha de creación</th>
                            <td field-key='fecha_creacion'>{{date('d/F/Y',strtotime($unidad->created_at)) }}</td>
                        </tr>
                         <th>Observaciones de la Unidad</th>
                            <td field-key='observaciones'>{{$unidad->observaciones}}</td>
                        </tr>
                    </table>
            
            </div>
          </div>
          <div class="col-sm-4 section-t8" style="padding:10px">
            <!--<nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('landing.index')}}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Contacto
                </li>
              </ol>
            </nav>-->
            <!--  <div class="title-single-box">
                    <h1 class="title-single" style="padding-top:0px">{{$unidad->nombre}}</h1> {{$unidad->nombre}}
              </div>-->

           
              <div class="carousel-item-b" style="margin-bottom:31px;border-radius:7px;">
                      <div class="card-box-a card-shadow" style="border-radius:7px;">
                        <div class="img-box-a" style="background-size:contain;border-radius:7px;">
                          <a href="{{ asset(env('UPLOAD_PATH').'/' . $unidad->photo) }}" target="_blank">
                          <img src="{{ asset(env('UPLOAD_PATH').'/' . $unidad->photo) }}" alt="" class="img-a img-fluid" style="background-size:contain;width: 389px;
    height: 557px;border-radius:7px;"></a>
                        </div>
                        <div class="card-overlay">
                          <div class="card-overlay-a-content" style="margin-bottom:53px;">
                            <div class="card-header-a" style="margin-top:20px;">
                              <h2 class="card-title-a">
                                <a href="{{ asset(env('UPLOAD_PATH').'/' . $unidad->photo) }}" target="_blank">
                               
                                 
                                  <br /> {{$unidad->name}}</a>
                                  <br/>
                                  <h4 class="card-title-a" style="color:#fff;font-size:18px;line-height:20px">{{$unidad->address}}</h4>
                                
                                   <h4 class="card-title-a" style="color:#fff;font-size:18px;line-height:20px">{{$unidad->tipo_propiedad_sub->tipo}}</h4>
                              </h2>
                            </div>
                            <div class="card-body-a" style="margin-top:30px">
                              <div class="price-box d-flex" style="float: right;">
                                 <a href="{{ asset(env('UPLOAD_PATH').'/' . $unidad->photo) }}" class="link-a" target="_blank"><span class="price-a">Ver foto</span></a>
                              </div>
                              <!--<a href="{{route ('landing.contacto',[$unidad->id]) }}" class="link-a" target="_blank">Solicitar en línea
                                <span class="ion-ios-arrow-forward"></span>
                              </a>-->
                            </div>
                            <div class="card-footer-a" style="margin-top: 16px;background:#16a2de;">
                              <ul class="card-info d-flex justify-content-around">
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Area</h4>
                                  <span>{{$unidad->metros_cuadrados}}m
                                    <sup>2</sup>
                                  </span>
                                </li>
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Baños</h4>
                                  <span>{{$unidad->numero_banos}}</span>
                                </li>
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Cocina</h4>
                                  <span>{{$unidad->numero_cocinas}}</span>
                                </li>
                                <li>
                                  <h4 class="card-info-title" style="color:#fff">Parqueadero</h4>
                                    <span>{{$unidad->numero_parqueaderos}}</span>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                  </div>
              </div>


          </div>
        </div>
               
           
              <div class="col-md-5 section-md-t3">
                <div class="icon-box section-b2">
                  <div class="icon-box-icon">
                    <span class="ion-ios-paper-plane"></span>
                  </div>
                  <div class="icon-box-content table-cell">
                    <div class="icon-box-title">
                      <h4 class="icon-title">Contacto</h4>
                    </div>
                    <div class="icon-box-content">
                      <p class="mb-1">Email.
                        <span class="color-a">comercial@colhouse.com.co</span>
                      </p>
                      <p class="mb-1">Télefono.
                        <span class="color-a">+57 315 8739013</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="icon-box section-b2">
                  <div class="icon-box-icon">
                    <span class="ion-ios-pin"></span>
                  </div>
                  <div class="icon-box-content table-cell">
                    <div class="icon-box-title">
                      <h4 class="icon-title">Nuestra ubicación</h4>
                    </div>
                    <div class="icon-box-content">
                      <p class="mb-1">
                        Cali, Colombia
                        <br>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="icon-box">
                  <div class="icon-box-icon">
                    <span class="ion-ios-redo"></span>
                  </div>
                  <div class="icon-box-content table-cell">
                    <div class="icon-box-title">
                      <h4 class="icon-title">Social networks</h4>
                    </div>
                    <div class="icon-box-content">
                      <div class="socials-footer">
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
        </div>
    </section>
  <!-- ======= Contact Single ======= -->
    <!--<section class="contact">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-map box">
              <div id="map" class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
       
        </div>
      </div>
    </section>-->
    <!-- End Contact Single-->

  <!-- ======= Footer ======= -->
  <section class="section-footer">
    @include('/landing/partials.footer')
   </section> 




</html>