<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="css/sistemalaravel.css">

<head>
    <meta charset="UTF-8">
    <title>Notificaci&oacute;n de Eventos</title>
   <style>

   .titulo {
    color: #1e80b6;
    padding-top: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    }

    .body{
     background-color: #fff;    
    }


    .div_contenido{
    color: #1e80b6;
    padding-top: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
    padding-right: 20px;
    background-color: #ffffff !important;
   }

   </style>

</head> 

<body class="body">
<hr>

<div class="label label-warning">¡Buen d&iacute;a <b><?=$nombres;?> (<?=$email;?>)</b>!</div>
<br>
<div class="label label-warning">A continuaci&oacute;n encontrar&aacute; un resumen de tu gestión en campo.</div>
<br>
<br>

<div align="center" style="background: #4267b2; color:#fff;
    line-height: 6px;
    padding: 20px 20px 20px 20px;border-radius: 8px 8px 8px 8px;width: 90%;margin: auto;"><h2>Resultados Gestión en Campo:</h2></div>

<div class="small-box bg-aqua">
            <div class="inner">

         <?php

               $subtotal_valorizacion=0;
  
            foreach ($visitas as $visita){
                          $subtotal_valorizacion+=$visita->suma_valorizacion_visita($visita->id); 
                           ?>
                           <?php } ?>
                      <h4>$<?php echo number_format($subtotal_valorizacion, 0, ',', '.'); ?></h4>

              <p>Valorización Total</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="{{asset('reporteproductos')}}" class="small-box-footer">
              Más Info<i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
                    <div class="inner">


<br/>
<hr>
<div class=".div_contenido" ><br/><b>https://www.agronielsen.com/encampo</b></div>
    
</body>
</html>