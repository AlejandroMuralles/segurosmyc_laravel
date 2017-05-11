@extends('layouts.admin')

@section('title') Aprobar Solicitud de Modificacion @stop

@section('header') Aprobar Solicitud de Modificacion @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($modificacion, ['route' => array('aprobar_poliza_modificacion',$modificacion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('solicitud', $modificacion->numero_solicitud, ['data-required'=>'false', 'disabled']) !!}
				{!! Field::text('endoso', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Aprobar" class="btn btn-primary">
	                <a href="{{ route($modificacion->poliza->ruta,$modificacion->poliza_id) }}#modificaciones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop