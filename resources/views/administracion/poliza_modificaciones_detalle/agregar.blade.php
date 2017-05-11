@extends('layouts.admin')

@section('title') Agregar Cambios a Solicitud de Modificación @stop

@section('header') Agregar Cambios a Solicitud de Modificación @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_modificacion_detalle',$polizaModificacion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}

				{!! Field::select('tipo_poliza_modificacion_id', $tipos, null, ['data-required'=>'true']) !!}

				{!! Field::select('solicitante', $solicitantes, null, ['data-required'=>'true']) !!}

				{!! Field::textarea('cambio', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route($polizaModificacion->poliza->ruta,$polizaModificacion->poliza->id) }}#modificaciones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop
