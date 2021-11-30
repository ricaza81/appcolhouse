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

<div class="titulo" ><a href="http://www.cosmoagro.com/sdc"><img src="{{url('/imagenes/logo-cosmoagro-web.png')}}" style="height: auto; width: auto; max-width: 300px; max-height: 300px;"></a>
</div>
<hr>

<div class=".div_contenido" ><h2>Te han asignado un LEAD</h2></div>
<div class="label label-warning"><b>RTC: <?= $email_usuario;?></b></div>
<div class="label label-warning"><b>Nombre: <?= $nombre_prospecto." ".$prospecto->apellidos;?></b></div>
<div class="label label-warning"><b>Cultivo: <?= $prospecto->cultivo->cultivo;?></b></div>
<div class="label label-warning"><b>Area(Ha): <?= $prospecto->numero_hectareas;?></b></div>
<div class="label label-warning"><b>Teléfono: <?= $prospecto->telefono;?></b></div>
<div class="label label-warning"><b>Email: <?= $prospecto->email;?></b></div>

<?php  if (count($prospecto->observaciones) > 0){   ?>

<div class="label label-warning"><b>Observaciones: <?= $prospecto->observaciones;?></b></div>

 <?php } ?>


<?php  if (count($seguimientos)>0){   ?>


<div><h3>Seguimientos Realizados</h3>


<div class="box box-primary">
<div class="box-body">              
 <table border="1">

      <thead>
            <tr>
               
                <th style="width:10px">Seguimiento</th>
                <th>Añadido el</th>
                <th>Añadido Por</th>

            </tr>
        </thead>


<?php


 foreach($seguimientos as $seguimiento){  ?>

 <tr role="row" class="odd"  >
        <td><?= $seguimiento->observacion ?></td>
        <td><?= $seguimiento->created_at ?></td>
        <td><?= $seguimiento->autor->nombres." ".$seguimiento->autor->apellidos ?></td>     

</tr>



<?php } ?>
<?php } ?>
       
</table>

<br/>
<hr>
<div class=".div_contenido" >Verifica tus LEADS asignados <a href="http://www.cosmoagro.com/sdc">Aquí</a></div>
	
</body>
</html>