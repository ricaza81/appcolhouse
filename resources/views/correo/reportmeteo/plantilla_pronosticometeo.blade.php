<!DOCTYPE html>
<html lang="es">
    

<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>correo</title>
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

       .img-circle {
    width: 115px;
    height: auto;
    float: left;
    padding:10px;
                }

    .bg-yellow2 {
    padding: 20px;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}

.callout {
    background-color: #4267b2 !important;
}

.timeline>li>.timeline-item {
    -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 3px;
    margin-top: 0;
    background: #fff;
    color: #444;
    margin-left: 60px;
    margin-right: 15px;
    padding: 0;
    position: relative;
}

.bg-purple {
    background-color: #605ca8 !important;
}

.margin {
    /* margin: 10px; */
    width: 30%;
}

.span {
    background: #fff;
    padding: 13px;
    margin-top: 25px;
    font-size: 16px;
    border-radius: 7px;
    color: #000;
}

h3{
padding-bottom: 10px;
}

    </style>

</head> 

<body class="body">


<hr>

<div class="Agronielsen" ><a href="https://www.agronielsen.com/encampo"><img src="https://www.agronielsen.com/encampo/public/css/appx/assets/img/agronielsen.png" style="height: auto; width: auto; max-width: 154px; max-height: 98px;"></a>
</div>

<div align="center" style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 15px;" class="padding-copy"><h2>Pronostico de variables meteorologicas</h2></div>

<div align="center" style="background: #4267b2; color:#fff;
    line-height: 6px;
    padding: 20px 20px 20px 20px;border-radius: 8px 8px 8px 8px;width: 90%;margin: auto;">




<h3>Fecha del pronostico: <?=$fecha?></h3>

</div>


<div align="center" style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 20px;" class="padding-copy"><h2>Datos:</h2></div>

    <table align="center"
    style="margin-top: 20px;
    padding: 13px;
    border: 0px solid #fff;
    vertical-align: baseline;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    /*background-color: #0166e5;*/
    background:linear-gradient(-205deg, rgb(24, 42, 161) 0%, rgb(22, 16, 77) 57%);
    color: white;
    border-radius: 8px 8px 8px 8px;
    margin-bottom: 20px;"
    width="50%">
        <thead>
            <tr>               
                <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff"><h3>Dia:</h3></th>
             
            </tr>
          
 <?php
            foreach ($dts as $dt){ ?>
            <tr role="row" class="odd"  >

                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{ $dt }}</td>
            

            </tr>
  </thead>       
        <?php
            }
        ?>

    </table>

  <div align="center">

    
   <a
                href="<?=$pronostico?>"
                target="_blank"
                class="read-btn1"
                style="padding: 22px;background: #3224af;
                    color: #fff;
                    font-size: 18px;
                    text-transform:none;
                    font-weight: 500;
                    border-radius: 5px;
                    display: inline-block;
                    border: 1px solid #3224af;
                    width:50%;
                     font-family: 'Google Sans';
                    text-decoration: none;
                    margin-top:8px;
                "
            >
                VER PRONOSTICO
            </a>
</div> 
 
<br/>
<hr>
Estás interesado(a) en monitorear tus cultivos fácilmente, sin usar instalaciones específicas, confiando en las últimas mediciones por medio de satelite y manteniendo todos los datos en un solo lugar, ahorrando tiempo y reduciendo costos.
<br/>
 <a
                 href="https://agronielsen.com/encampo/public/planclima"
                target="_blank"
                class="read-btn1"
                style="padding: 22px;background:#f46036;
                    color: #fff;
                    font-size: 18px;
                    text-transform:none;
                    font-weight: 500;
                    border-radius: 5px;
                    display: inline-block;
                    border: 1px solid #3224af;
                    width:25%;
                     font-family: 'Google Sans';
                    text-decoration: none;
                "
            >
                PROBAR AHORA
            </a>
<!--<a href="https://www.directodefinca.com" target="_blank">
<img src="https://www.agronielsen.com/encampo/public/imagenes/publicidad-reportes-email.jpg" class="margin" style="width:750px;height:auto">
</a>-->
<br/>
<div align="center">Este informe ha sido enviado automáticamente por el sistema. Agronielsen Gestión en Campo</div>
<br/>
<!--<div align="center"><a href="https://www.agronielsen.com/encampo/public/reportevisitastecnicas">Verifica tus Visitas Tecnicas (Clic Aquí)</a></div>-->
    
</body>
</html>