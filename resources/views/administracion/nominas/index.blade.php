@extends('layouts.admin')

@section('title') Listado de Nominas @stop

@section('header') Listado de Nominas @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_nomina') }}" class="btn btn-primary">Agregar Nomina</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>TIPO NOMINA</th>
							<th>FECHA INICIO</th>
							<th>FECHA FIN</th>
							<th>FECHA PAGO</th>
							<th>ESTADO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($nominas as $nomina)
							<tr>
								<td>{{ $nomina->tipo->descripcion }}</td>
								<td>{{ date('d-m-Y', strtotime($nomina->fecha_inicio)) }}</td>
								<td>{{ date('d-m-Y', strtotime($nomina->fecha_final)) }}</td>
								<td>@if(!is_null($nomina->fecha_pago)) {{ date('d-m-Y', strtotime($nomina->fecha_pago)) }} @endif</td>
								<td>{{ $nomina->descripcion_estado }}</td>
								<td>
									@if($nomina->estado == 'P')
									<a href="{{route('editar_nomina',$nomina->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
									<a href="{{route('generar_nomina',$nomina->id)}}" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i></a>
									@else
									<a href="{{route('ver_nomina',$nomina->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
									@endif
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