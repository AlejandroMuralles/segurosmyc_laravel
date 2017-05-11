@extends('layouts.admin')

@section('title') Editar Certificado Vehículo {{$vehiculo->vehiculo->placa}} @stop

@section('header') Editar Certificado Vehículo {{$vehiculo->vehiculo->placa}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('editar_certificado_poliza_vehiculo',$vehiculo->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-4">{!! Field::text('numero_certificado', null, ['data-required'=>'true']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$vehiculo->poliza_id) }}#vehiculos" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop