<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
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

    </style>

</head> 

<body class="body">

<div align="center"><a href="https://www.agronielsen.com/encampo"><img src="https://www.agronielsen.com/encampo/public/imagenes/logo-agronielsen-presentacion.png" style="height: auto; width: auto; max-width: 154px; max-height: 98px;"></a></div>

<hr>

<div align="center" style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 15px;" class="padding-copy"><h2>Nuevo Reporte de Visita en Campo</h2></div>

<div align="center" style="background: #eee;
    line-height: 6px;
    padding: 20px 20px 20px 20px;border-radius: 4px 4px 4px 4px;width: 90%;margin: auto;">
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
                <th align="center"scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Valorización</th>
                <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Unidad Medida</th>            
            </tr>
        </thead>
<?php 
   foreach($recomendaciones as $recomendacion){  ?>
   	 <tr role="row" class="odd"  >
 			<td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;"><?=$recomendacion->producto->producto; ?></td>
 			<td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;"><?=$recomendacion->cantidad; ?></td>
            <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">$<?=number_format($recomendacion->precio, 0, ',', '.');?></td>
 			<td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;"><?=$recomendacion->um; ?></td>
     </tr>
<?php } ?>

<h2>um:Unidad de medidad (cc/gr)</h2>

</table>



 
 
<br/>
<hr>
<br/>
<div align="center">Este informe ha sido enviado automaticamente por el sistema.</div>
<br/>
<div align="center"><a href="https://www.agronielsen.com/encampo/public/reportevisitastecnicas">Verifica tus Visitas Tecnicas (Clic Aquí)</a></div>
	
</body>
</html>