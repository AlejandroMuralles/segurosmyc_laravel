@extends('layouts.admin')

@section('title') Listado de Pólizas Vencidas @stop

@section('header') Listado de Pólizas Vencidas @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<a href="{{ route('reporte_polizas_vencidas') }}" class="btn btn-primary ">Reporte Excel</a>
            <div class="table-responsive">
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NUMERO</th>
							<th>CLIENTE</th>
							<th>ASEGURADORA</th>
							<th>RAMO</th>
							<th>FECHA INICIO</th>
							<th>FECHA FIN</th>
							<th>DIAS VENCIDA</th>
						</tr>
					</thead>
					<tbody>
						@foreach($polizas as $poliza)
							<tr>
								<td>{{ $poliza->numero }}</td>
								<td>{{ $poliza->cliente->nombre }}</td>
								<td>{{ $poliza->aseguradora->nombre }}</td>
								<td>{{ $poliza->ramo->nombre }}</td>
								<td>{{ date('d-m-Y', strtotime($poliza->fecha_inicio)) }}</td>
								<td>{{ date('d-m-Y', strtotime($poliza->fecha_fin)) }}</td>
								<td>{{ $poliza->dias_renovacion }}</td>
							</tr>
						@endforeach
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
		   	"aaSorting" : [[1, 'desc']]
		});
	});
</script>
@stop