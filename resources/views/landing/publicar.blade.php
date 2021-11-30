<!DOCTYPE html>
<html lang="es">

<head>
    @include('landing/partials.header')
</head>





    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 section-t4" style="padding:10px">
            <div class="title-single-box">
              <h1 class="title-single" style="padding-top:30px">Aquí puedes ingresar tu inmueble para arrendar</h1>
              <span class="color-text-a">Permítenos contactarte. Por favor registra los siguientes datos</span>
            </div>
          </div>

           <div class="col-sm-8 section-t8" style="padding:10px">
            <div class="title-single-box">
             @include('landing/partials/forms.form_publicar')
            </div>
          </div>
        </div>
      </div>




          <!--<div class="col-md-12 col-lg-4">
            <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('landing.index')}}">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                  Contacto
                </li>
              </ol>
            </nav>
          </div>-->
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