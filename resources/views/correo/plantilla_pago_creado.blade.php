<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://www.agronielsen.com/encampo/public/css/sistemalaravel.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>

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

<div class="titulo" ><a href="https://www.colhouse.com.co"><img src="https://www.colhouse.com.co/css/imagenes/logo-colhouse.png" style="height: auto; width: auto; max-width: 154px; max-height: 98px;"></a>
</div>
<hr>

<div class="" ><h2>Nueva Pago</h2></div>

<div class="div_contenido" ><h3># Factura: COL-FT-<?=$id_factura;?></h3>
<div class="" ><h3>Valor del pago: $<?=number_format($valor);?></h3></div>

</div>

<a href="#" data-toggle="tooltip" title="Ver Detalles">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Ver Detalles
                    </span>
                </a>


Este informe ha sido enviado automaticamente por el sistema.

 
 
<br/>
<hr>
</body>
</html>