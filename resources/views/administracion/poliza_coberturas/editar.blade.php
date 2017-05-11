@extends('layouts.admin')

@section('title') Editar Cobertura General a Póliza {{$cobertura->poliza->numero_solicitud}} @stop

@section('header') Editar Cobertura General a Póliza {{$cobertura->poliza->numero_solicitud}} @stop

@section('css')
<link href="{{ asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<h1>Solicitud de Póliza {{$cobertura->poliza->numero_solicitud}}</h1>
            
            {!! Form::model($cobertura,['route' => array('editar_poliza_cobertura',$cobertura->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('cobertura', $cobertura->cobertura->nombre, ['data-required'=>'true', 'disabled']) !!}

				<div class="row">
					<div class="col-lg-3">{!! Field::number('suma_asegurada', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('porcentaje_deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('deducible_minimo', null, ['data-required'=>'true', 'step'=>'any']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_solicitud_poliza',$cobertura->poliza_id) }}#coberturas" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{ asset('assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
<script>
	$(function()
	{
		$(".buscar-select").select2();
	});
</script>
@stop