@extends('layouts.admin')

@section('title') Listado de Pólizas @stop

@section('header') Listado de Pólizas @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<a href="{{ route('agregar_solicitud_poliza') }}" class="btn btn-primary ">Agregar Solicitud de Póliza</a>
            <div class="table-responsive">
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>ESTADO</th>
							<th>NUMERO</th>
							<th>NUMERO</th>
							<th>ASEGURADORA</th>
							<th>CLIENTE</th>
							<th>FECHA INICIO</th>
							<th>FECHA FIN</th>
						</tr>
					</thead>
					<tbody>
						@foreach($polizas as $poliza)
							<tr>
								<td>{{ $poliza->estado }}</td>
								<td>{{ $poliza->numero }}</td>
								<td>{{ $poliza->numero }}</td>
								<td>{{ $poliza->aseguradora->nombre }}</td>
								<td>{{ $poliza->cliente->nombre }}</td>
								<td>{{ date('d-m-Y', strtotime($poliza->fecha_inicio)) }}</td>
								<td>{{ date('d-m-Y', strtotime($poliza->fecha_fin)) }}</td>
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