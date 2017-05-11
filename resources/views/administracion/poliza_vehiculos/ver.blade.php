@extends('layouts.admin')

@section('title') Ver Vehículo @stop

@section('header') Ver Vehículo @stop

@section('content')

<div class="row">
    <div class="col-lg-12">
    	<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-danger">Regresar</a>
    	<br/><br/>
        <ul class="nav nav-tabs navtab-custom">
            <li class="active">
                <a href="#vehiculo" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">DATOS POLIZA</span>
                </a>
            </li>
            <li class="">
                <a href="#generales" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">DATOS GENERALES</span>
                </a>
            </li>
            <li class="">
                <a href="#coberturas" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">COBERTURAS</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="vehiculo">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				        		<div class="row">
				        			<div class="col-lg-4">{!! Field::text('numero_certificado', $vehiculo->numero_certificado, ['disabled']) !!}</div>
				        		</div>
								<div class="row">									
									<div class="col-lg-3">{!! Field::text('placa', $vehiculo->vehiculo->placa, ['disabled']) !!}</div>									
									<div class="col-lg-3">{!! Field::text('suma_asegurada', 'Q. '.number_format($vehiculo->suma_asegurada,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('suma_asegurada_blindaje', 'Q. '. number_format($vehiculo->suma_asegurada_blindaje,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('asistencia', 'Q. '. number_format($vehiculo->asistencia,2), ['disabled']) !!}</div>
								</div>
								<div class="row">
									<div class="col-lg-3">{!! Field::text('prima_neta', 'Q. '.number_format($vehiculo->prima_neta,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('emision', 'Q. '.number_format($vehiculo->emision,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('fraccionamiento', 'Q. '.number_format($vehiculo->fraccionamiento,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('iva', 'Q. '.number_format($vehiculo->iva,2), ['disabled']) !!}</div>
								</div>
								<div class="row">
									<div class="col-lg-3">{!! Field::text('prima_total', 'Q. '.$vehiculo->prima_total, ['disabled']) !!}</div>
								</div>
								<h3 class="sub-title">Deducibles por Robo</h3>
								<div class="row">
									<div class="col-lg-3">{!! Field::text('pct_deducible_robo', number_format($vehiculo->pct_deducible_robo,2) . '%', ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('deducible_robo', 'Q. '. number_format($vehiculo->deducible_robo,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('deducible_minimo_robo', 'Q. '. number_format($vehiculo->deducible_minimo_robo,2), ['disabled']) !!}</div>
								</div>
								<h3 class="sub-title">Deducibles por Daños</h3>
								<div class="row">
									<div class="col-lg-3">{!! Field::text('pct_deducible_dano', number_format($vehiculo->pct_deducible_dano,2) . '%', ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('deducible_dano', 'Q. '. number_format($vehiculo->deducible_dano,2), ['disabled']) !!}</div>
									<div class="col-lg-3">{!! Field::text('deducible_minimo_dano', 'Q. '. number_format($vehiculo->deducible_minimo_dano,2), ['disabled']) !!}</div>
								</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="generales">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				            <div class="row">
								<div class="col-lg-3">{!! Field::text('placa', $vehiculo->vehiculo->placa, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('marca', $vehiculo->vehiculo->marca->nombre, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('modelo', $vehiculo->vehiculo->modelo, ['disabled']) !!}</div>								
								<div class="col-lg-3">{!! Field::text('linea', $vehiculo->vehiculo->linea, ['disabled']) !!}</div>
							</div>
							<div class="row">								
								<div class="col-lg-3">{!! Field::text('color', $vehiculo->vehiculo->color, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('numero_asientos', $vehiculo->vehiculo->numero_asientos, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('numero_motor', $vehiculo->vehiculo->numero_motor, ['disabled']) !!}</div>
								<div class="col-lg-3">{!! Field::text('numero_chasis', $vehiculo->vehiculo->numero_chasis, ['disabled']) !!}</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="coberturas">
                <div class="row">
				    <div class="col-lg-9">
				    	<div class="table-responsive">
				    		<table class="table table-responsive">
				    			<thead>
				    				<tr>
				    					<th>ESTADO</th>
				    					<th>COBERTURA</th>
				    					<th>SUMA ASEGURADA</th>
				    					<th>DEDUCIBLE</th>
				    				</tr>
				    			</thead>
				    			<tbody>
				    				@foreach($coberturas as $cobertura)
										<tr>
											<td>{{$cobertura->descripcion_estado}} </td>
											<td>{{$cobertura->cobertura->nombre}}</td>
											<td>Q. {{number_format($cobertura->suma_asegurada,2)}}</td>
											<td>Q. {{number_format($cobertura->deducible,2)}}</td>
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


@stop
