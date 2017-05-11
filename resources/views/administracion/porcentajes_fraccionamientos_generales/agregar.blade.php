@extends('layouts.admin')

@section('title') Agregar Porcentaje Fraccionamiento General @stop

@section('header') Agregar Porcentaje Fraccionamiento General @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title">
                    <h4></h4>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="portlet-body">

	            {!! Form::open(['route' => array('agregar_porcentaje_fraccionamiento_general'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
				
					{!! Field::number('cantidad_pagos', null, ['data-required'=>'true']) !!}

					{!! Field::number('porcentaje', null, ['data-required'=>'true', 'step'=>'any']) !!}

					<br/>

		            <p>
		                <input type="submit" value="Agregar" class="btn btn-primary">
		                <a href="{{ route('porcentajes_fraccionamientos_generales') }}" class="btn btn-danger">Cancelar</a>
		            </p>

	            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop