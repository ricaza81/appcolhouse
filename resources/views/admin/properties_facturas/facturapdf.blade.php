
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

  <a href="" class="main-logo"> <img src="{{url('css/imagenes/logo-colhouse.png')}}" alt="ColHouse" width="215"  style="float:left;border:0; margin:0; padding:0; display:block;" editable label="image-1"></a>
  <p style="float:right;font-size:12px;padding-top:40px">
      COLHOUSE INMOBILIARIA <br/>
      NIT.1107093875-5 <br/>
      <a href="mailto:comercial@colhouse.com.co">comercial@colhouse.com.co</a>
  </p>

    <h3 class="page-title" style="margin-top:120px">Factura No. 21754{{$factura->id}}</h3>
    <h6 class="page-title" style="margin-top:-12px;padding-bottom:3px;">Estado de la facturación:    @if($factura->pago2($factura->id) != NULL)
                    paga
                    @else
                     Esta factura aún no registra pago.
                    @endif
    </h6>
<hr>
<div class="row">
    <h3>Detalles del arrendamiento</h3>
    <div class="col-md-4" style="float:left">      
          <h5 style="line-height:12px;">Información de la propiedad<br/>
                <span>
                    <p>
                        <h6>{{$factura->property_sub->nombre}}, {{$factura->property->address}}
                        </h6>
                    </p>
                </span>
               
        </h5>
    </div>
    <div class="col-md-8" style="float:right">
                <table style="margin-left:210px;margin-top:-10px">
                    <thead>
                       
                            <th>
                                <h6 style="float:left;">Quién recibe el pago:
                                </h6>
                                <h6 style="float:left;padding-top:15px;font-weight:400;">
                                COLHOUSE
                                </h6>
                                <h6 style="float:left;padding-top:25px;font-weight:400;">
                                INMOBILIARIA
                                </h6>
                            </th>
                            <th>
                                <h6 style="float:left;padding-left:20px">arrendatario:</h6>
                                <h6 style="float:left;padding-top:15px;font-weight:400;padding-left:20px">
                                {{$factura->tenant->name}}
                                </h6>
                            </th>
                            <th>
                                <h6 style="float:left;padding-left:20px">Fecha inicio contrato:</h6>
                                  <h6 style="float:left;padding-left:20px;padding-top:15px;font-weight:400;"> {{date('d/F/Y',strtotime($factura->tenant->fecha_inicio_contrato))}}
                                </h6>
                            </th>
                    </thead>
                </table>
            

                  <table style="margin-left:210px;margin-top:-25px">
                    <thead>
                       
                            <th width="90px" style="text-align:justify;margin-left:300px;padding-right:10px;padding-top:33px">
                                 <h6 style="padding-top:26px;margin-bottom:-18px;text-align:justify;padding-right:20px;letter-spacing:0px;">Fecha Límite para evitar renovación automática de contrato para Vivienda urbana
                           </h6>
                             @if ($factura->tenant->fecha_fin_contrato != NULL)
                               <h6 style="text-align:justify;">{{date('d/F/Y',strtotime($fecha_limite_renovacion))}}</h6>
                               @else
                               <h6 style="text-align:justify;">Por favor verificar la fecha de finalización de este contrato.
                               </h6>
                            @endif
                            </th>
                            <th width="120px" style="text-align:justify;margin-left:-10px">
                                <h6 style="text-align:justify;padding-left:0px;padding-top:26px;padding-bottom:10px; line-height:0px;">Info:</h6>
                    <h6 style="text-align:justify;padding-top:56px">Sin embargo si su contrato
                    es sobre local comercial,
                    le recomendamos leer el
                    acuerdo estipulado, ya
                    que no le aplica la fecha señalada.</h6>
                            </th>
                    </thead>
                </table>           
                <table style="margin-top:-110px;margin-left:210px">
                    <thead>
                        <tr>
                            <th>
                                <h6 style="float:left;padding-top:75px">Fecha creación de la factura
                                </h6>
                                <h6 style="float:left;padding-top:88px;font-weight:400;">{{date('d/F/Y',strtotime($factura->fecha_inicio))}}</h6>
                            </th>
                            <th>
                                <h6 style="float:left;padding-left:20px;padding-top:75px">Fecha de pago:</h6>
                                <h6 style="float:left;padding-top:88px;font-weight:400;padding-left:20px">
                    @if($factura->pago2($factura->id) != NULL)
                    {{date('d/F/Y',strtotime($factura->pago_informe($factura->id)->fecha_pago))}}
                     @else
                     Esta factura aún no registra pago.
                    @endif
                                </h6>
                            </th>
                            <th>
                                <h6 style="float:left;padding-left:20px;padding-top:75px">Fecha límite de pago:</h6>
                                  <h6 style="float:left;padding-left:20px;padding-top:88px;font-weight:400;"> {{date('d/F/Y',strtotime($factura->fecha_corte))}}
                                </h6>
                            </th>
                    </thead>
                </table>
                <div class="row" style="height:20px;padding-top:115px;margin-bottom:20px;color:#fff">
                    espacio
                </div>
            
               </div>
               </div> 

<div class="row" style="padding-top:225px">
    <hr>
        <h3 class="page-title">Resumen de la factura</h3>
        <div class="col-md-4" style="line-height:10px;float:left;">
         <h6>Gastos adicionales:<br/>
         ${{number_format($factura->adicionales), 0, ',', '.'}}
         </h6>
         <h6>Deducciones:<br/>
            ${{number_format($factura->deducciones), 0, ',', '.'}}
        </h6>
        </div>
        
        <div class="col-md-8" style="float:right">
            <div class="panel-body table-responsive">
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
                <h6>Detalles del pago:<br/>
                   @if($factura->pago2($factura->id) != NULL)
                    {{$factura->pago_informe($factura->id)->observaciones}}
                    @else
                     Esta factura aún no registra pago.
                    @endif
                </h6>
            </div>
        </div>
    </div>