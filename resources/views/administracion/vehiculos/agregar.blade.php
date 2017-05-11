@extends('layouts.admin')

@section('title') Agregar Vehiculo @stop

@section('header') Agregar Vehiculo @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_vehiculo'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-4">{!! Field::select('tipo_placa', $tiposPlaca, null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-4">{!! Field::text('placa', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-4">{!! Field::select('tipo_vehiculo_id', $tiposVehiculo, null, ['data-required'=>'true']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::select('marca_id', $marcas, null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::number('modelo', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::text('linea', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::text('cilindraje', null, ['data-required'=>'true']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::text('color', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_asientos', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_motor', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_chasis', null, ['data-required'=>'true']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('vehiculos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop