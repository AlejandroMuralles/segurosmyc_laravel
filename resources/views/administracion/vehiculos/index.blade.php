@extends('layouts.admin')

@section('title') Listado de Vehiculos @stop

@section('header') Listado de Vehiculos @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_vehiculo') }}" class="btn btn-primary">Agregar Vehiculo</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>TIPO PLACA</th>
							<th>PLACA</th>
							<th>TIPO VEHÍCULO</th>
							<th>MARCA</th>
							<th>MODELO</th>
							<th>LINEA</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($vehiculos as $vehiculo)
							<tr>
								<td>{{ $vehiculo->tipo_placa }}</td>
								<td>{{ $vehiculo->placa }}</td>
								<td>{{ $vehiculo->tipoVehiculo->nombre }}</td>
								<td>{{ $vehiculo->marca->nombre }}</td>
								<td>{{ $vehiculo->modelo }}</td>
								<td>{{ $vehiculo->linea }}</td>
								<td>
									<a href="{{route('editar_vehiculo',$vehiculo->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
								</td>
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