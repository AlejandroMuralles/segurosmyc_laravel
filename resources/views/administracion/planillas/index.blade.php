@extends('layouts.admin')

@section('title') Listado de Planillas @stop

@section('header') Listado de Planillas @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

			{!! Field::select('aseguradora_id',$aseguradoras,$aseguradoraId,['id'=>'aseguradoraId']) !!}

            <div class="table-responsive">
            	<a href="{{ route('agregar_planilla',[$aseguradoraId]) }}" class="btn btn-primary">Agregar Planilla</a>
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							
							<th>FECHA</th>
							<th>TIPO</th>
							<th>ASEGURADORA</th>
							<th>POLIZA</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($planillas as $planilla)
							<tr>
								<td>{{ date('Y-m-d', strtotime($planilla->fecha)) }}</td>
								<td>{{ $planilla->descripcion_tipo }}</td>
								<td>{{ $planilla->aseguradora->nombre }}</td>
								<td>
									@if($planilla->tipo == 2)
										{{ $planilla->poliza->numero_solicitud }}
									@endif
								</td>
								<td>
									<a href="{{route('ver_planilla',$planilla->id)}}" class="btn btn-warning btn-xs fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"></a>
									<a href="{{route('buscar_requerimientos_planilla',$planilla->id)}}" class="btn btn-primary btn-xs fa fa-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar Requerimientos"></a>
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


   		$('#aseguradoraId').on('change',function(){
   			if($(this).val() == '')
   				window.location.href = "{{route('inicio')}}/Planillas/listado/0";
   			else
   				window.location.href = "{{route('inicio')}}/Planillas/listado/" + $(this).val();
   		})

	});
</script>
@stop