@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.pagos.fields.consultarpago')</h3>
     <a href="{{ route('admin.properties_pagos.index') }}" class="btn btn-success">@lang('global.app_back_to_list')</a>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
                <a href="{{ route('admin.properties_pagos.edit',[$pago->id])}}" data-toggle="tooltip" title="Editar Pago">
                    <span class="label label-info" style="margin-left:10px;padding:10px">Editar
                    </span>
                </a>
                 <a href="{{ route('admin.properties_pagos.imprimirpago',[$pago->id])}}" data-toggle="tooltip" title="Descargar PDF">
                    <span class="label label-warning" style="margin-left:10px;padding:10px">Descargar PDF
                    </span>
                </a>
        </div>
        <div class="inner">
        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-7">
                    <table class="table table-bordered table-striped">

                         <tr>
                            <th>@lang('global.pagos.fields.valor')</th>
                            <td field-key='porpagar'>
                             <span class="label label-danger" style="padding-bottom:0px;padding-top:8px;font-weight:700;">
                                <h4 style="font-weight:700;">${{number_format($pago->valor), 0, ',', '.'}}</h4>
                                </span>
                            </td>


                            <td field-key='name'>
                                <h5><b>Observaciones del pago:</b> <br/></h5>
                              <!--<a href="{{ route('admin.properties_pagos.create',[$pago->id]) }}" data-toggle="tooltip" title="Editar Pago" class="btn btn-success">Crear Pago
                                    <span class="label label-info" style="margin-left:10px;padding:10px">Crear Pago
                                    </span>
                                </a>-->
                                 {{ $pago->observaciones }}
                            </td>
                               <th>Fecha del Pago</th>
                            <td field-key='porpagar'>
                             {{date('d/F/Y',strtotime($pago->fecha_pago))}}
                            </td>
                            <!--    <th>Fecha Corte</th>
                            <td field-key='porpagar'>
                             {{date('d/F/Y',strtotime($pago->fecha_corte))}}
                            </td>-->
                        </tr>

                        <tr>

                            <th>@lang('global.pagos.fields.realizadopor')</th>
                            <td field-key='name'>
                                <a href="{{ route('admin.tenants.show',[$pago->tenant->id])}}" data-toggle="tooltip" title="Id: {{$pago->tenant->id}}">
                                {{ $pago->tenant->name }}
                                </a>
                            </td>
                             <th>Cédula</th>
                            <td field-key='name'>
                                <a href="{{ route('admin.tenants.show',[$pago->tenant->id])}}" data-toggle="tooltip" title="Cédula: {{$pago->tenant->cedula}}">
                                {{ $pago->tenant->cedula }}
                                </a>
                                
                            </td>

                        </tr>
                       
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.tenants.fields.email')</th>
                            <td field-key='address'>{{ $pago->tenant->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tenants.fields.phone')</th>
                            <td field-key='photo'>
                                {{ $pago->tenant->phone }}
                               
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-5">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Codeudor</th>
                            <td field-key='name'>{{ $pago->tenant->codeudor }}</td>
                            <th>Cédula</th>
                            <td field-key='porpagar'>{{$pago->tenant->cc_codeudor}}
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.tenants.fields.email')</th>
                            <td field-key='address'>{{ $pago->tenant->email_codeudor }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.tenants.fields.phone')</th>
                            <td field-key='address'>{{ $pago->tenant->tel_codeudor }}</td>
                        </tr>
                    </table>
                </div>

            </div><!-- Nav tabs -->
<!--<ul class="nav nav-tabs" role="tablist">-->
    
<!--<li role="presentation" class="active"><a href="#documents" aria-controls="documents" role="tab" data-toggle="tab">@lang('global.pagos.title')</a></li>-->
<!--<li role="presentation" class=""><a href="#notes" aria-controls="notes" role="tab" data-toggle="tab">Notes</a></li>-->
<!--</ul>-->

<!-- Tab panes -->
<!--<div class="tab-content">

   

<div role="tabpanel" class="tab-pane active" id="facturas">

<table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        @can('properties_facturas_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.facturas.fields.property')</th>
                        <th>@lang('global.facturas.fields.unidad')</th>
                        <th>@lang('global.facturas.fields.tenant')</th>
                         <th style="text-align:center;">Fecha Pago</th>
                       
                        
                        <th>@lang('global.facturas.fields.valorpago')</th>
                        <th>Estado</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                 
                </tbody>
            </table>

</div>

</div>-->

            <p>&nbsp;</p>

            <a href="{{ route('admin.properties_pagos.index') }}" class="btn btn-success">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
