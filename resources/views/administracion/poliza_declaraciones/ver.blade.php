@extends('layouts.admin')

@section('title') Declaración {{$polizaDeclaracion->numero_solicitud}} @stop

@section('header') Declaración {{$polizaDeclaracion->numero_solicitud}} @stop

@section('css')
<link href="{{ asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<div class="row">
        		<div class="col-lg-12">
        			@if($polizaDeclaracion->estado == 'S')
						<a href="{{route('aprobar_poliza_declaracion',$polizaDeclaracion->id)}}" class="btn btn-primary fa fa-check" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Aprobar"></a>
						<a href="{{route('agregar_poliza_declaracion_vehiculo',$polizaDeclaracion->id)}}" class="btn btn-primary fa fa-plus" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar Vehiculo"> <i class="fa fa-car"></i></a>
					@endif
        		</div>
        	</div>
        	<br>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('numero_solicitud', $polizaDeclaracion->numero_solicitud, ['disabled']) !!} 
				</div>
				<div class="col-lg-3">{!! Field::text('estado', $polizaDeclaracion->descripcion_estado, ['disabled']) !!} </div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('fecha_solicitud', date('d-m-Y', strtotime($polizaDeclaracion->fecha_solicitud)), ['disabled']) !!} 
				</div>
				@if(!is_null($polizaDeclaracion->fecha_aprobada))
				<div class="col-lg-3">
					{!! Field::text('fecha_aprobada', date('d-m-Y', strtotime($polizaDeclaracion->fecha_aprobada)), ['disabled']) !!} 
				</div>
				@endif
				@if(!is_null($polizaDeclaracion->fecha_rechazada))
				<div class="col-lg-3">
					{!! Field::text('fecha_rechazada', date('d-m-Y', strtotime($polizaDeclaracion->fecha_rechazada)), ['disabled']) !!} 
				</div>
				@endif
			</div>
						
			<div class="row">
				<div class="col-lg-6">
					<h4 class="sub-title">VEHICULOS</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>ESTADO</th>
									<th>CERTIFICADO</th>
									<th>PLACA</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($vehiculos as $vehiculo)
								<tr>
									<td>{{$vehiculo->descripcion_estado}}</td>
									<td>{{$vehiculo->numero_certificado}}</td>
									<td>{{$vehiculo->polizaVehiculo->vehiculo->placa}}</td>
									<td>
										<a href="{{route('ver_vehiculo',$vehiculo->polizaVehiculo->vehiculo->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
										@if($polizaDeclaracion->estado == 'S')
										<a onclick="eliminarVehiculo(event, {{$vehiculo->id}},'{{$vehiculo->numero_certificado}}','{{$vehiculo->polizaVehiculo->vehiculo->placa}}')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<a href="{{route('ver_poliza_declarativa',$polizaDeclaracion->poliza_id)}}#declaraciones" class="btn btn-danger">Regresar</a>
		</div>
	</div>
</div>

<div id="eliminar-vehiculo-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Eliminar Vehículo</h4>
    {!! Form::open(['route' => array('eliminar_poliza_declaracion_vehiculo'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
    <input type="hidden" value="0" id="vehiculoEliminarId" name="vehiculo_id">
    <div class="custom-modal-text" id="text-eliminar-vehiculo">
    	
    </div>
    <hr>
    <div class="modal-footer">
    	<button type="submit" class="btn btn-danger">Eliminar</button>
    	<button type="button" class="btn btn-primary" onclick="Custombox.close()">Cerrar</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

@section('js')
<script src="{{ asset('assets/plugins/custombox/dist/custombox.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custombox/dist/legacy.min.js') }}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script>

	function eliminarVehiculo(e, id, certificado, placa)
	{
		$('#vehiculoEliminarId').val(id);
		$('#text-eliminar-vehiculo').html('¿Desea eliminar el vehiculo con certificado ' + certificado + ' y placa ' + placa +' de la declaración?');
        Custombox.open({
            target: '#eliminar-vehiculo-modal',
            effect: 'fadein'
        });
        e.preventDefault();
	}
</script>

@stop