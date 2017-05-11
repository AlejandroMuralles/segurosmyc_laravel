@extends('layouts.admin')

@section('title') Listado de Ingresos de Salario @stop

@section('header') Listado de Ingresos de Salario @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
<style>
	td,tr,th{
		text-align: center;
	}
</style>
@stop



@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_ingreso_salario') }}" class="btn btn-primary">Agregar Ingreso de Salario</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>DESCRIPCION</th>
							<th>APLICA IGSS</th>
							<th>APLICA ISR</th>
							<th>APLICA BONO 14</th>
							<th>APLICA AGUINALDO</th>
							<th>APLICA VACACIONES</th>
							<th>APLICA LIQUIDACION</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($ingresos as $ingreso)
							<tr>
								<td>{{ $ingreso->descripcion }}</td>
								<td>
									@if(is_null($ingreso->aplica_igss))
										<i class="fa fa-times square bg-red text-white"></i>										
									@else
										<i class="fa fa-check square bg-green text-white"></i>
									@endif
								</td>
								<td>
									@if(is_null($ingreso->aplica_isr))
										<i class="fa fa-times square bg-red text-white"></i>										
									@else
										<i class="fa fa-check square bg-green text-white"></i>
									@endif
								</td>
								<td>
									@if(is_null($ingreso->aplica_bono14))
										<i class="fa fa-times square bg-red text-white"></i>										
									@else
										<i class="fa fa-check square bg-green text-white"></i>
									@endif
								</td>
								<td>
									@if(is_null($ingreso->aplica_aguinaldo))
										<i class="fa fa-times square bg-red text-white"></i>										
									@else
										<i class="fa fa-check square bg-green text-white"></i>
									@endif
								</td>
								<td>
									@if(is_null($ingreso->aplica_vacaciones))
										<i class="fa fa-times square bg-red text-white"></i>										
									@else
										<i class="fa fa-check square bg-green text-white"></i>
									@endif
								</td>
								<td>
									@if(is_null($ingreso->aplica_liquidacion))
										<i class="fa fa-times square bg-red text-white"></i>
									@else
										<i class="fa fa-check square bg-green text-white"></i>
									@endif
								</td>
								<td>
									<a href="{{route('editar_ingreso_salario',$ingreso->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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