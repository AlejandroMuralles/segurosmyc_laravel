@extends('layouts.admin')

@section('title') Editar Impuesto @stop

@section('header') Editar Impuesto @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($impuesto, ['route' => array('editar_impuesto', $impuesto->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}
				{!! Field::number('porcentaje', null, ['data-required'=>'true','step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('impuestos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop