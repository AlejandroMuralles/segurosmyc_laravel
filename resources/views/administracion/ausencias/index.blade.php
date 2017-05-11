@extends('layouts.admin')

@section('title') Listado de Ausencias @stop

@section('header') Listado de Ausencias @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<a href="{{ route('agregar_ausencia') }}" class="btn btn-primary">Agregar Ausencia</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th class="text-center">DESCRIPCION</th>
							<th class="text-center">AFECTA SALARIO</th>
							<th class="text-center">INCLUYE SEPTIMO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($ausencias as $ausencia)
							<tr>
								<td class="text-center">{{ $ausencia->descripcion }}</td>
								<td class="text-center">
									@if(is_null($ausencia->afecta_salario))
										<i class="fa fa-times square bg-red text-white"></i>
									@else
										<i class="fa fa-check square bg-success text-white"></i>
									@endif
								</td>
								<td class="text-center">
									@if(is_null($ausencia->incluye_septimo))
										<i class="fa fa-times square bg-red text-white"></i>
									@else
										<i class="fa fa-check square bg-success text-white"></i>
									@endif
								</td>
								<td>
									<a href="{{route('editar_ausencia',$ausencia->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
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
		    "bSort" : true,
		    "iDisplayLength" : 20,
		    "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Todos"]],
		   	"aaSorting" : [[0, 'asc']]
		});
	});
</script>
@stop