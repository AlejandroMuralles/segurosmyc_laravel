@extends('layouts.admin')

@section('title') Solicitud de Inclusión {{$polizaInclusion->numero_solicitud}} @stop

@section('header') Solicitud de Inclusión {{$polizaInclusion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_inclusion_vehiculo',$polizaInclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
            @if($polizaInclusion->estado == 'S')
            <div class="row">
            	<div class="col-lg-3">            		
					<a href="{{route('aprobar_poliza_inclusion',$polizaInclusion->id)}}" class="btn btn-primary  fa fa-check">Aprobar</a>					
            	</div>
            </div>
            <br/>
            @endif
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('numero_solicitud', $polizaInclusion->numero_solicitud, ['disabled']) !!} 
				</div>
				<div class="col-lg-3">
					{!! Field::text('pct_fraccionamiento', $polizaInclusion->pct_fraccionamiento, ['disabled']) !!} 
				</div>
				<div class="col-lg-3">{!! Field::text('estado', $polizaInclusion->descripcion_estado, ['disabled']) !!} </div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('fecha_solicitud', date('d-m-Y', strtotime($polizaInclusion->fecha_solicitud)), ['disabled']) !!} 
				</div>
				@if(!is_null($polizaInclusion->fecha_aprobada))
				<div class="col-lg-3">
					{!! Field::text('fecha_aprobada', date('d-m-Y', strtotime($polizaInclusion->fecha_aprobada)), ['disabled']) !!} 
				</div>
				@endif
				@if(!is_null($polizaInclusion->fecha_rechazada))
				<div class="col-lg-3">
					{!! Field::text('fecha_rechazada', date('d-m-Y', strtotime($polizaInclusion->fecha_rechazada)), ['disabled']) !!} 
				</div>
				@endif
			</div>
			{!! Form::close() !!}

			<div class="row">
				<div class="col-lg-9">
					<h4 class="sub-title">VEHÍCULOS</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
								 	<th>ESTADO</th>
									<th>CERTIFICADO</th>
									<th>PLACA</th>
									<th>SUMA ASEGURADA</th>
									<th>BLINDAJE</th>
									<th>DEDUCIBLE</th>
									<th>PRIMA NETA</th>
									<th>ASISTENCIA</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($vehiculos as $vehiculo)
								<tr>
									<td>{{$vehiculo->descripcion_estado}}</td>
									<td>{{$vehiculo->numero_certificado}}</td>
									<td>{{$vehiculo->vehiculo->placa}}</td>
									<td>Q. {{ number_format($vehiculo->suma_asegurada,2) }}</td>
									<td>Q. {{ number_format($vehiculo->suma_asegurada_blindaje,2) }}</td>
									<td>Q. {{ number_format($vehiculo->deducible,2) }}</td>
									<td>Q. {{ number_format($vehiculo->prima_neta,2) }}</td>
									<td>Q. {{ number_format($vehiculo->asistencia,2) }}</td>
									<td><a href="{{route('ver_vehiculo',$vehiculo->vehiculo->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-9">
					<h4 class="sub-title">COBERTURAS</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
								 	<th>ESTADO</th>
									<th>NOMBRE</th>
									<th>SUMA ASEGURADA</th>
									<th>DEDUCIBLE</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($coberturas as $cobertura)
								<tr>
									<td>{{$cobertura->descripcion_estado}}</td>
									<td>{{$cobertura->cobertura->nombre}}</td>
									<td>Q. {{number_format($cobertura->suma_asegurada,2)}}</td>
									<td>Q. {{number_format($cobertura->deducible,2)}}</td>
									<td></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-9">
					<h4 class="sub-title">COBERTURAS PARTICULARES</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
								 	<th>ESTADO</th>
									<th>VEHICULO</th>
									<th>COBERTURA</th>
									<th>SUMA ASEGURADA</th>
									<th>DEDUCIBLE</th>
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
									<td>Q. {{number_format($coberturaParticular->deducible,2)}}</td>
									<td></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<a href="{{route($polizaInclusion->poliza->ruta,$polizaInclusion->poliza_id)}}#inclusiones" class="btn btn-danger">Regresar</a>
		</div>
	</div>
</div>
@stop