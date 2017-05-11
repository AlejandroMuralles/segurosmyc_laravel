@extends('layouts.admin')

@section('title') Agregar Requerimientos a Póliza @stop

@section('header') Agregar Requerimientos a Póliza @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
			
			{!! Form::open(['route' => array('generar_poliza_requerimiento',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			<h3>Requerimiento Base</h3>
			<hr>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::number('numero',$numero_inicial,['data-required'=>'true', 'id'=>'numero']) !!}
				</div>
				<div class="col-lg-3">
					{!! Field::text('fecha_inicio',date('Y-m-d',strtotime($fecha_inicio)),['data-required'=>'true', 'id'=>'fecha_inicio', 'class'=>'fecha']) !!}
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::number('prima_neta', $prima_neta, ['data-required'=>'true', 'step'=>'any','id'=>'primaNeta']) !!}
				</div>
				<div class="col-lg-3">
					{!! Field::number('asistencia', $asistencia, ['data-required'=>'true', 'step'=>'any']) !!}
				</div>
				<div class="col-lg-3">
					{!! Field::number('cantidad_pagos',$cantidad_pagos,['data-required'=>'true', 'step'=>'any']) !!}
				</div>
			</div>
			<div class="row">
			@if($poliza->anual_declarativa == 'A')			
				<div class="col-lg-3">
					{!! Field::select('poliza_inclusion_id',$inclusiones,$polizaInclusionId) !!}
				</div>			
			@elseif($poliza->anual_declarativa == 'D')
				<div class="col-lg-3">
					{!! Field::select('poliza_declaracion_id',$declaraciones,$polizaDeclaracionId) !!}
				</div>
			@endif
				<div class="col-lg-3">
					{!! Field::select('cliente_id',$clientes,$clienteId) !!}
				</div>
				<div class="col-lg-3">
					{!! Field::number('pct_descuento',$pctDescuento,['data-required'=>'true', 'step'=>'any','id'=>'pctDescuento']) !!}
				</div>
				<div class="col-lg-3">
					{!! Field::number('descuento',$descuento,['data-required'=>'true', 'step'=>'any','id'=>'descuento']) !!}
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					{!! Field::textarea('observaciones', $observaciones) !!}
				</div>
			</div>

			<input type="submit" value="Generar Requerimientos" class="btn btn-info">
			<a href="{{ route('agregar_poliza_requerimiento',$poliza->id) }}" class="btn btn-danger">Empezar</a>
			<a href="javascript:history.back(-1);" title="Ir la página anterior" class="btn btn-danger">Regresar</a>
			<hr>
			{!! Form::close() !!}

			@if(isset($requerimientos))

            {!! Form::open(['route' => array('agregar_poliza_requerimiento',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<table class="table table-responsive" id="table_requerimientos">
					<thead>
						<tr>
							<th class="text-center">NUMERO</th>
							<th class="text-center">CUOTA</th>
							<th class="text-center">FECHA DE COBRO</th>
							<th class="text-center">PRIMA NETA</th>
							<th class="text-center">EMISION</th>
							<th class="text-center">FRACC.</th>
							<th class="text-center">ASISTENCIA</th>
							<th class="text-center">IVA</th>
							<th class="bg-blue text-white text-center">SUB T.</th>
							<th class="text-center">PCT DESC</th>
							<th class="text-center">DESC</th>
							<th class="bg-blue text-white text-center">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						@foreach($requerimientos as $r)
							<tr>
								<td><input type="text" value="{{$r->numero}}" class="form-control" name="requerimientos[{{$r->numero}}][numero]" data-required="true"></td>
								<td>{{$r->cuota}}
									<input type="hidden" value="{{$r->cuota}}" class="form-control" name="requerimientos[{{$r->numero}}][cuota]">
									<input type="hidden" value="{{$r->poliza_inclusion_id}}" class="form-control" name="requerimientos[{{$r->numero}}][poliza_inclusion_id]">
									<input type="hidden" value="{{$r->poliza_declaracion_id}}" class="form-control" name="requerimientos[{{$r->numero}}][poliza_declaracion_id]">
									<input type="hidden" value="{{$r->cliente_id}}" class="form-control" name="requerimientos[{{$r->numero}}][cliente_id]">
									<input type="hidden" value="{{$r->observaciones}}" class="form-control" name="requerimientos[{{$r->numero}}][observaciones]">
								</td>
								<td><input type="text" value="{{$r->fecha_cobro}}" class="form-control fecha" name="requerimientos[{{$r->numero}}][fecha_cobro]" data-required="true"></td>
								<td><input type="text" value="{{$r->prima_neta}}" class="form-control" name="requerimientos[{{$r->numero}}][prima_neta]" data-required="true"></td>
								<td><input type="text" value="{{$r->emision}}" class="form-control" name="requerimientos[{{$r->numero}}][emision]" data-required="true"></td>
								<td><input type="text" value="{{$r->fraccionamiento}}" class="form-control" name="requerimientos[{{$r->numero}}][fraccionamiento]" data-required="true"></td>
								<td><input type="text" value="{{$r->asistencia}}" class="form-control" name="requerimientos[{{$r->numero}}][asistencia]" data-required="true"></td>
								<td><input type="text" value="{{$r->iva}}" class="form-control" name="requerimientos[{{$r->numero}}][iva]" data-required="true"></td>
								<td class="bg-blue text-white"><input type="text" value="{{$r->sub_total_prima}}" class="form-control" name="requerimientos[{{$r->numero}}][sub_total_prima]" data-required="true"></td>
								<td><input type="text" value="{{$r->pct_descuento}}" class="form-control" name="requerimientos[{{$r->numero}}][pct_descuento]" data-required="true"></td>
								<td><input type="text" value="{{$r->descuento}}" class="form-control" name="requerimientos[{{$r->numero}}][descuento]" data-required="true"></td>
								<td class="bg-blue text-white"><input type="text" value="{{$r->prima_total}}" class="form-control" name="requerimientos[{{$r->numero}}][prima_total]" data-required="true"></td>
							</tr>
						@endforeach
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td>{{$totalPrimaNeta}}</td>
							<td></td>
							<td></td>
							<td>{{$totalAsistencia}}</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>{{$totalPrimaTotal}}</td>
						</tr>
					</tbody>
				</table>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$poliza->id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}

            @endif
		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    $(function(){
    	$('.fecha').datepicker({
    		format: 'yyyy-mm-dd',
		    autoclose: true,
		    todayHighlight: true
		});

    	$('#primaNeta').on('change', calcularDescuento);
    	$('#pctDescuento').on('change', calcularDescuento);

    });

    function calcularDescuento()
    {
    	var primaNeta = $('#primaNeta').val();
    	var pctDescuento = $('#pctDescuento').val();
    	var descuento = primaNeta * (pctDescuento/100);
    	$('#descuento').val(descuento);
    }

</script>
@stop