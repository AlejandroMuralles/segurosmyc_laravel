@extends('layouts.admin')

@section('title') Aprobar Inclusión @stop

@section('header') Aprobar Inclusión @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($inclusion, ['route' => array('aprobar_poliza_inclusion',$inclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('solicitud', $inclusion->numero_solicitud, ['data-required'=>'false', 'disabled']) !!}
				{!! Field::text('endoso', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Aprobar" class="btn btn-primary">
	                <a href="{{ route($inclusion->poliza->ruta,$inclusion->poliza_id) }}#inclusiones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop