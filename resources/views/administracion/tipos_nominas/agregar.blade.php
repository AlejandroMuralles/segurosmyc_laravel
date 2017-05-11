@extends('layouts.admin')

@section('title') Agregar Tipo de Nominas @stop

@section('header') Agregar Tipo de Nominas @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_tipo_nomina'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}
				{!! Field::number('factor_divisor', null, ['data-required'=>'true', 'step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('tipos_nominas') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop