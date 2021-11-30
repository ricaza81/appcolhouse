<!DOCTYPE html>
<html lang="es">

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Colhouse | Tu Casa está aquí</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{url('landing/assets/img/favicon.png')}}')}}" rel="icon">
  <link href="{{url('landing/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!--DataTable-->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css"/>
   <!--DataTable-->

  <!-- Vendor CSS Files -->
  
  <link href="{{url('landing/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('landing/assets/vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{url('landing/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{url('landing/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{url('landing/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

   <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-grid.css')}}">
  <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/css/main.css')}}">
  <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/css/fonts.min.css')}}">

  <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-grid.css')}}">

 <!-- <link rel="stylesheet"
      href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet"
      href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>-->
<link rel="stylesheet"
      href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
<!--<link rel="stylesheet"
      href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>-->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css"/>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0N21RP8DQ7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0N21RP8DQ7');
</script>

  

  <!-- Bootstrap + Olympus CSS -->
  <!--<link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-reboot.css')}}">-->
 

  <!-- Template Main CSS File -->
  <link href="{{url('landing/assets/css/style.css')}}" rel="stylesheet">

  <link rel="stylesheet"
      href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet"
      href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>

  <!-- =======================================================
  * Template Name: EstateAgency - v2.2.1
  * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

 

  <!-- ======= Property Search Section ======= -->
  <div class="click-closed"></div>
  <!--/ Form Search Star /-->
  <div class="box-collapse">
    <div class="title-box-d">
      <h3 class="title-d">Buscar propiedad</h3>
    </div>
    <span class="close-box-collapse right-boxed ion-ios-close"></span>
    {!! Form::open(['method' => 'POST', 'route' => ['landing.busqueda']]) !!}
    <div class="box-collapse-wrap form">
     <form class="form-a">
        <div class="row">
          <div class="col-md-12 mb-2">
            <div class="form-group">
              <label for="Type">Palabra clave</label>
              <input type="text" class="form-control form-control-lg form-control-a" placeholder="Palabra clave">
            </div>
          </div>
          <div class="col-md-6 mb-2">
           {!! Form::label('tipo', trans('global.properties.fields.tipo').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_tipo_sub', $tipos, old('id_tipo_sub'), ['class' => 'form-control', 'placeholder' => 'Tipo', '' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('id_tipo_sub'))
                        <p class="help-block">
                            {{ $errors->first('id_tipo_sub') }}
                        </p>
                    @endif
          </div>
          <div class="col-md-6 mb-2">
            {!! Form::label('ciudad', trans('global.ciudades.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('id_ciudad', $ciudades, old('id_ciudad'), ['class' => 'form-control', 'placeholder' => 'Ciudad', '' => '']) !!}
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
  </div><!-- End Property Search Section -->>

  <!-- ======= Header/Navbar ======= -->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <!--<a class="navbar-brand text-brand" href="index.html">ColHouse<span class="color-b"></span></a>-->
      <a href="{{ route('landing.index') }}" class="main-logo"><img src="{{asset('/css/imagenes/logo-colhouse.png')}}" alt="Colhouse" style="width: 215px;padding-left: 25px;" /></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route('landing.index') }}">Inicio</a>
          </li>
         <!-- <li class="nav-item">
            <a class="nav-link" href="">Nosotros</a>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('landing.index') }}">Propiedades</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link" href="blog-grid.html">Blog</a>
          </li>-->
        <!--  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pages
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="property-single.html">Property Single</a>
              <a class="dropdown-item" href="blog-single.html">Blog Single</a>
              <a class="dropdown-item" href="agents-grid.html">Agents Grid</a>
              <a class="dropdown-item" href="agent-single.html">Agent Single</a>
            </div>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" href="{{ route('landing.contacto2') }}">Contacto</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{ route('auth.login') }}">Zona Clientes</a>
          </li>
            <li class="nav-item">
          
                      <a href="{{ route('landing.publicar') }}"><span class="price-a" style="background:#2eca6a;">Publica tu inmueble</span>
                      </a>
          
             </li>
        </ul>
      </div>
      <button type="button" class="btn btn-b-n navbar-toggle-box-collapse d-none d-md-block" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
    </div>
  </nav><!-- End Header/Navbar -->

