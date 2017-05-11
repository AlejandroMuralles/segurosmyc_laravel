@extends('layouts.admin')

@section('title') Listado Solicitudes de Póliza @stop

@section('header') Listado Solicitudes de Póliza @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
<link href="{{ asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<a href="{{ route('agregar_solicitud_poliza') }}" class="btn btn-primary ">Agregar Solicitud de Póliza</a>
        	<a href="{{ route('polizas_reporte_solicitudes_pendientes') }}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pólizas Pendientes" style="float: right">
        		<img src="{{ asset('assets/iconos/excel.png') }}" height="35px">
        	</a>
            <div class="table-responsive">
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>ESTADO</th>
							<th>SOLICITUD</th>
							<th>NUMERO</th>
							<th>FECHA</th>
							<th>VIGENCIA</th>
							<th>ASEGURADORA</th>
							<th>CLIENTE</th>
							<th>RAMO</th>
							<th>DIAS</th>
							<th width="100px;"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($polizas as $poliza)
							<tr class="@if($poliza->dias_desde_solicitud >= 6) bg-red text-white @endif">
								<td>{{ $poliza->descripcion_estado }}</td>
								<td>{{ $poliza->numero_solicitud }}</td>
								<td>{{ $poliza->numero }}</td>
								<td>{{ date('d-m-Y', strtotime($poliza->fecha_solicitud)) }}</td>
								<td>{{ date('d-m-Y', strtotime($poliza->fecha_inicio)) }} a {{ date('d-m-Y', strtotime($poliza->fecha_fin)) }}</td>
								<td>{{ $poliza->aseguradora->nombre }}</td>
								<td>{{ $poliza->cliente->nombre }}</td>
								<td>{{ $poliza->ramo->nombre }}</td>
								<td>{{ $poliza->dias_desde_solicitud }}</td>
								<td>
									<a href="{{route('ver_solicitud_poliza',$poliza->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><i class="fa fa-eye"></i></a>
									<a href="{{route('editar_poliza',$poliza->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
									<a href="{{route('copiar_solicitud_poliza',$poliza->id)}}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Copiar"><i class="fa fa-clone"></i></a>
									<a href="{{route('aprobar_solicitud_poliza',$poliza->id)}}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Aprobar"><i class="fa fa-check"></i></a>
									<a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar"><i class="fa fa-times" onclick="eliminarSolicitudPoliza({{$poliza->id}},'{{$poliza->numero_solicitud}}'); return false;"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div id="eliminar-solicitud-poliza-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Cerrar</span>
    </button>
    <h4 class="custom-modal-title">Eliminar Póliza <span id="numero_solicitud_titulo"></span></h4>
    {!! Form::open(['route' => array('eliminar_solicitud_poliza'), 'method' => 'DELETE', 'id' => 'eliminarPolizaForm', 'class' => 'validate-form']) !!}
    <div class="custom-modal-text">
    	<input type="hidden" value="0" id="poliza_id" name="poliza_id">
    	¿Esta seguro de eliminar la póliza <span id="numero_solicitud_texto"></span>?
    </div>

    <div class="modal-footer">
    	<button type="submit" class="btn btn-danger">Eliminar</button>
    	<button type="button" class="btn btn-primary" onclick="Custombox.close()">Cerrar</button>
    </div>
    {!! Form::close() !!}
</div>
@stop
@section('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables-bs3.js') }}"></script>
<script src="{{ asset('assets/plugins/custombox/dist/custombox.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custombox/dist/legacy.min.js') }}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script>
	$(document).ready(function() {
   		$('#table').dataTable({
		    "bSort" : false,
		    "iDisplayLength" : 20,
		    "aLengthMenu": [[20, 50, 100, -1], [20, 50, 100, "Todos"]],
		   	"aaSorting" : [[1, 'desc']]
		});
	});

	function eliminarSolicitudPoliza($id, $numeroSolicitud)
	{
		$('#numero_solicitud_texto').text($numeroSolicitud);
		$('#numero_solicitud_titulo').text($numeroSolicitud);
		$('#poliza_id').val($id);
		Custombox.open({
            target: '#eliminar-solicitud-poliza-modal',
            effect: 'newspaper'
        });
	}
</script>
@stop