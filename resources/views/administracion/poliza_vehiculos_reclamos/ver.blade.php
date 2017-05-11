@extends('layouts.admin')

@section('title') Reclamo {{$polizaVehiculoReclamo->numero}} - Certificado {{$polizaVehiculoReclamo->poliza_vehiculo->numero_certificado}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($polizaVehiculoReclamo, ['route' => array('ver_poliza_vehiculo_reclamo', $polizaVehiculoReclamo->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
             <div class="row">
                <div class="col-lg-6">
                    <div class="row">                        
                        <div class="col-lg-6">{!! Field::text('numero_aviso', null, ['disabled']) !!}</div>
                        <div class="col-lg-6">{!! Field::text('numero', null, ['disabled']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">{!! Field::text('fecha', date('d-m-Y H:i', strtotime($polizaVehiculoReclamo->fecha_solicitud)), ['disabled']) !!}</div>
                        <div class="col-lg-6">{!! Field::text('ajustador', null, ['disabled']) !!}</div>
                    </div>
                    <div class="row">                        
                        <div class="col-lg-6">{!! Field::text('reportante', null, ['disabled']) !!}</div>
                        <div class="col-lg-6">{!! Field::text('piloto', null, ['disabled']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">{!! Field::textarea('observaciones', null, ['disabled']) !!}</div>
                    </div>
                </div>
            
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-responsive" id="tablaReclamos">
                            <thead>
                                <tr>
                                    <th>COBERTURA</th>
                                    <th width="135px">VALOR</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php $total = 0; ?>
                                @foreach($detalle as $d)
                                	<tr>
										<td>{{$d->cobertura->nombre}}</td>
										<td>Q. {{number_format($d->valor,2)}}</td>
									</tr>
									<?php $total+= $d->valor; ?>
                                @endforeach
                                <tr>
									<td>TOTAL</td>
									<td>Q. {{number_format($total,2)}}</td>
								</tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
			<a href="{{route($polizaVehiculoReclamo->poliza_vehiculo->poliza->ruta, $polizaVehiculoReclamo->poliza_vehiculo->poliza_id)}}#reclamos" class="btn btn-danger">Regresar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop