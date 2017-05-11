@extends('layouts.admin')

@section('title') Ver Vehiculo @stop

@section('header') Ver Vehiculo @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($vehiculo, ['route' => array('ver_vehiculo', $vehiculo->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-4">{!! Field::text('tipo_placa', $vehiculo->tipo_placa, null, ['disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::text('placa', null, ['disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::text('tipo_vehiculo', $vehiculo->tipoVehiculo->nombre, null, ['disabled']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-4">{!! Field::text('marca_id', $vehiculo->marca->nombre, null, ['disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::text('modelo', null, ['disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::text('linea', null, ['disabled']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::text('color', null, ['disabled']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_asientos', null, ['disabled']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_motor', null, ['disabled']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_chasis', null, ['disabled']) !!}</div>
				</div>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop