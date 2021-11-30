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

    </style>

</head> 

<body class="body">


<hr>

<div align="center" style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 15px;" class="padding-copy"><h2>Nuevo Reporte de Visita en Campo</h2></div>

<div align="center" style="background: #4267b2; color:#fff;
    line-height: 6px;
    padding: 20px 20px 20px 20px;border-radius: 8px 8px 8px 8px;width: 90%;margin: auto;">


<?php  if ($empresa->imglogo==NULL) {   ?>
                          
       <div class="titulo" ><a href="https://www.agronielsen.com/encampo"><img src="https://www.agronielsen.com/encampo/public/imagenes/logo-agronielsen-presentacion.png" style="height: auto; width: auto; max-width: 154px; max-height: 98px;padding:15px;background:#fff"></a>
</div>

                    <?php } else {   ?>      
                         
            <a href="https://www.agronielsen.com/encampo"><img style="width: 115px;
    height: auto;
    float: left;
    padding:10px;" src="<?php echo $message->embed($empresa->imglogo);?>"></a>

                         
<?php } ?>


<h3>Visita Realizada por: <?=$nombre_asesor?></h3>
<h3>Agricultor: <?=$nombre_agricultor?></h3>
<h3>Finca: <?=$nombre_finca?></h3>
<h3>Cultivo: <?=$cultivo_finca?></h3>
<h3>Número Ha recomendadas: <?=$numero_hectareas?></h3>
<h3>Fecha Visita: <?=$fecha_visita?></h3>

</div>


<div align="center" style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 20px;" class="padding-copy"><h2>Productos recomendados:</h2></div>

    <table align="center"
    style="margin-top: 20px;
    padding: 20px 20px 20px 20px;
    border: 2px solid #fff;
    vertical-align: baseline;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
    border-radius: 8px 8px 8px 8px;
    margin-bottom: 20px;"
    width="50%">
        <thead>
            <tr>               
                <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Producto</th>
                <th align="center"scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Dosis(um)/Ha</th>
                
            <?php  if ($destinatario!="") {   ?>
            
          
            
            <?php } else {   ?>    
           <th align="center"scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Valorización</th>               
            <?php } ?>    
                <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Unidad Medida</th>            
            </tr>
        </thead>
<?php 
   foreach($recomendaciones as $recomendacion){  ?>
     <tr role="row" class="odd"  >
            <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;"><?=$recomendacion->producto->producto; ?></td>
            <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;"><?=$recomendacion->cantidad; ?></td>
            
                        <?php  if ($destinatario!="") {   ?>
            
       
            
            <?php } else {   ?>    
             <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">$<?=number_format($recomendacion->precio, 0, ',', '.');?></td>               
            <?php } ?>  
            
          
            <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;"><?=$recomendacion->um; ?></td>
     </tr>
<?php } ?>
<div align="center">um:Unidad de medidad (cc/gr)</div>

</table>


<h3 class="timeline-header"><a href="#">Fotos de la Asistencia Técnica</h3>


<div class="timeline-body">
                  <img src="<?php echo $message->embed($visita->imagen1);?>" alt="Foto 1" class="margin">
                  <img src="<?php echo $message->embed($visita->imagen2);?>" alt="Foto 2" class="margin">

                </div>

 
 
<br/>
<hr>
Eres Agricultor y tienes un producto agrícola para vender directo en Colombia?
<a href="https://www.directodefinca.com" target="_blank">
<img src="https://www.agronielsen.com/encampo/public/imagenes/publicidad-reportes-email.jpg" class="margin" style="width:750px;height:auto">
</a>
<br/>
<div align="center">Este informe ha sido enviado automáticamente por el sistema. Agronielsen Gestión en Campo</div>
<br/>
<div align="center"><a href="https://www.agronielsen.com/encampo/public/reportevisitastecnicas">Verifica tus Visitas Tecnicas (Clic Aquí)</a></div>
    
</body>
</html>