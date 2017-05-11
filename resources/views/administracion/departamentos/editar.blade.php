@extends('layouts.admin')

@section('title') Editar Departamento - {{$departamento->pais->nombre}} @stop

@section('header') Editar Departamento - {{$departamento->pais->nombre}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($departamento, ['route' => array('editar_departamento', $departamento->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('departamentos',$departamento->pais_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop