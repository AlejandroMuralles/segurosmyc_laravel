@extends('layouts.admin')

@section('title') Editar Aseguradora @stop

@section('header') Editar Aseguradora @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($aseguradora, ['route' => array('editar_aseguradora', $aseguradora->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}
				{!! Field::text('nit', null, ['data-required'=>'true']) !!}
				{!! Field::textarea('direccion', null, ['data-required'=>'true']) !!}

				{!! Field::text('codigo_agente', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('aseguradoras') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop