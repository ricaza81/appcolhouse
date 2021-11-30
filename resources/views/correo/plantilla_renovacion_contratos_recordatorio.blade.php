<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="https://www.agronielsen.com/encampo/public/css/sistemalaravel.css">

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
   
   .bg-aqua, .callout.callout-info, .alert-info, .label-info, .modal-info .modal-body {
    background-color: #00c0ef !important;
}

   </style>

</head> 

<body class="body">
<hr>

 <img src="https://www.colhouse.com.co/crm/public/css/imagenes/logo-colhouse.png" alt="ColHouse" width="270"  style="border:0; margin:0; padding:0; display:block;" editable label="image-1">

<div class="label label-warning"></b></div>
<br>
<div class="label label-warning">Por favor verifique los siguientes canones de arrendamiento.</div>
<br>
<br>

<div align="center" style="background: #eee; color:#000;
    line-height: 6px;
    padding: 20px 20px 20px 20px;border-radius: 8px 8px 8px 8px;width: 90%;margin: auto;"><h2>Inquilinos próximos para actualización de canones de arrendamiento:</h2></div>

    <table align="center"
    style="margin-top: 20px;
    padding: 20px 20px 20px 20px;
    border: 2px solid #fff;
    vertical-align: baseline;
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #eee;
    color: #000;
    border-radius: 8px 8px 8px 8px;
    margin-bottom: 20px;"
    width="80%">
    <thead>
        <tr>
             <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Inquilino</th>
            <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Inicio Contrato</th>
            <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Duración contrato (meses)</th>
            <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Actualizar</th>

        </tr>

        <?php
            foreach ($usuarios as $usuario){ ?>
            @if ($usuario->fecha_inicio_contrato->diffInDays(now())>355)
            <tr role="row" class="odd"  >

                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{ $usuario->name }}<br/>Cédula: {{$usuario->cedula}}</td>
                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{date('d/F/Y', strtotime($usuario->fecha_inicio_contrato)) }}</td>
                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{$usuario->duracion_meses}}<br/>
                     Tiempo transcurrido: {{ $usuario->fecha_inicio_contrato->diffInDays(now()) }} días
                </td>
                 <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">
                  
                   <a href="{{url('https://www.colhouse.com.co/crm/public/admin/properties_sub/'.$usuario->subproperty->id)}}">Actualizar canon de arrendamiento</a>
                 </td>

            </tr>
  </thead>
  @endif
        <?php
            }
        ?>

    </table>

</div>

<br/>
<hr>
<div class=".div_contenido" ><br/><b>https://www.colhouse.com.co</b></div>
    
</body>
</html>