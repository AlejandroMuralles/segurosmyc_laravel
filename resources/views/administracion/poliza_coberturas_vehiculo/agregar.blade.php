@extends('layouts.admin')

@section('title') Agregar Cobertura Particular a Vehículo {{$polizaVehiculo->numero_solicitud_poliza}} - Placa {{$polizaVehiculo->vehiculo->placa}} @stop

@section('header') Agregar Cobertura Particular a Vehículo @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<h1>Solicitud de Póliza {{$polizaVehiculo->numero_solicitud_poliza}} - Placa {{$polizaVehiculo->vehiculo->placa}}</h1>
            
            {!! Form::open(['route' => array('agregar_poliza_cobertura_vehiculo',$polizaVehiculo->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('cobertura_id', $coberturas, null, ['data-required'=>'true']) !!}
				<div class="row">
					<div class="col-lg-3">{!! Field::number('suma_asegurada', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('porcentaje_deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible_minimo', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_solicitud_poliza',$polizaVehiculo->poliza_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop