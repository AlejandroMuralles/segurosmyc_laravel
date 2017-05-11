@extends('layouts.admin')

@section('title') Solicitud de Modificación {{$polizaModificacion->numero_solicitud}} @stop

@section('header') Solicitud de Modificación {{$polizaModificacion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            @if($polizaModificacion->estado == 'S')
            <div class="row">
            	<div class="col-lg-3">            		
					<a href="{{route('aprobar_poliza_modificacion',$polizaModificacion->id)}}" class="btn btn-primary  fa fa-check">Aprobar</a>					
            	</div>
            </div>
            <br/>
            @endif
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('numero_solicitud', $polizaModificacion->numero_solicitud, ['disabled']) !!} 
				</div>
				<div class="col-lg-3">{!! Field::text('estado', $polizaModificacion->descripcion_estado, ['disabled']) !!} </div>
			</div>
			<div class="row">
				<div class="col-lg-3">
					{!! Field::text('fecha_solicitud', date('d-m-Y', strtotime($polizaModificacion->fecha_solicitud)), ['disabled']) !!} 
				</div>
				@if(!is_null($polizaModificacion->fecha_aprobada))
				<div class="col-lg-3">
					{!! Field::text('fecha_aprobada', date('d-m-Y', strtotime($polizaModificacion->fecha_aprobada)), ['disabled']) !!} 
				</div>
				@endif
				@if(!is_null($polizaModificacion->fecha_rechazada))
				<div class="col-lg-3">
					{!! Field::text('fecha_rechazada', date('d-m-Y', strtotime($polizaModificacion->fecha_rechazada)), ['disabled']) !!} 
				</div>
				@endif
			</div>

			<div class="row">
				<div class="col-lg-9">
					<h4 class="sub-title">CAMBIOS A REALIZAR</h4>
					<div class="table-responsive">
						<table class="table table-responsive">
							<thead>
								<tr>
								 	<th>TIPO</th>
									<th>SOLICITANTE</th>
									<th>CAMBIO</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($cambios as $cambio)
								<tr>
									<td>{{$cambio->tipo_poliza_modificacion->descripcion}}</td>
									<td>{{$cambio->descripcion_solicitante}}</td>
									<td>{{$cambio->cambio}}</td>
									<td>
										@if($polizaModificacion->estado == 'S')
										<a href="{{route('editar_poliza_modificacion_detalle',$cambio->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a>
										@endif
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<a href="{{route('ver_poliza',$polizaModificacion->poliza_id)}}#modificaciones" class="btn btn-danger">Regresar</a>
		</div>
	</div>
</div>
@stop