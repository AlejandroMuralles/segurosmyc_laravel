@extends('layouts.admin')

@section('title') Editar Cambios de Solicitud de Modificación @stop

@section('header') Editar Cambios de Solicitud de Modificación @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($cambio, ['route' => array('editar_poliza_modificacion_detalle',$cambio->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}

				{!! Field::select('tipo_poliza_modificacion_id', $tipos, null, ['data-required'=>'true']) !!}

				{!! Field::select('solicitante', $solicitantes, null, ['data-required'=>'true']) !!}

				{!! Field::textarea('cambio', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza_modificacion',$cambio->poliza_modificacion_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop
