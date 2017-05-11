@extends('layouts.admin')

@section('title') Agregar Aseguradora @stop

@section('header') Agregar Aseguradora @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_aseguradora'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}
				{!! Field::text('nit', null, ['data-required'=>'true']) !!}
				{!! Field::textarea('direccion', null, ['data-required'=>'true']) !!}
				{!! Field::text('codigo_agente', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('aseguradoras') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop