@extends('layouts.admin')

@section('title') Listado de Colaboradores @stop

@section('header') Listado de Colaboradores @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
            <div class="card-box">
                <div class="table-responsive">
                	<a href="{{ route('agregar_colaborador') }}" class="btn btn-primary">Agregar Colaborador</a>
                	<br/><br/>
                    <table id="table" class="table">
						<thead>
							<tr>
								<th>NOMBRE</th>
								<th>PUESTO</th>
								<th>AREA</th>
								<th>CONTRATADO</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($colaboradores as $colaborador)
								<tr>
									<td>{{ $colaborador->nombres }} {{ $colaborador->apellidos }} </td>
									<td>{{ $colaborador->puesto->nombre }}</td>
									<td>{{ $colaborador->puesto->area->nombre }}</td>
									<td style="text-align: center">
										@if($colaborador->contratado)
											<i class="fa fa-check"></i>
										@else
											<i class="fa fa-times"></i>
										@endif
									</td>
									<td>
										<a href="{{route('editar_colaborador',$colaborador->id)}}" class="btn btn-warning btn-xs fa fa-edit"></a>
										<a href="{{route('ver_colaborador',$colaborador->id)}}" class="btn btn-warning btn-xs fa fa-eye"></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
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