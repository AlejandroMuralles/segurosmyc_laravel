@extends('layouts.admin')

@section('title') Editar Porcentaje de Fraccionamiento por Aseguradora @stop

@section('header') Editar Porcentaje de Fraccionamiento por Aseguradora @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

        	<h3>{{$porcentaje->aseguradora->nombre}}</h3>

            {!! Form::model($porcentaje, ['route' => array('editar_porcentaje_fraccionamiento_aseguradora',$porcentaje->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::number('cantidad_pagos', null, ['data-required'=>'true']) !!}

				{!! Field::number('porcentaje', null, ['data-required'=>'true', 'step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('porcentajes_fraccionamientos_aseguradoras',$porcentaje->aseguradora_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop