@extends('layouts.admin')

@section('title') Requerimientos no cobrados por mes @stop

@section('header') Requerimientos no cobrados por mes @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
        	<h4 class="sub-title">MESES CON COBROS PENDIENTES</h4>
            <div class="table-responsive">
                <table id="table" class="table">
					<thead>
						<tr>
							<th class="text-center">MES</th>
							<th class="text-center">REQUERIMIENTOS</th>
							<th class="text-center">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						@foreach($meses as $mes)
							<?php $total += $mes['total_no_cobrado']; ?>
							<tr>
								<td class="text-center">{{ $mes['mes'] }}</td>
								<td class="text-center">{{ $mes['requerimientos'] }}</td>
								<td class="text-right">Q. {{ number_format($mes['total_no_cobrado'],2) }}</td>
							</tr>
						@endforeach
						<tr>
							<th class="text-right" colspan="2">TOTAL</th>
							<th class="text-right">Q. {{ number_format($total,2) }}</th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
        <div class="card-box">
        	<h4 class="sub-title">PORCENTAJE CARTERA COBRADA</h4>
            <div class="table-responsive">
                <table id="table" class="table">
					<thead>
						<tr>
							<th class="text-center">TOTAL</th>
							<th class="text-center">NO COBRADOS</th>
							<th class="text-center">COBRADOS</th>
							<th class="text-center">PORCENTAJE</th>
						</tr>
					</thead>
					<tbody>						
						<tr>
							<th class="text-center">{{$totalRequerimientos}}</th>
							<th class="text-center">{{$noCobrados}}</th>
							<th class="text-center">{{$cobrados}}</th>
							<th class="text-center @if($porcentaje < 75 ) bg-red text-white @endif">{{number_format($porcentaje,2)}}%</th>
						</tr>
					</tbody>
				</table>
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

