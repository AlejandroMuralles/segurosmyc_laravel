@extends('layouts.admin')

@section('title') Ver Solicitud de Póliza {{$poliza->numero_solicitud}}@stop

@section('header') Ver Solicitud de Póliza {{$poliza->numero_solicitud}}@stop

@section('css')
<link href="{{ asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs navtab-custom">
            <li class="active">
                <a href="#solicitud" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Solicitud</span>
                </a>
            </li>
            <li class="">
                <a href="#requerimientos" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Requerimientos</span>
                </a>
            </li>
            <li class="">
                <a href="#observaciones" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Observaciones</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="solicitud">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				        	<div class="row">
				        		<div class="col-lg-12">
				        			<a href="{{route('aprobar_solicitud_poliza',$poliza->id)}}" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Aprobar"><i class="fa fa-check"></i></a>
				        			<a href="{{route('editar_poliza',$poliza->id)}}" class="btn btn-warning">Editar</a>
				        			@if(is_null($poliza->poliza_anterior_id))
				        			<a href="{{route('polizas_reporte_solicitud',$poliza->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Solicitud">
				        				<img src="{{asset('assets/iconos/pdf.png')}}" width="48px" >
				        			</a>
				        			<a href="{{route('polizas_reporte_solicitud_cliente_vehiculo',$poliza->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Solicitud 2">
				        				<img src="{{asset('assets/iconos/pdf.png')}}" width="48px" >
				        			</a>
				        			@else
									<a href="{{route('polizas_reporte_renovacion',$poliza->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Solicitud Renovación">
				        				<img src="{{asset('assets/iconos/pdf.png')}}" width="48px" >
				        			</a>
				        			@endif
				        			<a href="{{route('agregar_planilla_poliza',$poliza->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Planilla">
				        				<img src="{{asset('assets/iconos/pdf.png')}}" width="48px" >
				        			</a>
				        		</div>
				        	</div>
				        	<br/>
							<div class="row">
								<div class="col-lg-4">{!! Field::text('numero_solicitud', $poliza->id, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('aseguradora', $poliza->aseguradora->nombre, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('cliente', $poliza->cliente->nombre, ['disabled']) !!}</div>
							</div>
							<div class="row">
								<div class="col-lg-4">{!! Field::text('fecha_inicio', date('d-m-Y', strtotime($poliza->fecha_inicio)), ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('fecha_fin', date('d-m-Y', strtotime($poliza->fecha_fin)), ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('dirigida_a', $poliza->dirigida_a, ['disabled']) !!}</div>
							</div>
							<div class="row">
								<div class="col-lg-4">{!! Field::text('dueno', $poliza->dueno->nombre_completo, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('ejecutivo', $poliza->ejecutivo->nombre_completo, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('ramo', $poliza->ramo->nombre, ['disabled']) !!}</div>
							</div>
							<div class="row">
								<h3>% Impuestos</h3>
							</div>
							<div class="row">
								<div class="col-lg-4">{!! Field::text('iva', $poliza->pct_iva*100, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('emision', $poliza->pct_emision*100, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('fraccionamiento', $poliza->pct_fraccionamiento*100, ['disabled']) !!}</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="requerimientos">
            	<div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				        	@if($poliza->estado == 'S')
				        	<a href="{{route('agregar_poliza_requerimiento',$poliza->id)}}" class="btn btn-primary">Agregar Requerimiento</a>
				        	<a href="{{route('agregar_pago_requerimiento',$poliza->id)}}" class="btn btn-success">Pagos de Requerimientos</a>
				        	<br/><br/>
				        	@endif
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th class="text-center">ESTADO</th>
											<th class="text-center">REQUERIMIENTO</th>
											<th class="text-center">FECHA COBRO</th>
											<th class="text-center">FECHA PAGO</th>
											<th class="text-center">DOCTO.</th>
											<th class="text-center">PRIMA NETA</th>
											<th class="text-center">%EMI</th>
											<th class="text-center">%FRAC</th>
											<th class="text-center">%IVA</th>
											<th class="text-center">PRIMA TOTAL</th>
											<th class="text-center">INCLUSIÓN</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$totalPrimaNeta = 0; 
											$totalPrimaTotal = 0; 
										?>
										@foreach($requerimientos as $requerimiento)
											<?php 
												$totalPrimaNeta += $requerimiento->prima_neta; 
												$totalPrimaTotal += $requerimiento->prima_total; 
												$pagos = $requerimiento->pagos;
											?>	
											<tr>
												<td class="text-center">
													@if($requerimiento->estado == 'N')
														<span class="label label-danger">{{ $requerimiento->descripcion_estado }}</span>
													@elseif($requerimiento->estado == 'C')
														<span class="label label-success">{{ $requerimiento->descripcion_estado }}</span>
													@else
														<span class="label label-dark">{{ $requerimiento->descripcion_estado }}</span>
													@endif
												</td>
												<td class="text-center">{{ $requerimiento->numero }}</td>
												<td class="text-center">{{ date('d-m-Y', strtotime($requerimiento->fecha_cobro)) }}</td>
												<td class="text-center">
													@foreach($pagos as $pago)
														{{date('d-m-Y', strtotime($pago->pago->fecha_pago))}}
            											<br/>
													@endforeach
												</td>
												<td class="text-right">
													@foreach($pagos as $pago)
														{{$pago->pago->numero_documento}}
            											<br/>
													@endforeach
												</td>
												<td class="text-right">Q. {{ number_format($requerimiento->prima_neta,2) }}</td>
												<td class="text-right">Q. {{ number_format($requerimiento->emision,2) }}</td>
												<td class="text-right">Q. {{ number_format($requerimiento->fraccionamiento,2) }}</td>
												<td class="text-right">Q. {{ number_format($requerimiento->iva,2) }}</td>
												<td class="text-right">Q. {{ number_format($requerimiento->prima_total,2) }}</td>
												<td class="text-center">{{ $requerimiento->numero_inclusion }}</td>
												<td>
													@if($requerimiento->estado == 'N')
													<a href="{{route('editar_poliza_requerimiento',$requerimiento->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a>

													<a onclick="anularRequerimiento(event, {{$requerimiento->id}}, {{$requerimiento->numero}},'{{number_format($requerimiento->prima_total,2)}}')" class="btn btn-info btn-xs fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Anular"></a>

													<a onclick="eliminarRequerimiento(event, {{$requerimiento->id}}, {{$requerimiento->numero}},'{{number_format($requerimiento->prima_total,2)}}')" class="btn btn-danger btn-xs fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar"></a>

													@endif
												</td>
											</tr>
										@endforeach
											<tr>
												<td style="font-weight: bold"></td>
												<td style="font-weight: bold"></td>
												<td style="font-weight: bold"></td>
												<td style="font-weight: bold; text-align: right;">Q. {{ number_format($totalPrimaNeta,2) }}</td>
												<td></td>
												<td></td>
												<td></td>
												<td style="font-weight: bold; text-align: right;">Q. {{ number_format($totalPrimaTotal,2) }}</td>
											</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="observaciones">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				        	<a href="{{route('agregar_bitacora_poliza',$poliza->id)}}" class="btn btn-primary">Agregar Observación</a>
				        	<br/><br/>
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>OBSERVACION</th>
											<th width="150px">FECHA</th>
											<th width="150px">USUARIO</th>
										</tr>
									</thead>
									<tbody>
										@foreach($observaciones as $observacion)	
											<tr>
												<td>{{ $observacion->observaciones }}</td>
												<td>{{ date('d-m-Y H:i', strtotime($observacion->created_at)) }}</td>
												<td>{{ $observacion->created_by }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script src="{{ asset('assets/plugins/custombox/dist/custombox.min.js') }}"></script>
<script src="{{ asset('assets/plugins/custombox/dist/legacy.min.js') }}"></script>
<script src="{{asset('assets/js/detect.js')}}"></script>
<script src="{{asset('assets/js/fastclick.js')}}"></script>
<script>
	
	var hash = document.location.hash;
	var prefix = "tab_";
	if (hash) {
	    $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
	} 

	$('a[data-toggle=tab]').on('click', function(e){
		window.location.hash = $(this).attr('href');
	});

</script>

@stop