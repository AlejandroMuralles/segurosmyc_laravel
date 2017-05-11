@extends('layouts.admin')

@section('title') Agregar Vehículo a Solicitud de Póliza @stop

@section('header') Agregar Vehículo a Solicitud de Póliza @stop

@section('css')
<link href="{{ asset('assets/plugins/select2/select2.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_vehiculo',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}

				<div class="row">
					<div class="col-lg-6">
						{!! Field::select('vehiculo_id', $vehiculos, null, ['data-required'=>'true', 'class'=>'buscar-select']) !!}
					</div>
					<div class="col-lg-6">
						{!! Field::select('cliente_id', $clientes, null, ['class'=>'buscar-select']) !!}
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-3">{!! Field::number('suma_asegurada', null, ['data-required'=>'true', 'step'=>'any', 'id'=>'suma_asegurada']) !!}</div>
					<div class="col-lg-3">{!! Field::number('suma_asegurada_blindaje', null, ['data-required'=>'false', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('prima_neta', null, ['data-required'=>'true', 'id'=>'prima_neta', 'step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('asistencia', null, ['data-required'=>'true', 'id'=>'asistencia', 'step'=>'any']) !!}</div>
				</div>
				<h3 class="sub-title">Deducibles por Robo</h3>
				<div class="row">
					<div class="col-lg-4">{!! Field::number('pct_deducible_robo', null, ['data-required'=>'', 'step'=>'any', 'id'=>'pct_deducible_robo']) !!}</div>
					<div class="col-lg-4">{!! Field::number('deducible_robo', null, ['data-required'=>'', 'step'=>'any', 'id'=>'deducible_robo', 'disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::number('deducible_minimo_robo', null, ['data-required'=>'', 'step'=>'any']) !!}</div>
				</div>
				<h3 class="sub-title">Deducibles por Daños</h3>
				<div class="row">
					<div class="col-lg-4">{!! Field::number('pct_deducible_dano', null, ['data-required'=>'', 'step'=>'any', 'id'=>'pct_deducible_dano']) !!}</div>
					<div class="col-lg-4">{!! Field::number('deducible_dano', null, ['data-required'=>'', 'step'=>'any', 'id'=>'deducible_dano', 'disabled']) !!}</div>
					<div class="col-lg-4">{!! Field::number('deducible_minimo_dano', null, ['data-required'=>'', 'step'=>'any']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_solicitud_poliza',$poliza->id) }}#vehiculos" class="btn btn-danger">Cancelar</a>
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

		$("#pct_deducible_robo").on('change', calcularDeducibleRobo);

		$("#pct_deducible_robo").focusout(calcularDeducibleRobo);

		$("#pct_deducible_dano").on('change', calcularDeducibleDano);

		$("#pct_deducible_dano").focusout(calcularDeducibleDano);

		$("#suma_asegurada").on('change', calcularDeducibles);

		$("#suma_asegurada").focusout(calcularDeducibles);

	});

	function calcularDeducibleDano()
	{
		var pct = $('#pct_deducible_dano').val();
		var suma_asegurada = $('#suma_asegurada').val();
		var deducible = suma_asegurada * (pct / 100);
		$('#deducible_dano').val(deducible.toFixed(2));
	}

	function calcularDeducibleRobo()
	{
		var pct = $('#pct_deducible_robo').val();
		var suma_asegurada = $('#suma_asegurada').val();
		var deducible = suma_asegurada * (pct / 100);
		$('#deducible_robo').val(deducible.toFixed(2));
	}

	function calcularDeducibles()
	{
		calcularDeducibleRobo();
		calcularDeducibleDano();
	}

</script>
@stop