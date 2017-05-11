@extends('layouts.admin')

@section('title') Listado de Coberturas por Producto  @stop

@section('header') Listado de Coberturas por Producto @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<h1 class="sub-title">Producto {{$producto->nombre}}</h1>
        	<hr>
            <div class="table-responsive">
            	<a href="{{ route('agregar_producto_coberturas',$producto->id) }}" class="btn btn-primary">Agregar Coberturas</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>COBERTURA</th>
							<th>AMPARADA</th>
							<th>SUMA ASEGURADA</th>
							<th>PCT DEDUCIBLE</th>
							<th>DEDUCIBLE MINIMO</th>
							<th></th>

						</tr>
					</thead>
					<tbody>
						@foreach($coberturas as $cobertura)
							<tr>
								<td>{{ $cobertura->cobertura->nombre }}</td>
								<td> @if($cobertura->amparada == 1) <i class="fa fa-check square bg-green text-white"></fa>  
									@else <i class="fa fa-times square bg-red text-white"></i> 
									@endif
								</td>
								<td>Q. {{ number_format($cobertura->suma_asegurada,2) }}</td>
								<td>{{ number_format($cobertura->pct_deducible,2) }}%</td>
								<td>Q. {{ number_format($cobertura->deducible_minimo,2) }}</td>
								<td> <a href="{{route('editar_producto_cobertura',$cobertura->id)}}" class="btn btn-warning btn-xs fa fa-edit"></a></td>
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
   		$('#table').DataTable({
		    "iDisplayLength" : 20,
		    "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Todos"]],
		});
	});
</script>
@stop