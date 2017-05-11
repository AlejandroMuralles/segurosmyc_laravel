@extends('layouts.admin')

@section('title') Editar Tipo de Modificación de Poliza @stop

@section('header') Editar Tipo de Modificación de Poliza @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($tipoPolizaModificacion, ['route' => array('editar_tipo_poliza_modificacion', $tipoPolizaModificacion->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('tipos_polizas_modificaciones') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop