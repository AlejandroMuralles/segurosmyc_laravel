@extends('layouts.admin')

@section('title') Agregar Cobertura Particular a Vehículo a Inclusión {{$polizaInclusion->numero_solicitud}} @stop

@section('header') Agregar Cobertura Particular a Vehículo a Inclusión {{$polizaInclusion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_inclusion_cobertura_vehiculo',$polizaInclusion->id, $vehiculoId), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-3">{!! Field::select('vehiculo_id', $vehiculos, $vehiculoId, ['data-required'=>'true']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-3">{!! Field::select('cobertura_id', $coberturas, null, ['data-required'=>'true']) !!}</div>
				</div>
				
				
				<div class="row">
					<div class="col-lg-3">{!! Field::number('suma_asegurada', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('porcentaje_deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible_minimo', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
				</div>
				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$polizaInclusion->poliza_id) }}#inclusiones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop