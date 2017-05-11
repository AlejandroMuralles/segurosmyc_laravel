@extends('layouts.admin')

@section('title') Editar Reclamo {{$polizaVehiculoReclamo->numero}} - Certificado {{$polizaVehiculoReclamo->poliza_vehiculo->numero_certificado}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($polizaVehiculoReclamo, ['route' => array('editar_poliza_vehiculo_reclamo', $polizaVehiculoReclamo->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
             <div class="row">
                <div class="col-lg-6">
                    <div class="row">                        
                        <div class="col-lg-6">{!! Field::text('numero_aviso', null, ['data-required'=>'true']) !!}</div>
                        <div class="col-lg-6">{!! Field::text('numero', null, ['data-required'=>'true']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">{!! Field::text('fecha', date('d-m-Y', strtotime($polizaVehiculoReclamo->fecha_solicitud)), ['data-required'=>'true']) !!}</div>
                        <div class="col-lg-3">
                            <label>Hora</label>
                            <div class="input-append bootstrap-timepicker input-group">
                                <input id="timepicker1" class="form-control" type="text" name="hora" value="{{date('H:i', strtotime($polizaVehiculoReclamo->fecha_solicitud))}}" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default add-on" type="button"><i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">{!! Field::text('ajustador', null, ['data-required'=>'true']) !!}</div>
                    </div>
                    <div class="row">                        
                        <div class="col-lg-6">{!! Field::text('reportante', null, ['data-required'=>'true']) !!}</div>
                        <div class="col-lg-6">{!! Field::text('piloto', null, ['data-required'=>'true']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">{!! Field::textarea('observaciones', null, ['data-required'=>'true']) !!}</div>
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
             <input type="submit" value="Editar" class="btn btn-primary">
			<a href="{{route($polizaVehiculoReclamo->poliza_vehiculo->poliza->ruta, $polizaVehiculoReclamo->poliza_vehiculo->poliza_id)}}#reclamos" class="btn btn-danger">Regresar</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('js')
<script src="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script>
	$(function(){

        $('.fecha').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        $('#timepicker1').timepicker({
            showMeridian: false,
            minuteStep: 30,
            defaultTime: '07:00'
        });
    });
</script>
@stop