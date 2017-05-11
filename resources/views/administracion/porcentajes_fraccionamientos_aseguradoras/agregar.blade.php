@extends('layouts.admin')

@section('title') Agregar Porcentaje de Fraccionamiento por Aseguradora @stop

@section('header') Agregar Porcentaje de Fraccionamiento por Aseguradora @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

        	<h3>{{$aseguradora->nombre}}</h3>

            {!! Form::open(['route' => array('agregar_porcentaje_fraccionamiento_aseguradora',$aseguradora->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::number('cantidad_pagos', null, ['data-required'=>'true']) !!}

				{!! Field::number('porcentaje', null, ['data-required'=>'true', 'step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('porcentajes_fraccionamientos_aseguradoras',$aseguradora->id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop