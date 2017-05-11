@extends('layouts.admin')

@section('title') Agregar Cobertura Particular a Vehículo a Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('header') Agregar Cobertura Particular a Vehículo a Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_exclusion_cobertura_vehiculo',$polizaExclusion->id, $vehiculoId), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('vehiculo_id', $vehiculos, $vehiculoId, ['data-required'=>'true','id'=>'vechiculo_id']) !!}
				{!! Field::select('cobertura_id', $coberturas, null, ['data-required'=>'true']) !!}

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
@section('js')
<script>
	$(function()
	{
		$('#vechiculo_id').on('change',function()
		{
			var ruta = "{{route('inicio')}}/Polizas-Exclusion/agregar-cobertura-vehiculo/{{$polizaExclusion->id}}/"+$(this).val();
			window.location.href = ruta;
		});
	});
</script>
@stop