@extends('layouts.admin')

@section('title') Ver Póliza Declarativa @stop

@section('header') Ver Póliza Declarativa @stop

@section('css')
<link href="{{ asset('assets/plugins/custombox/dist/custombox.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs navtab-custom">
            <li class="active">
                <a href="#poliza" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Póliza</span>
                </a>
            </li>
            <li class="">
                <a href="#vehiculos" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-car"></i></span>
                    <span class="hidden-xs">Vehiculos</span>
                </a>
            </li>
            <li class="">
                <a href="#coberturas" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-list"></i></span>
                    <span class="hidden-xs">Coberturas</span>
                </a>
            </li>
            <li class="">
                <a href="#requerimientos" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Requerimientos</span>
                </a>
            </li>
            <li class="">
                <a href="#declaraciones" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Declaraciones</span>
                </a>
            </li>
             <li class="">
                <a href="#inclusiones" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Inclusiones</span>
                </a>
            </li>
            <li class="">
                <a href="#exclusiones" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Exclusiones</span>
                </a>
            </li>
            <li class="">
                <a href="#notas" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Notas de Crédito</span>
                </a>
            </li>
            <li class="">
                <a href="#modificaciones" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-refresh"></i></span>
                    <span class="hidden-xs">Modificaciones</span>
                </a>
            </li>
            <li class="">
                <a href="#reclamos" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-refresh"></i></span>
                    <span class="hidden-xs">Reclamos</span>
                </a>
            </li>
            <li class="">
                <a href="#observaciones" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-edit"></i></span>
                    <span class="hidden-xs">Observaciones</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="poliza">
                <div class="row">
				    <div class="col-lg-12">
				    	<a href="{{route('editar_poliza',$poliza->id)}}" class="btn btn-warning">Editar</a>
						@if($poliza->estado == 'V')
							<a href="{{route('renovar_poliza',$poliza->id)}}" class="btn btn-primary">Renovar</a>
				        	<a onclick="anularPoliza(); return false;" class="btn btn-danger">Anular</a>
				        	<br/><br/>
				        @endif
				        <div class="card-box">
							<div class="row">
								<div class="col-lg-3">{!! Field::text('numero_solicitud', $poliza->id, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('numero_poliza', $poliza->numero, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('aseguradora', $poliza->aseguradora->nombre, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('cliente', $poliza->cliente->nombre, ['disabled']) !!}</div>
							</div>
							<div class="row">
								<div class="col-lg-4">{!! Field::text('fecha_inicio', date('d-m-Y', strtotime($poliza->fecha_inicio)), ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('fecha_fin', date('d-m-Y', strtotime($poliza->fecha_fin)), ['disabled']) !!}</div>
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
							<div class="row">
								<div class="col-lg-12">
									<h3>Siniestralidad</h3>
									<div class="col-lg-4">
									{!! Field::text('total_reclamos', number_format($totalReclamos,2), ['disabled']) !!}
									</div>
									<div class="col-lg-4">
									{!! Field::text('total_cobrado_requerimientos', number_format($totalCobradoRequerimientos,2), ['disabled']) !!}
									</div>
									<div class="col-lg-4">
									{!! Field::text('siniestralidad', number_format($siniestralidad,2).'%', ['disabled']) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="vehiculos">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th class="text-center">ESTADO</th>
											<th class="text-center">CERTIFICADO</th>
											<th class="text-center">PLACA</th>
											<th class="text-center">S. ASEG.</th>
											<th class="text-center">BLINDAJE</th>
											<th class="text-center">DEDUCIBLE</th>
											<th class="text-center">PRIMA NETA</th>
											<th class="text-center">%EMISION</th>
											<th class="text-center">ASIST.</th>
											<th class="text-center">%IVA</th>
											<th class="text-center">PRIMA TOTAL</th>
											<th class="text-center">DECLARAR</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$totalPrimaNeta = 0; 
											$totalPrimaTotal = 0; 
										?>
										@foreach($vehiculos as $vehiculo)
											<?php 
												$totalPrimaNeta += $vehiculo->prima_neta; 
												$totalPrimaTotal += $vehiculo->prima_total; 
											?>	
											<tr>
												<td class="text-center">{{ $vehiculo->descripcion_estado }}</td>
												<td class="text-center">{{ $vehiculo->numero_certificado }}</td>
												<td class="text-center">{{ $vehiculo->vehiculo->placa }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->suma_asegurada,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->suma_asegurada_blindaje,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->deducible,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->prima_neta,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->emision,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->asistencia,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->iva,2) }}</td>
												<td class="text-right">Q. {{ number_format($vehiculo->prima_total,2) }}</td>
												<td class="text-center">
													@if($vehiculo->activo_declaracion == 'S')
														SI
													@else
														NO
													@endif
												</td>
												<td>
													<a href="{{route('ver_poliza_vehiculo',$vehiculo->id)}}" class="btn btn-warning btn-xs fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"></a>
													<a href="{{route('editar_poliza_vehiculo',$vehiculo->id)}}" class="btn btn-primary btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a>
													<a href="{{route('editar_certificado_poliza_vehiculo',$vehiculo->id)}}" class="btn btn-info btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar Certificado"></a>
													@if($vehiculo->estado == 'V')
														@if($vehiculo->activo_declaracion == 'S')
															<a href="{{route('poliza_vehiculo_cambiar_estado_declaracion',[$vehiculo->id,'N'])}}" class="btn btn-danger btn-xs fa fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="No Declarar"></a>
														@else
															<a href="{{route('poliza_vehiculo_cambiar_estado_declaracion',[$vehiculo->id,'S'])}}" class="btn btn-success btn-xs fa fa-check" data-toggle="tooltip" data-placement="top" title="" data-original-title="Declarar"></a>
														@endif
													@endif
												</td>
											</tr>
										@endforeach
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right bold">Q. {{ number_format($totalPrimaNeta,2) }}</td>
												<td></td>
												<td></td>
												<td></td>
												<td class="text-right bold">Q. {{ number_format($totalPrimaTotal,2) }}</td>
												<td></td>
											</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="coberturas">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th class="text-center">ESTADO</th>
											<th class="text-center">COBERTURA</th>
											<th class="text-center">SUMA ASEGURADA</th>
											<th class="text-center">DEDUCIBLE</th>
											<th class="text-center">INCLUSION</th>
											<th class="text-center">EXCLUSION</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($coberturas as $cobertura)
											<tr>
												<td class="text-center">{{ $cobertura->descripcion_estado }}</td>
												<td class="text-center">{{ $cobertura->cobertura->nombre }}</td>
												<td class="text-right">Q. {{ number_format($cobertura->suma_asegurada,2) }}</td>
												<td class="text-right">Q. {{ number_format($cobertura->deducible,2) }}</td>
												<td class="text-center" class="text-center">{{ $cobertura->numero_inclusion }} </td>
												<td class="text-center" class="text-center">{{ $cobertura->numero_exclusion }} </td>
												<td></td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="requerimientos">
            	<div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				        	@if($poliza->estado == 'V')
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
											<th class="text-center">%IVA</th>
											<th class="text-center">PRIMA TOTAL</th>
											<th class="text-center">DECLARACION</th>
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
												<td class="text-right">Q. {{ number_format($requerimiento->iva,2) }}</td>
												<td class="text-right">Q. {{ number_format($requerimiento->prima_total,2) }}</td>
												<td class="text-center">{{ $requerimiento->numero_declaracion }}</td>
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
												<td style="font-weight: bold"></td>	
												<td style="font-weight: bold; text-align: right;">Q. {{ number_format($totalPrimaNeta,2) }}</td>
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
            <div class="tab-pane" id="declaraciones">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
					        @if($poliza->estado == 'V')
					        	{!! Form::open(['route' => array('generar_poliza_declaracion',$poliza->id), 'method' => 'POST', 'id' => 'agregarDeclaracionForm', 'class' => 'validate-form']) !!}
					        	<input type="submit" value="Generar Solicitud de Declaracion" class="btn btn-primary">
					        	{!! Form::close() !!}
					        	<br/><br/>
					        @endif
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>SOLICITUD</th>
											<th>FECHA SOLICITUD</th>
											<th>FECHA APROBADA</th>
											<th>ENDOSO</th>
											<th>ESTADO</th>
										</tr>
									</thead>
									<tbody>
										@foreach($declaraciones as $d)	
											<tr>
												<td>{{ $d->numero_solicitud }}</td>
												<td>{{ date('d-m-Y',strtotime($d->fecha_solicitud)) }}</td>
												<td>@if(!is_null($d->fecha_aprobada)) {{ date('d-m-Y',strtotime($d->fecha_aprobada)) }} @endif</td>
												<td>{{ $d->endoso }}</td>
												<td>{{ $d->descripcion_estado }}</td>
												<td>
													<a href="{{route('ver_poliza_declaracion',$d->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
													@if($poliza->estado == 'V')
														@if($d->estado == 'S')
															<a href="{{route('aprobar_poliza_declaracion',$d->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
															<a href="{{route('agregar_poliza_declaracion_vehiculo',$d->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> <i class="fa fa-car"></i></a>
														@endif
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="inclusiones">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
					        @if($poliza->estado == 'V')
					        	{!! Form::open(['route' => array('agregar_poliza_inclusion',$poliza->id), 'method' => 'POST', 'id' => 'agregarInclusionForm', 'class' => 'validate-form']) !!}
					        	<input type="submit" value="Generar Solicitud de Inclusión" class="btn btn-primary">
					        	{!! Form::close() !!}
					        	<br/><br/>
					        @endif
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>SOLICITUD</th>
											<th>FECHA SOLICITUD</th>
											<th>FECHA APROBADA</th>
											<th>ENDOSO</th>
											<th>ESTADO</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($inclusiones as $in)	
											<tr>
												<td>{{ $in->numero_solicitud }}</td>
												<td>{{ date('d-m-Y',strtotime($in->fecha_solicitud)) }}</td>
												<td>@if(!is_null($in->fecha_aprobada)) {{ date('d-m-Y',strtotime($in->fecha_aprobada)) }} @endif</td>
												<td>{{ $in->endoso }}</td>
												<td>{{ $in->descripcion_estado }}</td>
												<td>
													<a href="{{route('ver_poliza_inclusion',$in->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
													@if($poliza->estado == 'V')
														@if($in->estado == 'S')
															<a href="{{route('editar_poliza_inclusion',$in->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a>
															<a href="{{route('aprobar_poliza_inclusion',$in->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
															<a href="{{route('agregar_poliza_inclusion_vehiculo',$in->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> <i class="fa fa-car"></i></a>
															<a href="{{route('agregar_poliza_inclusion_cobertura',$in->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> <i class="fa fa-list"></i></a>
															<a href="{{route('agregar_poliza_inclusion_cobertura_vehiculo',[$in->id,0])}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i><i class="fa fa-car"></i><i class="fa fa-list"></i></a>
															<a href="{{route('poliza_inclusion_reporte_solicitud',$in->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Solicitud">
																<img src="{{asset('assets/iconos/pdf.png')}}" width="24px" >
															</a>
														@endif
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="exclusiones">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
					        @if($poliza->estado == 'V')
					        	{!! Form::open(['route' => array('agregar_poliza_exclusion',$poliza->id), 'method' => 'POST', 'id' => 'agregarExclusionform', 'class' => 'validate-form']) !!}
					        	<input type="submit" value="Generar Solicitud de Exclusión" class="btn btn-primary">
					        	{!! Form::close() !!}
					        	<br/><br/>
					        @endif
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>SOLICITUD</th>
											<th>FECHA SOLICITUD</th>
											<th>FECHA APROBADA</th>
											<th>ENDOSO</th>
											<th>ESTADO</th>
										</tr>
									</thead>
									<tbody>
										@foreach($exclusiones as $ex)	
											<tr>
												<td>{{ $ex->numero_solicitud }}</td>
												<td>{{ date('d-m-Y',strtotime($ex->fecha_solicitud)) }}</td>
												<td>@if(!is_null($ex->fecha_aprobada)) {{ date('d-m-Y',strtotime($ex->fecha_aprobada)) }} @endif</td>
												<td>{{ $ex->endoso }}</td>
												<td>{{ $ex->descripcion_estado }}</td>
												<td>
													<a href="{{route('ver_poliza_exclusion',$ex->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
													@if($poliza->estado == 'V')
														@if($ex->estado == 'S')
															<a href="{{route('aprobar_poliza_exclusion',$ex->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-check"></i></a>
															<a href="{{route('agregar_poliza_exclusion_vehiculo',$ex->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> <i class="fa fa-car"></i></a>
															<a href="{{route('agregar_poliza_exclusion_cobertura',$ex->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> <i class="fa fa-list"></i></a>
															<a href="{{route('agregar_poliza_exclusion_cobertura_vehiculo',[$ex->id,0])}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i><i class="fa fa-car"></i><i class="fa fa-list"></i></a>
														@endif
														@if($ex->estado == 'V')
															<a href="{{route('agregar_nota_credito',$ex->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-plus"></i> <i class="fa fa-credit-card"></i></a>
														@endif
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="notas">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>EXCLUSIÓN</th>
											<th>FECHA</th>
											<th>MONTO</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($notas as $nota)	
											<tr>
												<td>{{ $nota->numero_exclusion }}</td>
												<td>{{ date('d-m-Y', strtotime($nota->fecha)) }}</td>
												<td>Q. {{ number_format($nota->monto, 2) }}</td>
												<td>
													<a href="{{route('editar_nota_credito',$nota->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="modificaciones">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
					        @if($poliza->estado == 'V')
					        	{!! Form::open(['route' => array('agregar_poliza_modificacion',$poliza->id), 'method' => 'POST', 'id' => 'agregarPolizaModificacionForm', 'class' => 'validate-form']) !!}
					        	<input type="submit" value="Generar Solicitud de Modificación" class="btn btn-primary">
					        	{!! Form::close() !!}
					        	<br/><br/>
					        @endif
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>SOLICITUD</th>
											<th>FECHA SOLICITUD</th>
											<th>FECHA APROBADA</th>
											<th>ENDOSO</th>
											<th>ESTADO</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($modificaciones as $mod)
											<tr>
												<td>{{ $mod->numero_solicitud }}</td>
												<td>{{ date('d-m-Y',strtotime($mod->fecha_solicitud)) }}</td>
												<td>@if(!is_null($mod->fecha_aprobada)) {{ date('d-m-Y',strtotime($mod->fecha_aprobada)) }} @endif</td>
												<td>{{ $mod->endoso }}</td>
												<td>{{ $mod->descripcion_estado }}</td>
												<td>
													<a href="{{route('ver_poliza_modificacion',$mod->id)}}" class="btn btn-warning btn-xs fa fa-eye" data-toggle="tooltip" data-placement="top" data-original-title="Ver"></a>
													@if($poliza->estado == 'V')
														@if($mod->estado == 'S')
															<a href="{{route('aprobar_poliza_modificacion',$mod->id)}}" class="btn btn-primary btn-xs fa fa-check" data-toggle="tooltip" data-placement="top" title="" data-original-title="Aprobar"></a>
															<a href="{{route('agregar_poliza_modificacion_detalle',$mod->id)}}" class="btn btn-primary btn-xs fa fa-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar Cambios"></a>
															<a href="{{route('poliza_modificacion_reporte_solicitud',$mod->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Solicitud">
																<img src="{{asset('assets/iconos/pdf.png')}}" width="24px" >
															</a>
														@endif
													@endif
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="reclamos">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
					        @if($poliza->estado == 'V')
					        	<a href="{{route('agregar_poliza_vehiculo_reclamo',$poliza->id)}}" class="btn btn-primary">Agregar Reclamo</a>
					        	<br/><br/>
					        @endif
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>NO. AVISO</th>
											<th>RECLAMO</th>
											<th>FECHA</th>
											<th>VALOR</th>
											<th>AJUSTADOR</th>
											<th>PILOTO</th>
											<th>ESTADO</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($reclamos as $reclamo)
											<tr>
												<td>{{ $reclamo->numero_aviso }}</td>
												<td>{{ $reclamo->numero }}</td>
												<td>{{ date('d-m-Y',strtotime($reclamo->fecha_solicitud)) }}</td>
												<td class="text-right">Q. {{ number_format($reclamo->valor, 2) }}</td>
												<td>{{ $reclamo->ajustador }}</td>
												<td>{{ $reclamo->piloto }}</td>
												<td>{{ $reclamo->descripcion_estado }}</td>
												<td>
													<a href="{{route('ver_poliza_vehiculo_reclamo',$reclamo->id)}}" class="btn btn-warning btn-xs fa fa-eye" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"></a>
												</td>
											</tr>
										@endforeach
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

<div id="anular-poliza-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Cerrar</span>
    </button>
    <h4 class="custom-modal-title">Anular Póliza</h4>
    {!! Form::open(['route' => array('anular_poliza',$poliza->id), 'method' => 'POST', 'id' => 'anularPolizaForm', 'class' => 'validate-form']) !!}
    <div class="custom-modal-text">
    	¿Esta seguro de anular la póliza?    	
    	<br/><br/>
    	{!! Field::select('motivo_anulacion_id',$motivosAnulacion,null,['data-required'=>'true']) !!}
    </div>

    <div class="modal-footer">
    	<button type="submit" class="btn btn-danger">Anular</button>
    	<button type="button" class="btn btn-primary" onclick="Custombox.close()">Cerrar</button>
    </div>
    {!! Form::close() !!}
</div>

<div id="anular-requerimiento-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Cerrar</span>
    </button>
    <h4 class="custom-modal-title">Anular Requerimiento</h4>
    {!! Form::open(['route' => array('anular_poliza_requerimiento'), 'method' => 'PUT', 'id' => 'anularRequerimientoForm', 'class' => 'validate-form']) !!}
    <input type="hidden" value="0" id="requerimientoId" name="requerimiento_id">
    <div class="custom-modal-text" id="text-anular-requerimiento">
    	
    </div>
    <div class="custom-modal-text">
    	{!! Field::textarea('observacion_anulacion',null,['data-required'=>'true']) !!}
    </div>
    <div class="modal-footer">
    	<button type="submit" class="btn btn-danger">Anular</button>
    	<button type="button" class="btn btn-primary" onclick="Custombox.close()">Cerrar</button>
    </div>
    {!! Form::close() !!}
</div>

<div id="eliminar-requerimiento-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.close();">
        <span>x</span><span class="sr-only">Cerrar</span>
    </button>
    <h4 class="custom-modal-title">Eliminar Requerimiento</h4>
    {!! Form::open(['route' => array('eliminar_poliza_requerimiento'), 'method' => 'DELETE', 'id' => 'eliminarRequerimientoForm', 'class' => 'validate-form']) !!}
    <input type="hidden" value="0" id="requerimientoEliminarId" name="requerimiento_eliminar_id">
    <div class="custom-modal-text" id="text-eliminar-requerimiento">
    		
    </div>
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
	
	// Javascript to enable link to tab
	var hash = document.location.hash;
	var prefix = "tab_";
	if (hash) {
	    $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
	} 

	$('a[data-toggle=tab]').on('click', function(e){
		window.location.hash = $(this).attr('href');
	});

	function anularRequerimiento(e, id, numero, monto)
	{
		$('#requerimientoId').val(id);
		$('#text-anular-requerimiento').html('¿Desea anular el requerimiento # ' + numero + ' por un monto de Q.'+monto+'?');
        Custombox.open({
            target: '#anular-requerimiento-modal',
            effect: 'newspaper'
        });
        e.preventDefault();
	}

	function eliminarRequerimiento(e, id, numero, monto)
	{
		$('#requerimientoEliminarId').val(id);
		$('#text-eliminar-requerimiento').html('¿Desea eliminar el requerimiento # ' + numero + ' por un monto de Q.'+monto+'?');
        Custombox.open({
            target: '#eliminar-requerimiento-modal',
            effect: 'newspaper'
        });
        e.preventDefault();
	}

	function anularPoliza()
	{
		Custombox.open({
            target: '#anular-poliza-modal',
            effect: 'newspaper'
        });
	}

	function rechazarReclamo(e, id, solicitud, descripcion, valor)
	{
		$('#reclamoId').val(id);
		$('#text-rechazar-reclamo').html('¿Desea rechazar el reclamo ' + solicitud + ' "'+descripcion+'" por un monto de Q. '+valor+'?');
        Custombox.open({
            target: '#rechazar-reclamo-modal',
            effect: 'newspaper'
        });
        e.preventDefault();
	}

</script>
@stop
