@extends('layouts.admin')

@section('title') Solicitud de Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('header') Solicitud de Exclusión {{$polizaExclusion->numero_solicitud}} @stop

@section('css')
<link href="{{ asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_exclusion_vehiculo',$polizaExclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('numero_solicitud', $polizaExclusion->numero_solicitud, ['disabled']) !!} 
				</div>
				<div class="col-lg-3">{!! Field::text('estado', $polizaExclusion->descripcion_estado, ['disabled']) !!} </div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('fecha_solicitud', date('d-m-Y', strtotime($polizaExclusion->fecha_solicitud)), ['disabled']) !!} 
				</div>
				@if(!is_null($polizaExclusion->fecha_aprobada))
				<div class="col-lg-3">
					{!! Field::text('fecha_aprobada', date('d-m-Y', strtotime($polizaExclusion->fecha_aprobada)), ['disabled']) !!} 
				</div>
				@endif
				@if(!is_null($polizaExclusion->fecha_rechazada))
				<div class="col-lg-3">
					{!! Field::text('fecha_rechazada', date('d-m-Y', strtotime($polizaExclusion->fecha_rechazada)), ['disabled']) !!} 
				</div>
				@endif
			</div>
			{!! Form::close() !!}
						
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
									<td>{{$vehiculo->vehiculo->placa}}</td>
									<td>
										<a href="{{route('ver_vehiculo',$vehiculo->vehiculo->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
										@if($vehiculo->estado == 'SE')
										<a onclick="eliminarVehiculo(event, {{$vehiculo->id}},'{{$vehiculo->numero_certificado}}','{{$vehiculo->vehiculo->placa}}')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<h4 class="sub-title">COBERTURAS</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>ESTADO</th>
									<th>NOMBRE</th>
									<th>SUMA ASEGURADA</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($coberturas as $cobertura)
								<tr>
									<td>{{$cobertura->descripcion_estado}}</td>
									<td>{{$cobertura->cobertura->nombre}}</td>
									<td>{{$cobertura->suma_asegurada}}</td>
									<td>
										@if($cobertura->estado == 'SE')
										<a onclick="eliminarCobertura(event, {{$cobertura->id}},'{{$cobertura->cobertura->nombre}}')" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<h4 class="sub-title">COBERTURAS PARTICULARES</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
									<th>ESTADO</th>
									<th>NOMBRE</th>
									<th>SUMA ASEGURADA</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($coberturasParticulares as $coberturaParticular)
								<tr>
									<td>{{$coberturaParticular->descripcion_estado}}</td>
									<td>{{$coberturaParticular->vehiculo->placa}}</td>
									<td>{{$coberturaParticular->cobertura->nombre}}</td>
									<td>Q. {{number_format($coberturaParticular->suma_asegurada,2)}}</td>
									<td></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<a href="{{route('ver_poliza',$polizaExclusion->poliza_id)}}#exclusiones" class="btn btn-danger">Regresar</a>
		</div>
	</div>
</div>

<div id="custom-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Eliminar Cobertura</h4>
    {!! Form::open(['route' => array('eliminar_poliza_exclusion_cobertura', $polizaExclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
    <input type="hidden" value="0" id="coberturaEliminarId" name="cobertura_id">
    <div class="custom-modal-text" id="text-eliminar-cobertura">
    	
    </div>
    <hr>
    <div class="modal-footer">
    	<button type="submit" class="btn btn-danger">Eliminar</button>
    	<button type="button" class="btn btn-primary" onclick="Custombox.close()">Cerrar</button>
    </div>
    {!! Form::close() !!}
</div>

<div id="eliminar-vehiculo-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Close</span>
    </button>
    <h4 class="custom-modal-title">Eliminar Vehículo</h4>
    {!! Form::open(['route' => array('eliminar_poliza_exclusion_vehiculo', $polizaExclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
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
	function eliminarCobertura(e, id, nombre)
	{
		$('#coberturaEliminarId').val(id);
		$('#text-eliminar-cobertura').html('¿Desea eliminar la cobertura ' + nombre + ' de la exclusión?');
        Custombox.open({
            target: '#custom-modal',
            effect: 'newspaper'
        });
        e.preventDefault();
	}

	function eliminarVehiculo(e, id, certificado, placa)
	{
		$('#vehiculoEliminarId').val(id);
		$('#text-eliminar-vehiculo').html('¿Desea eliminar el vehiculo con certificado ' + certificado + ' y placa ' + placa +' de la exclusión?');
        Custombox.open({
            target: '#eliminar-vehiculo-modal',
            effect: 'fadein'
        });
        e.preventDefault();
	}
</script>

@stop