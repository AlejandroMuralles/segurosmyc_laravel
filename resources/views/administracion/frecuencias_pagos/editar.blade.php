@extends('layouts.admin')

@section('title') Editar Frecuencia de Pago @stop

@section('header') Editar Frecuencia de Pago @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($frecuenciaPago, ['route' => array('editar_frecuencia_pago', $frecuenciaPago->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}
				{!! Field::number('meses', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('frecuencias_pagos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop