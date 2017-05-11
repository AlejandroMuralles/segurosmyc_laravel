@extends('layouts.admin')

@section('title') Listado de Impuestos @stop

@section('header') Listado de Impuestos @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_impuesto') }}" class="btn btn-primary">Agregar Impuesto</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th>PORCENTAJE</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($impuestos as $impuesto)
							<tr>
								<td>{{ $impuesto->nombre }}</td>
								<td>{{ $impuesto->porcentaje }}%</td>
								<td>
									<a href="{{route('editar_impuesto',$impuesto->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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