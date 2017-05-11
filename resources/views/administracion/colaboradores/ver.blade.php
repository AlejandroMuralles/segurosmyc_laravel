@extends('layouts.admin')

@section('title') {{$colaborador->nombre_completo}} @stop

@section('header') {{$colaborador->nombre_completo}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
    	<div class="card-box">
	        <ul class="nav nav-tabs navtab-custom">
	            <li class="active">
	                <a href="#generales" data-toggle="tab" aria-expanded="false">
	                    <span class="visible-xs"><i class="fa fa-users"></i></span>
	                    <span class="hidden-xs">Datos Generales</span>
	                </a>
	            </li>
	            <li class="">
	                <a href="#ingresos" data-toggle="tab" aria-expanded="true">
	                    <span class="visible-xs"><i class="fa fa-money"></i></span>
	                    <span class="hidden-xs">Ingresos</span>
	                </a>
	            </li>
	            <li class="">
	                <a href="#prestamos" data-toggle="tab" aria-expanded="true">
	                    <span class="visible-xs"><i class="fa fa-money"></i></span>
	                    <span class="hidden-xs">Prestamos</span>
	                </a>
	            </li>
	            <li class="">
	                <a href="#vacaciones" data-toggle="tab" aria-expanded="true">
	                    <span class="visible-xs"><i class="fa fa-money"></i></span>
	                    <span class="hidden-xs">Vacaciones</span>
	                </a>
	            </li>
	            <li class="">
	                <a href="#suspensionesigss" data-toggle="tab" aria-expanded="true">
	                    <span class="visible-xs"><i class="fa fa-money"></i></span>
	                    <span class="hidden-xs">Suspensiones IGSS</span>
	                </a>
	            </li>
	            <li class="">
	                <a href="#ausencias" data-toggle="tab" aria-expanded="true">
	                    <span class="visible-xs"><i class="fa fa-money"></i></span>
	                    <span class="hidden-xs">Otras Ausencias</span>
	                </a>
	            </li>
	            <li class="">
	                <a href="#descuentos" data-toggle="tab" aria-expanded="true">
	                    <span class="visible-xs"><i class="fa fa-money"></i></span>
	                    <span class="hidden-xs">Descuentos</span>
	                </a>
	            </li>
            </ul>
        	<div class="tab-content">
            	<div class="tab-pane active" id="generales">
	           
		            {!! Form::model($colaborador, ['route' => array('editar_colaborador',$colaborador->id), 'files'=>true, 'method' => 'PUT', 'id' => 'form', 'class'=>'validate-form']) !!}
					
						<div class="row">
							<div class="col-lg-3">
								<img src="{{asset('assets/imagenes/')}}/{{$colaborador->foto}}" alt="" height="150px">
							</div>
							<div class="col-lg-3">
								{!! Field::text('nombre_completo', $colaborador->nombre_completo, ['disabled']) !!}
								{!! Field::text('fecha_nacimiento', $colaborador->fecha_nacimiento, ['disabled']) !!}
							</div>
							<div class="col-lg-3">
								{!! Field::text('dpi', null, ['disabled']) !!}
								{!! Field::text('sexo', $colaborador->descripcion_sexo, ['disabled']) !!}
							</div>
							<div class="col-lg-3">
								{!! Field::text('area',$colaborador->puesto->area->nombre, ['disabled']) !!}
								{!! Field::text('puesto_id', $colaborador->puesto->nombre, ['disabled']) !!}
							</div>
						</div>
						<br/>

						<div class="row">
							<div class="col-lg-3">{!! Field::text('telefono', null, ['disabled']) !!}</div>
							<div class="col-lg-3">{!! Field::text('extension', null, ['disabled']) !!}</div>
							<div class="col-lg-3">{!! Field::text('celular', null, ['disabled']) !!}</div>
							<div class="col-lg-3">{!! Field::email('email', null, ['disabled']) !!}</div>
						</div>

						<div class="row">
							<div class="col-lg-3">{!! Field::text('fecha_ingreso',null,['disabled']) !!}</div>
							<div class="col-lg-3">{!! Field::text('dias_vacaciones',null,['disabled']) !!}</div>
							<div class="col-lg-3">{!! Field::text('hora_entrada',$colaborador->hora_entrada,['disabled']) !!}</div>
							<div class="col-lg-3">{!! Field::text('estado',$colaborador->descripcion_estado, ['disabled']) !!}</div>
						</div>
		            {!! Form::close() !!}
				</div>
				<div class="tab-pane" id="ingresos">
					<a href="{{route('agregar_ingreso_colaborador',$colaborador->id)}}" class="btn btn-primary">Agregar Ingreso</a>
					<br/><br/>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th class="text-center">INGRESO</th>
											<th class="text-center">VALOR</th>
											<th class="text-center">ESTADO</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php $total = $colaborador->sueldo_base; ?>
										<tr>
											<td class="text-center">Sueldo Base</td>
											<td class="text-right">Q. {{ number_format($colaborador->sueldo_base,2) }}</td>
											<td class="text-center">ACTIVO</td>
											<td></td>
										</tr>
										@foreach($ingresos as $ingreso)
										<tr>
											<?php if($ingreso->estado == 'A') $total += $ingreso->valor; ?>
											<td class="text-center">{{$ingreso->ingreso->descripcion}}</td>
											<td class="text-right">Q. {{ number_format($ingreso->valor,2) }}</td>
											<td class="text-center">{{$ingreso->descripcion_estado}}</td>
											<td><a href="{{route('editar_ingreso_colaborador',$ingreso->id)}}" class="btn btn-warning btn-xs fa fa-edit"></a></td>
										</tr>
										@endforeach
										<tr class="bg-blue text-white">
											<td class="text-center">TOTAL</td>
											<td class="text-right">Q. {{ number_format($total,2) }}</td>
											<td class="text-center"></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
					</div>
				</div>
				<div class="tab-pane" id="prestamos">
					<a href="{{route('agregar_prestamo',$colaborador->id)}}" class="btn btn-primary">Agregar Prestamo</a>
					<br/><br/>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th class="text-center">PRESTAMO</th>
											<th class="text-center">CUOTA</th>
											<th class="text-center">VALOR</th>
											<th class="text-center">FECHA COBRO</th>
											<th class="text-center">FECHA PAGO</th>
											<th class="text-center">ESTADO</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php $totalPrestamos = 0; ?>
										@foreach($prestamos as $prestamo)
										<?php $totalPrestamos += $prestamo->valor; ?>
										<tr>
											<td class="text-center">{{$prestamo->prestamo->descripcion}}</td>
											<td class="text-center">{{$prestamo->cuota}}</td>
											<td class="text-right">Q. {{ number_format($prestamo->valor,2) }}</td>
											<td class="text-center">{{ date('m-Y', strtotime($prestamo->mes_cobro)) }}</td>
											<td class="text-center">
												@if(!is_null($prestamo->mes_pago)) 
													{{ date('d-m-Y', strtotime($prestamo->mes_pago)) }}
												@endif
											</td>
											<td class="text-center">
												<?php
													if($prestamo->estado == 'N') $labelStyle = 'label-danger';
													elseif($prestamo->estado == 'C') $labelStyle = 'label-success';
													else $labelStyle = 'label-dark';
												?>
												<span class="label {{$labelStyle}}">{{ $prestamo->descripcion_estado }}</span>												
											</td>
											<td><a href="{{route('editar_prestamo_cuota',$prestamo->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a></td>
										</tr>
										@endforeach
										<tr class="bg-blue text-white">
											<td></td>
											<td class="text-center">TOTAL</td>
											<td class="text-right">Q. {{ number_format($totalPrestamos,2) }}</td>
											<td class="text-center"></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
					</div>
				</div>
				<div class="tab-pane" id="vacaciones">
					<a href="{{route('agregar_vacacion_colaborador',$colaborador->id)}}" class="btn btn-primary">Agregar Vacación</a>
					<br/><br/>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th class="text-center">PERIODO</th>
											<th class="text-center">FECHA INICIO</th>
											<th class="text-center">FECHA FIN</th>
											<th class="text-center">DIAS GOZADOS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php $totalVacaciones = 0; ?>
										@foreach($vacaciones as $vacacion)
										<?php $totalVacaciones += $vacacion->dias_gozados; ?>
										<tr>
											<td class="text-center">
												{{date('Y',strtotime($vacacion->periodo))}} - 
												{{date('Y',strtotime($vacacion->periodo))+1}}
											</td>
											<td class="text-center">{{date('d-m-Y',strtotime($vacacion->fecha_inicio))}}</td>
											<td class="text-center">{{date('d-m-Y',strtotime($vacacion->fecha_fin))}}</td>
											<td class="text-center">{{$vacacion->dias_gozados}}</td>
											<td><a href="{{route('editar_vacacion_colaborador',$vacacion->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a></td>
										</tr>
										@endforeach
										<tr class="bg-blue text-white">
											<td></td>
											<td></td>
											<td class="text-center">TOTAL</td>
											<td class="text-center">{{ $totalVacaciones }}</td>
											<td class="text-center"></td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
					</div>
				</div>
				<div class="tab-pane" id="suspensionesigss">
					<a href="{{route('agregar_suspension_igss_colaborador',$colaborador->id)}}" class="btn btn-primary">Agregar Suspensión IGSS</a>
					<br/><br/>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th class="text-center">FECHA INICIO</th>
											<th class="text-center">FECHA FIN</th>
											<th class="text-center">DIAS</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php $totalSuspensiones = 0; ?>
										@foreach($suspensiones as $suspension)
										<?php $totalSuspensiones += $suspension->dias; ?>
										<tr>
											<td class="text-center">{{date('d-m-Y',strtotime($suspension->fecha_inicio))}}</td>
											<td class="text-center">{{date('d-m-Y',strtotime($suspension->fecha_fin))}}</td>
											<td class="text-center">{{$suspension->dias}}</td>
											<td><a href="{{route('editar_suspension_igss_colaborador',$suspension->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a></td>
										</tr>
										@endforeach
										<tr class="bg-blue text-white">
											<td></td>
											<td class="text-center">TOTAL</td>
											<td class="text-center">{{ $totalSuspensiones }}</td>
											<td class="text-center"></td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
					</div>
				</div>
				<div class="tab-pane" id="ausencias">
					<a href="{{route('agregar_ausencia_colaborador',$colaborador->id)}}" class="btn btn-primary">Agregar Ausencia</a>
					<br/><br/>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th class="text-center">FECHA INICIO</th>
											<th class="text-center">FECHA FIN</th>
											<th class="text-center">DIAS AUSENTE</th>
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										<?php $totalAusencias = 0; ?>
										@foreach($ausencias as $ausencia)
										<?php $totalAusencias += $ausencia->dias; ?>
										<tr>
											<td class="text-center">{{date('d-m-Y',strtotime($ausencia->fecha_inicio))}}</td>
											<td class="text-center">{{date('d-m-Y',strtotime($ausencia->fecha_fin))}}</td>
											<td class="text-center">{{$ausencia->dias}}</td>
											<td><a href="{{route('editar_ausencia_colaborador',$ausencia->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a></td>
										</tr>
										@endforeach
										<tr class="bg-blue text-white">
											<td></td>
											<td class="text-center">TOTAL</td>
											<td class="text-center">{{ $totalAusencias }}</td>
											<td class="text-center"></td>
										</tr>
									</tbody>
								</table>
							</div>	
						</div>
					</div>
				</div>
				<div class="tab-pane" id="descuentos">
					<a href="{{route('agregar_descuento_colaborador',$colaborador->id)}}" class="btn btn-primary">Agregar Descuento</a>
					<br/><br/>
					<div class="row">
						<div class="col-lg-6">
							<div class="table-responsive">
								<table class="table table-responsive">
									<thead>
										<tr>
											<th class="text-center">DESCUENTO</th>
											<th class="text-center">VALOR</th>
											<th class="text-center">FECHA INICIO</th>
											<th class="text-center">FECHA FIN</th>
											<th class="text-center">ESTADO</th>											
											<th class="text-center"></th>
										</tr>
									</thead>
									<tbody>
										@foreach($descuentos as $descuento)
										<tr>
											<td class="text-center">{{$descuento->descuento->descripcion}}</td>
											<td class="text-right">Q. {{ number_format($descuento->valor,2)}}</td>
											<td class="text-center">{{date('d-m-Y',strtotime($descuento->fecha_inicio))}}</td>
											<td class="text-center">{{date('d-m-Y',strtotime($descuento->fecha_fin))}}</td>
											<td class="text-center">{{$descuento->descripcion_estado}}</td>
											<td><a href="{{route('editar_descuento_colaborador',$descuento->id)}}" class="btn btn-warning btn-xs fa fa-edit" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"></a></td>
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
<script>
	$(function(){
		// Javascript to enable link to tab
		var hash = document.location.hash;
		var prefix = "tab_";
		if (hash) {
		    $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
		} 

		$('a[data-toggle=tab]').on('click', function(e){
			window.location.hash = $(this).attr('href');
		});
	})
</script>
@stop