@extends('layouts.admin')

@section('title') Listado de Contactos - {{$cliente->nombre}} @stop

@section('header') Listado de Contactos - {{$cliente->nombre}} @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_contacto_cliente', $cliente->id) }}" class="btn btn-primary">Agregar Contacto</a>
            	<a href="{{ route('clientes') }}" class="btn btn-danger">Clientes</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>NOMBRE</th>
							<th>TELEFONOS</th>
							<th>CELULAR</th>
							<th>EMPRESA DE TELEFONO</th>
							<th>CORREO</th>
							<th>FECHA NACIMIENTO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($contactos as $contacto)
							<tr>
								<td>{{ $contacto->nombre }}</td>
								<td>{{ $contacto->telefonos }}</td>
								<td>{{ $contacto->celular }}</td>
								<td>{{ $contacto->empresa_celular }}</td>
								<td>{{ $contacto->correo }}</td>
								<td>{{ date('d-m-Y', strtotime($contacto->fecha_nacimiento)) }}</td>
								<td>
									<a href="{{route('editar_contacto_cliente',$contacto->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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