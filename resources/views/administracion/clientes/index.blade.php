@extends('layouts.admin')

@section('title') Listado de Clientes @stop

@section('header') Listado de Clientes @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_cliente','C') }}" class="btn btn-primary">Agregar Cliente</a>
            	<a href="{{ route('agregar_cliente','E') }}" class="btn btn-primary">Agregar Empresa</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th>CORREO</th>
							<th>DPI</th>
							<th>TIPO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($clientes as $cliente)
							<tr>
								<td>{{ $cliente->nombre }}</td>
								<td>{{ $cliente->corre }}</td>
								<td>{{ $cliente->dpi }}</td>
								<td>{{ $cliente->tipo_cliente }}</td>
								<td>
									<a href="{{route('ver_cliente',$cliente->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
									<a href="{{route('editar_cliente',$cliente->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
									<a href="{{route('contactos_clientes',$cliente->id)}}" class="btn btn-inverse btn-xs"><i class="fa fa-users"></i></a>
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