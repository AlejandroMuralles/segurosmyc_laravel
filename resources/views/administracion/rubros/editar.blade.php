@extends('layouts.admin')

@section('title') Editar Rubro @stop

@section('header') Editar Rubro @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($rubro, ['route' => array('editar_rubro', $rubro->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}
				{!! Field::select('estado', $estados, null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('rubros') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop