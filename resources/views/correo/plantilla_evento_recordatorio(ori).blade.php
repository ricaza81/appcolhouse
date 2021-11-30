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
<div class=".div_contenido" ><h2>Listado de Eventos</h2></div>

<div class="label label-warning">¡Buen d&iacute;a <b><?=$nombres;?> (<?=$email;?>)</b>!</div>
<br>
<div class="label label-warning">A continuaci&oacute;n encontrar&aacute; el detalle de los eventos pendientes para el día de hoy.</div>
<br>
<br>


<div class=".div_contenido" >

    <table border="1">
        <tr>
            <th>Estado</th>
            <th>Inicio</th>
            <th>Finalizaci&oacute;n</th>
            <th>Nombre</th>
            <th>Titulo</th>
            <th>Descripci&oacute;n</th>
        </tr>

        <?php
            foreach ($eventos as $evento){
        ?>
            <tr>
                <td>{{ $evento->status->nombre_status }}</td>
                <td>{{ $evento->start }}</td>
                <td>{{ $evento->end }}</td>
                <td>{{ $evento->name }}</td>
                <td>{{ $evento->title }}</td>
                <td>{{ $evento->description }}</td>
            </tr>        
        <?php
            }
        ?>

    </table>

</div>

<br/>
<hr>
<div class=".div_contenido" ><br/><b>http://www.aplicatics.co/empresas</b></div>
    
</body>
</html>