@extends('layouts.admin')

@section('title') Agregar Vehículo a Solicitud de Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('header') Agregar Vehículo a Solicitud de Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_exclusion_vehiculo',$polizaExclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('vehiculo_id', $vehiculos, null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$polizaExclusion->poliza_id) }}#exclusiones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop