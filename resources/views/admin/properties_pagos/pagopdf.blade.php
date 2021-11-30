
<meta charset="utf-8">

<title>
    {{ trans('global.global_title') }}
</title>

<meta http-equiv="X-UA-Compatible"
      content="IE=edge">
<meta content="width=device-width, initial-scale=1.0"
      name="viewport"/>
<meta http-equiv="Content-type"
      content="text/html; charset=utf-8">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Global site tag (gtag.js) - Google Analytics -->
  <!-- <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/css/main.css')}}">
     <link rel="stylesheet" rel="stylesheet" href="{{ url('olympus/app/css/fonts.min.css')}}">-->
       

<!--AdminLTE-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<link href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ url('olympus/app/css/main.css')}}">
<link href="{{ url('olympus/app/css/fonts.min.css')}}">
<link href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}">
<link href="{{ url('adminlte/css') }}/select2.min.css"/>
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<link href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
<link href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
<link href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
<!-- Bootstrap CSS -->
<link  href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-reboot.css')}}">
<link href="{{ url('olympus/app/Bootstrap/dist/css/bootstrap-grid.css')}}">
<link href="{{ url('olympus/app/css/main.css')}}">
<link href="{{ url('olympus/app/css/fonts.min.css')}}">
<link href="{{ url('adminlte/css/skins/skin-blue.min.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
<link href="{{ url('adminlte/css/custom.css') }}" rel="stylesheet">

<style>
.m-status {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    padding: 7px 12px;
    font-weight: 600;
    font-size: 18px;
    line-height: 1;
    font-family: proxima-nova,Avenir,sans-serif;
    text-align: center;
    color: #fff;
    text-transform: capitalize;
    font-style: normal;
    letter-spacing: 0;
    white-space: nowrap;
    border-radius: 100px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    color: #b44d12;
    background: #fff3c4;
}

.m-status-2 {
    font-weight: 600;
    font-size: 18px;
    background: #000;
    color: #fff;
    border-radius: 100px;
}
</style>

<a href="" class="main-logo"> <img src="{{url('css/imagenes/logo-colhouse.png')}}" alt="ColHouse" width="215"  style="border:0; margin:0; padding:0; display:block;" editable label="image-1"></a>

    <h3 class="page-title" style="margin-top:-20px">Detalles de la Transacción # COL-PAGO-{{$factura->pago_valor->id}}</h3>
    <h4 class="page-title" style="margin-top:-20px">Factura pagada: # COL-FT-{{$factura->id}}</h4>

    <div class="panel panel-default">
        <div class="inner">
            <div class="panel-body table-responsive">
                <div class="row">
                    <div style="float:left;font-size:14px;width:200px">
                        <div class="title">Propiedad</div><br/>
                        <span>{{$factura->property_sub->nombre}}</span><br/>
                        <span>{{$factura->property->address}}</span><br/>
                        <span style="font-size:12px;margin-top:20px">Factura desde:</span>
                        <br/>
                        <span>
                         {{date('d/F/Y',strtotime($factura->fecha_inicio))}}
                        </span>
                        <br/>
                        <span style="font-size:12px">
                            Fecha con corte
                        </span>
                        <br/>
                        <span>
                            {{date('d/F/Y',strtotime($factura->fecha_corte))}}
                        </span>
                        <br/>
                        <div></div><br/>
                        <div class="title">{{$factura->tenant->name}}</div>
                        <div class="title">CC {{$factura->tenant->cedula}}</div>
                        <br/>
                         <div class="title">
                            Fecha inicio contrato:<br/>
                             {{date('d/F/Y',strtotime($factura->tenant->fecha_inicio_contrato))}}
                        </div>
                         <!--<div class="title">
                            Contrato Hasta:<br/>
                             {{date('d/F/Y',strtotime($factura->tenant->fecha_fin_contrato))}}
                        </div>-->
                         <div class="title">
                            Duración del contrato:<br/>
                             {{$factura->tenant->duracion_contrato}}
                        </div><br/>
                          <div class="title">Fecha Límite para evitar la renovación automática:<br/>
                           @if ($factura->tenant->fecha_fin_contrato != NULL)
                           {{date('d/F/Y',strtotime($fecha_limite_renovacion))}}
                           @else
                           Por favor verificar la fecha de finalización de este contrato.
                           @endif
                            </div>
                           <br/>
                    </div>
                     <div style="margin-left:250px;width:400px;font-size:14px">
                        <table>
                            <thead>
                                <tr>
                                   <th align="center" scope="col" style="width:40px;padding:5px;border-bottom:3px solid #fff">Vlr. Factura
                                   </th>
                                    <th align="center" scope="col" style="width:20px;padding:5px;border-bottom:3px solid #fff">
                                    Vlr. Pagado
                                    </th>
                                    <th align="center" scope="col" style="width:20px;padding:5px;border-bottom:3px solid #fff">
                                    Saldo
                                    </th>
                                </tr>
                            </thead>

                            <tr>
                                    <td align="center" align="center" style="width:40px;padding:20px 20px 20px 20px;">
                                    ${{number_format($factura->valor_neto), 0, ',', '.'}}
                                    </td>
                                    <td align="center">
                                    ${{number_format($factura->pago2($factura->id)), 0, ',', '.'}}
                                    </td>
                                    <td align="center">
                                    ${{number_format($factura->valor_neto - $factura->pago3($factura->id)), 0, ',', '.'}}
                                    </td>
                            </tr>
                        </table>
                        <hr>
                        
                        <!--fechapago-->
                        @if ($factura->pago2($factura->id) > 0)
                        <div class="title" style="width:400px;float:left;">
                            Fecha del pago:
                             {{date('d/F/Y',strtotime($factura->pago_informe($factura->id)->fecha_pago))}}
                        </div>
                        @endif
                        <br/>
                        <!--fechapago-->

                        <!--fechainiciocontrato-->
                       <!--  <div class="title" style="width:200px;float:right">
                            Fecha inicio contrato:<br/>
                             {{date('d/F/Y',strtotime($factura->tenant->fecha_inicio_contrato))}}
                        </div>-->
                         <!--fechainiciocontrato-->


                @if ($factura->adicionales || $factura->adicionales > 0)
                 <div style="margin-left:-40px;width:400px;font-size:14px">
                       <h5 style="margin-left:-40px">Gastos Adicionales: ${{number_format($factura->adicionales)}}<br/>
                        Detalles: {{$factura->obs_adicionales}}
                        </h5>
                       <h5 style="margin-left:200px">Deducciones:${{number_format($factura->deducciones)}}
                        <br/>
                        Detalles: {{$factura->obs_adicionales}}
                        </h5>
                </div>
                @endif
                <hr>
                    <div class="title" style="width:200px;float:right;">
                         <h5 style="margin-left:-200px">
                            Por favor tener en cuenta: siempre recomendamos a nuestros clientes, si no realizará renovación del contrato, por favor comunicarnos con 3 meses de anticipación antes de la finalización del contrato, recuerda que tu contrato es por {{$factura->tenant->duracion_contrato}} iniciando el día {{date('d/F/Y',strtotime($factura->tenant->fecha_inicio_contrato))}}<br/>
                       </h5>
                        <h4 style="margin-left:-200px">
                           <h5>Fecha Límite para no renovación:</h5>
                           @if ($factura->tenant->fecha_fin_contrato != NULL)
                           {{date('d/F/Y',strtotime($fecha_limite_renovacion))}}
                           @else
                           Por favor verificar la fecha de finalización de este contrato.
                           @endif
                           <br/>
                       </h4>
                       
                </div>
                    </div>
            </div>
        </div>
    </div>