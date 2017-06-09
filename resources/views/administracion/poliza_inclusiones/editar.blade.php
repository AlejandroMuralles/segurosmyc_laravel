@extends('layouts.admin')
@section('title') Editar Solicitud de Inclusión {{$polizaInclusion->numero_solicitud}} @stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($polizaInclusion, ['route' => array('editar_poliza_inclusion',$polizaInclusion->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
				<div class="row">
					<div class="col-lg-3">
						{!! Field::text('numero_solicitud', $polizaInclusion->numero_solicitud, ['disabled']) !!} 
					</div>
					<div class="col-lg-3">
						{!! Field::text('estado', $polizaInclusion->descripcion_estado, ['disabled']) !!} 
					</div>
					<div class="col-lg-3">
						{!! Field::text('fecha_solicitud', $polizaInclusion->fecha_solicitud, ['disabled']) !!} 
					</div>
					<div class="col-lg-3">
						{!! Field::text('pct_fraccionamiento', $polizaInclusion->pct_fraccionamiento, ['disabled']) !!} 
					</div>
				</div>
				<div class="row">
					<div class="col-lg-3">
						{!! Field::select('cantidad_pagos', $fraccionamientos, null, ['data-required'=>'true']) !!} 
					</div>
					
				</div>

				<div class="row">
					<div class="col-lg-12">
						<input type="submit" value="Editar" class="btn btn-primary">
						<a href="{{route($polizaInclusion->poliza->ruta,$polizaInclusion->poliza_id)}}#inclusiones" class="btn btn-danger">Regresar</a>
					</div>
				</div>
			{!! Form::close() !!}
			
			
		</div>
	</div>
</div>
@stop