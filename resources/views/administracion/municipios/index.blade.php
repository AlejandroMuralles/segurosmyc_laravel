@extends('layouts.admin')

@section('title') Listado de Municipios - {{$departamento->nombre}} @stop

@section('header') Listado de Municipios - {{$departamento->nombre}} @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_municipio',$departamento->id) }}" class="btn btn-primary">Agregar Municipio</a>
            	<a href="{{ route('departamentos',$departamento->pais_id) }}" class="btn btn-danger">Regresar</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($municipios as $municipio)
							<tr>
								<td>{{ $municipio->nombre }}</td>
								<td>
									<a href="{{route('editar_municipio',$municipio->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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