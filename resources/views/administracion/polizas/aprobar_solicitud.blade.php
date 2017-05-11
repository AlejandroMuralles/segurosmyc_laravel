@extends('layouts.admin')

@section('title') Aprobar Solicitud de Póliza @stop

@section('header') Aprobar Solicitud de Póliza @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($poliza, ['route' => array('aprobar_solicitud_poliza',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('numero_solicitud', $poliza->numero_solicitud, ['data-required'=>'true', 'disabled']) !!}
				{!! Field::text('numero', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Aprobar" class="btn btn-primary">
	                <a href="{{ route('solicitudes_polizas') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop