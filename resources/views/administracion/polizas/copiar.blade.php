@extends('layouts.admin')

@section('title') Copiar Solicitud de Póliza @stop

@section('header') Copiar Solicitud de Póliza @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($poliza, ['route' => array('copiar_solicitud_poliza',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-6">{!! Field::text('aseguradora_id',$poliza->aseguradora->nombre,['disabled']) !!}</div>
					<div class="col-lg-6">{!! Field::text('cliente_id',$poliza->cliente->nombre,['disabled']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::text('fecha_inicio', null, ['disabled', 'class'=>'fecha']) !!}</div>
					<div class="col-lg-6">{!! Field::text('fecha_fin', null, ['disabled', 'class'=>'fecha']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::text('dueno_id',$poliza->dueno->nombre_completo,['disabled']) !!}</div>
					<div class="col-lg-6">{!! Field::text('ejecutivo_id',$poliza->ejecutivo->nombre_completo,['disabled']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::text('ramo_id',$poliza->ramo->nombre,['disabled']) !!}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-4">{!! Field::text('anual_declarativa',$poliza->descripo_tipo_pago,['disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::text('frecuencia_pago_id',$poliza->frecuenciaPago->nombre,['disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::text('cantidad_pagos',$poliza->cantidad_pagos,['disabled']) !!}</div>
				</div>
				
				<br/>

				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="incluir_coberturas">Incluir Coberturas</label>
							<input name="incluir_coberturas" type="checkbox" value="1" checked="true">
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="incluir_vehiculos">Incluir Vehiculos</label>
							<input name="incluir_vehiculos" type="checkbox" value="1">
						</div>
					</div>
				</div>

	            <p>
	                <input type="submit" value="Copiar" class="btn btn-primary">
	                <a href="{{ route('solicitudes_polizas') }}" class="btn btn-danger">Cancelar</a>
	            </p>

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

    });
</script>
@stop