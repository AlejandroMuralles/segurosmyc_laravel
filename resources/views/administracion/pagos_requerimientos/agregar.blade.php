@extends('layouts.admin')

@section('title') Pagar Requerimientos @stop

@section('header') Pagar Requerimientos @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
		{!! Form::open(['route' => array('agregar_pago_requerimiento',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
        <div class="row">
        	<div class="col-lg-6">
        		<h3>Requerimientos</h3>
        		<div class="table-responsive">
					<table class="table table-responsive">
						<thead>
							<tr>
								<th></th>
								<th>ESTADO</th>
								<th>NUMERO</th>
								<th>CUOTA</th>
								<th>FECHA DE PAGO</th>
								<th>PAGO PENDIENTE</th>
							</tr>
						</thead>
						<tbody>
						@foreach($requerimientos as $requerimiento)
						<tr>
							<td>
								<input type="checkbox" name="requerimientos[{{$requerimiento->id}}][check]" class="chk" value="{{$requerimiento->id}}">
								<input type="hidden" name="requerimientos[{{$requerimiento->id}}][id]" value="{{$requerimiento->id}}">
								<input type="hidden" name="requerimientos[{{$requerimiento->id}}][pago_pendiente]" value="{{$requerimiento->pago_pendiente}}" id="pago_pendiente{{$requerimiento->id}}">
							</td>
							<td>{{ $requerimiento->descripcion_estado }}</td>
							<td>{{ $requerimiento->numero }}</td>
							<td>{{ $requerimiento->cuota }}</td>
							<td>{{ date('d-m-Y', strtotime($requerimiento->fecha_cobro)) }}</td>
							<td class="text-right">Q. {{ number_format($requerimiento->pago_pendiente,2) }}</td>							
						</tr>
						@endforeach
						<tr>
							<th class="text-right" colspan="5">TOTAL</th>
							<th class="text-right">Q. <span id="total"></span></th>
						</tr>
					</tbody>
					</table>
				</div>
        	</div>
        	<div class="col-lg-6" style="border-left: 1px solid black;">
				<h2>Pago</h2>
				<div class="row">
					<div class="col-lg-6">{!! Field::select('forma_pago',$formasPago,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-6">{!! Field::text('numero_documento', null, ['data-required'=>'false']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-6">{!! Field::text('fecha_pago', null, ['data-required'=>'true', 'class'=>'fecha']) !!}</div>
					<div class="col-lg-6">{!! Field::number('monto', null, ['data-required'=>'true', 'step'=>'any', 'id'=>'monto']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						{!! Field::select('banco_id',$bancos,null,['data-required'=>'true']) !!}
						<p>
			                <input type="submit" value="Agregar" class="btn btn-primary">
			                <a href="{{ route('requerimientos_pendientes') }}" class="btn btn-danger">Cancelar</a>
			            </p>
					</div>
					<div class="col-lg-6">{!! Field::textarea('observaciones', null, ['data-required'=>'false']) !!}</div>
				</div>

	            
        	</div>
        </div>
        {!! Form::close() !!}   
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
		    todayHighlight: true,
		    orientation: 'auto top'
		});

		$('.chk').on('change', function(){
			calcularTotal();
		});
		calcularTotal();


	});

	function calcularTotal()
	{
		var total = 0;
		$('.chk').each(function(index, element){
			if ($(element).is(':checked')) {
				var id = $(this).val();
				var pagoPendiente = parseFloat($('#pago_pendiente'+id).val());
				total += pagoPendiente;
			}
		});
		$('#total').text(total.toFixed(2));
		$('#monto').val(total.toFixed(2));
	}
</script>

@stop