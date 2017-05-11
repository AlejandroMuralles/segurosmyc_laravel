@extends('layouts.admin')

@section('title') Listado de Aseguradoras @stop

@section('header') Listado de Aseguradoras @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_aseguradora') }}" class="btn btn-primary">Agregar Aseguradora</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th>NIT</th>
							<th>CODIGO AGENTE</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($aseguradoras as $aseguradora)
							<tr>
								<td>{{ $aseguradora->nombre }}</td>
								<td>{{ $aseguradora->nit }}</td>
								<td>{{ $aseguradora->codigo_agente }}</td>
								<td>
									<a href="{{route('ver_aseguradora',$aseguradora->id)}}" class="btn btn-warning btn-xs fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"></a>
									<a href="{{route('editar_aseguradora',$aseguradora->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a>
									<a href="{{route('contactos_aseguradoras',$aseguradora->id)}}" class="btn btn-inverse btn-xs fa fa-users" data-toggle="tooltip" data-placement="top" title="" data-original-title="Contactos"></a>
									<a href="{{route('porcentajes_fraccionamientos_aseguradoras',$aseguradora->id)}}" class="btn btn-warning btn-xs">% Fraccionamiento</a>
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