@extends('layouts.admin')

@section('title') Editar Municipio - {{$municipio->departamento->nombre}} @stop

@section('header') Editar Municipio - {{$municipio->departamento->nombre}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($municipio, ['route' => array('editar_municipio', $municipio->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('municipios',$municipio->departamento_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop