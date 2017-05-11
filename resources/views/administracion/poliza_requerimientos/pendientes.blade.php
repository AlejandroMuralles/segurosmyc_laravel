@extends('layouts.admin')

@section('title') Listado de Requerimientos Pendientes @stop

@section('header') Listado de Requerimientos Pendientes @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
                <table id="table" class="table">
					<thead>
						<tr>
							<th class="text-center">FECHA DE COBRO</th>
							<th class="text-center">REQUERIMIENTO</th>
							<th class="text-center">POLIZA</th>
							<th class="text-center">ASEGURADORA</th>
							<th class="text-center">CLIENTE</th>
							<th class="text-center">MONTO</th>
							<th class="text-center">DIAS ATRASADO</th>
							<th class="text-center"></th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						@foreach($requerimientos as $requerimiento)
							<?php $total += $requerimiento->prima_total; ?>
							<tr class="@if($requerimiento->dias_atrasado > 30) bg-red text-white @endif">
								<td class="text-center">{{ date('d-m-Y',strtotime($requerimiento->fecha_cobro)) }}</td>
								<td class="text-center">{{ $requerimiento->numero }}</td>
								<td class="text-center"><a href="{{route('ver_poliza',$requerimiento->poliza_id)}}#requerimientos" class="btn btn-primary btn-xs">{{ $requerimiento->poliza->numero }}</a></td>
								<td class="text-center">{{ $requerimiento->poliza->aseguradora->nombre }}</td>
								<td class="text-center">{{ $requerimiento->poliza->cliente->nombre }}</td>
								<td class="text-right">Q. {{ number_format($requerimiento->prima_total,2) }}</td>
								<td class="text-center">{{ $requerimiento->dias_atrasado }}</td>
								<td class="text-center"><a href="{{route('agregar_pago_requerimiento',$requerimiento->poliza_id)}}" class="btn btn-warning btn-xs fa fa-money" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pagar"></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<hr>
				<h2>Total: Q. {{ number_format($total,2)}}</h2>
			</div>
		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables-bs3.js') }}"></script>
<script>
	$(document).ready(function() {
   		$('#table').dataTable({
		    "bSort" : false,
		    "iDisplayLength" : 20,
		    "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Todos"]],
		   	"aaSorting" : [[0, 'desc']]
		});
	});
</script>
@stop
