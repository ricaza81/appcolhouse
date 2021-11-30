<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="css/sistemalaravel.css">

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

<div class="titulo" ><a href="http://www.cosmoagro.com.co/mkt"><img src="../public/imagenes/logo-cosmoagro-web.png" style="height: auto; width: auto; max-width: 300px; max-height: 300px;"></a>

<hr>
<div class=".div_contenido" ><h2>Te han asignado un LEAD</h2></div>
<div class="label label-warning"><b>Usuario: <?= $email_usuario;?></b></div>
<div class="label label-warning"><b>Prospecto: <?= $nombre_prospecto;?></b></div>
<br/>
<hr>
<div class=".div_contenido" >Verifica tus LEADS asignados <a href="https://www.cosmoagro.com/sdc">Aquí</a></div>
	
</body>
</html>