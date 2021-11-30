@extends('layouts.auth')
   <link rel="stylesheet" href="{{url('plugins/iCheck/square/blue.css')}}">
   <link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{url('css/pe-icon-7-stroke.css')}}">
   <link rel="stylesheet" href="{{url('css/material/css/ionicons.min.css')}}">
   <link rel="stylesheet" href="{{url('css/material/css/simple-line-icons.css')}}" type="text/css">
    <!-- Theme style -->
   <link rel="stylesheet" href="{{url('dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
   <link rel="stylesheet" href="{{url('plugins/iCheck/square/blue.css')}}">
   <link rel="stylesheet" href="{{url('css/sistemalaravel.css')}}">
   <link href="{{url('css/main.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="{{url('css/material/style.css')}}">
   <link rel="stylesheet" href="{{url('css/appx/dependencies/font-awesome/css/font-awesome.min.css')}}" type="text/css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="{{url('css/pe-icon-7-stroke.css')}}">
   <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>  
   <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default text-left" style="border-color:#fff;margin-top: 0px;">
                 <a href="{{ route('landing.index') }}" class="main-logo"><img src="{{asset('/css/imagenes/logo-colhouse.png')}}" alt="Colhouse" style="width: 215px;padding-left: 25px;" /></a>
                <div class="panel-heading text-left" style="font-size:25px;font-weight:600;color:#f7ad00;background: #fff;border-bottom: 2px solid #f7ad00">Sistema ColHouse | Administración
                     <div class="panel-heading text-right" style="font-size:17px;font-weight:600;color:#000;background: #fff;border-bottom: 0px solid #f7ad00">Sistema de Información
                     <p>Administramos todo el negocio de arrendamientos de inmuebles</p>
                </div>
                </div>
                
               
                <div class="panel-body">
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>@lang('global.app_whoops')</strong> @lang('global.app_there_were_problems_with_input'):
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label" style="font-size:18px;">@lang('global.app_email')</label>

                            <div class="col-md-6">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" style="font-size:18px;">@lang('global.app_password')></label>

                           <div class="col-md-6">
                                <input type="password"
                                       class="form-control"
                                       name="password">
                            </div>
                          
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 text-left">
                              <!--  <a href="{{ route('auth.password.reset') }}">@lang('global.app_forgot_password')</a>
                                <br>
                                <a href="{{ route('auth.register') }}">@lang('global.app_registration')</a>-->
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 text-left">
                                <div class="d-flex no-block align-items-center">
                                      <div class="checkbox checkbox-primary p-t-0">
                                <label >
                                    
                                     <input id="checkbox-signup" type="checkbox" name="remember">
                                        <label for="checkbox-signup" style="padding-left:20px"> Recordarme </label>
                                </label>
                            </div>
                           </div> 
                            </div>
                        </div>

                     
                            <div class="row">
                            <div class="col-md-3 col-md-offset-3">
                                <button type="submit"
                                        class="btn btn-success btn-lg btn-block"
                                        >
                                    @lang('global.app_login')
                                </button>
                            </div>
                             <div class="col-md-3">
                                <a href="mailto:ricaza81@gmail.com"
                                 class="btn btn-primary btn-lg btn-block"
                                        >
                                    Solicitar Demo
                                </a>
                            </div>
                        </div>
                   <div class="credits" style="float:right;">
            <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=EstateAgency
          -->
            Diseñado por <a target="_blank" href="https://ricardozambrano.co/">ricardozambrano.co</a> | <a target="_blank" href="https://github.com/ricaza81">GitHub</a> | <a target="_blank" href="https://mktmedia.co">Agencia</a>
          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

   <!-- Start of  Zendesk Widget script -->
<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=c5c1215c-ecf8-44af-b71c-210ea7a83f5a"> </script>
<!-- End of  Zendesk Widget script -->
<script src="{{url('plugins/jQuery/jquery.min.js')}}"></script>
<script src="{{url('js/jquery-3.2.1.slim.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{url('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{url('plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{url('plugins/fastclick/fastclick.js')}}"></script>
<script src="{{url('js/owl.carousel.min.js')}}"></script>
<script src="{{url('js/jquery.onepagenav.js')}}"></script>
<script src="{{url('js/typewriter.js')}}" type="text/javascript"></script>
<script src="{{url('js/typed.js')}}" type="text/javascript"></script>
<script src="{{url('js/main.js')}}" type="text/javascript"></script>
<script src="{{url('js/sistemalaravel.js')}}" type="text/javascript"></script>

<style>
.page-header-fixed
{
margin-top: -3%;
}
</style>