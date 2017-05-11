@extends('layouts.admin')

@section('title') Agregar Cobertura General a Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('header') Agregar Cobertura General a Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_exclusion_cobertura',$polizaExclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-4">
						{!! Field::select('cobertura_id', $coberturas, null, ['data-required'=>'true']) !!}	
					</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$polizaExclusion->poliza_id) }}#exclusiones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop