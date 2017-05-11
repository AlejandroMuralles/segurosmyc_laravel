@extends('layouts.admin')

@section('title') Editar Tipo de Vehiculo @stop

@section('header') Editar Tipo de Vehiculo @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($tipoDescuento, ['route' => array('editar_tipo_vehiculo', $tipoVehiculo->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('tipos_vehiculos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop