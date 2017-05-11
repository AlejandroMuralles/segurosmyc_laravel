@extends('layouts.admin')

@section('title') Editar Cobertura Particular a Vehículo {{$coberturaParticular->poliza->numero_solicitud_poliza}} - Placa {{$coberturaParticular->vehiculo->placa}} @stop

@section('header') Editar Cobertura Particular a Vehículo @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<h1>Solicitud de Póliza {{$coberturaParticular->poliza->numero_solicitud_poliza}} - Placa {{$coberturaParticular->vehiculo->placa}}</h1>
            
            {!! Form::model($coberturaParticular, ['route' => array('editar_poliza_cobertura_vehiculo',$coberturaParticular->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('cobertura', $coberturaParticular->cobertura->nombre, ['data-required'=>'true']) !!}
				<div class="row">
					<div class="col-lg-3">{!! Field::number('suma_asegurada', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('porcentaje_deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible_minimo', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_solicitud_poliza',$coberturaParticular->poliza_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop