@extends('layouts.admin')

@section('title') Agregar Planilla Póliza - Solicitud {{$poliza->numero_solicitud}}@stop

@section('header') Agregar Planilla Póliza - Solicitud {{$poliza->numero_solicitud}}@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_planilla_poliza',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('aseguradora', $poliza->aseguradora->nombre, ['disabled']) !!}
				{!! Field::text('fecha', date('Y-m-d'), ['data-required'=>'true','class'=>'fecha']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_solicitud_poliza',$poliza->id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}

		</div>
	</div>
</div>
@stop