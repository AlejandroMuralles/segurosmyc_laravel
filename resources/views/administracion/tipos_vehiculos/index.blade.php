@extends('layouts.admin')

@section('title') Listado de Tipos de Vehiculos @stop

@section('header') Listado de Tipos de Vehiculos @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_tipo_vehiculo') }}" class="btn btn-primary">Agregar Tipo de Vehiculo</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($tipos as $tipo)
							<tr>
								<td>{{ $tipo->nombre }}</td>
								<td>
									<a href="{{route('editar_tipo_vehiculo',$tipo->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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