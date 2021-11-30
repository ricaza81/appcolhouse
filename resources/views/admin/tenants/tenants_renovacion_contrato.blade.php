@extends('layouts.app')

@section('content')
<h2>Actualización de canones de arrendamiento</h2>

 <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>
   <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($usuarios) > 0 ? 'datatable' : '' }}">
            <thead>
                <tr>
                     <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Inquilino</th>
                    <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Inicio Contrato</th>
                    <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Duración contrato (meses)</th>
                    <th align="center" scope="col" style="width:20px;padding:20px 20px 20px 20px;border-bottom:3px solid #fff">Actualizar</th>

                </tr>
            </thead>

    <tbody>
        @foreach ($usuarios as $usuario)
            @if (empty($usuario->subproperty->cambio_canon) && $usuario->fecha_inicio_contrato->diffInDays(now())>355)
            <tr role="row" class="odd"  >

                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{ $usuario->name }}<br/>Cédula: {{$usuario->cedula}}</td>
                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{date('d/F/Y', strtotime($usuario->fecha_inicio_contrato)) }}</td>
                <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">{{$usuario->duracion_meses}}<br/>
                     Tiempo transcurrido: {{ $usuario->fecha_inicio_contrato->diffInDays(now()) }} días
                </td>
                 <td align="center" style="width:20px;padding:20px 20px 20px 20px;border-bottom:1px solid #4CAF50;background-color: #fff;color:#4CAF50;">
                  
                   <a href="{{ route('admin.properties_sub.show',[$usuario->subproperty->id]) }}">Actualizar canon</a>
                 </td>

            </tr>
            @endif
        @endforeach
  </tbody>
</table>
</div>
</div>
  

@endsection