@extends('layouts.admin')

@section('title') Agregar Cliente @stop

@section('header') Agregar Cliente @stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs navtab-custom">
            <li class="active">
                <a href="#home" data-toggle="tab" aria-expanded="false">
                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                    <span class="hidden-xs">Datos Generales</span>
                </a>
            </li>
            <li class="">
                <a href="#profile" data-toggle="tab" aria-expanded="true">
                    <span class="visible-xs"><i class="fa fa-user"></i></span>
                    <span class="hidden-xs">Contactos</span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				            {!! Form::model($cliente, ['method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
							
							<div class="row">
								<div class="col-lg-12">
									{!! Field::text('nombre', null, ['disabled']) !!}
								</div>
								<div class="col-lg-4">{!! Field::text('nit', null, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('telefonos', null, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('correo', null, ['disabled']) !!}</div>
							</div>

							<div class="row">
							@if($cliente->tipo_cliente == 'E')
								<div class="col-lg-12">{!! Field::text('representante_legal', null, ['disabled']) !!}</div>
							@endif
								<div class="col-lg-4">{!! Field::number('dpi', null, ['disabled']) !!}</div>
							</div>

							<div class="row">
								<h3>Datos de Facturación</h3>
								<div class="col-lg-12">{!! Field::text('nombre_facturacion', null, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('pais_facturacion_id', $cliente->paisFacturacion->nombre, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('departamento_facturacion_id', $cliente->departamentoFacturacion->nombre, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('municipio_facturacion_id', $cliente->municipioFacturacion->nombre, ['disabled']) !!}</div>
								<div class="col-lg-12">
									{!! Field::text('direccion_facturacion',null, ['disabled']) !!}
								</div>
								<div class="col-lg-4">
									{!! Field::text('zona_facturacion',null, ['disabled']) !!}
								</div>

							</div>

							<div class="row">
								<h3>Dirección Fiscal</h3>
								<div class="col-lg-4">{!! Field::text('pais_fiscal_id', $cliente->paisFiscal->nombre, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('departamento_fiscal_id', $cliente->departamentoFiscal->nombre, ['disabled']) !!}</div>
								<div class="col-lg-4">{!! Field::text('municipio_fiscal_id', $cliente->municipioFiscal->nombre, ['disabled']) !!}</div>
								<div class="col-lg-12">
									{!! Field::text('direccion_fiscal',null, ['disabled']) !!}
								</div>
								<div class="col-lg-4">
									{!! Field::text('zona_fiscal',null, ['disabled']) !!}
								</div>

							</div>

							<div class="row">
								<div class="col-lg-12">
									@if(!is_null($cliente->consorcio_id))
										{!! Field::text('consorcio_id', $cliente->consorcio->nombre, ['disabled']) !!}
									@endif
								</div>
							</div>
				            {!! Form::close() !!}
						</div>
					</div>
				</div>
            </div>
            <div class="tab-pane" id="profile">
                <div class="row">
				    <div class="col-lg-12">
				        <div class="card-box">
				            <div class="table-responsive">
				                <table id="table" class="table">
									<thead>
										<tr>
											<th>NOMBRE</th>
											<th>TELEFONOS</th>
											<th>CELULAR</th>
											<th>EMPRESA DE TELEFONO</th>
											<th>CORREO</th>
											<th>FECHA NACIMIENTO</th>
										</tr>
									</thead>
									<tbody>
										@foreach($contactos as $contacto)
											<tr>
												<td>{{ $contacto->nombre }}</td>
												<td>{{ $contacto->telefonos }}</td>
												<td>{{ $contacto->celular }}</td>
												<td>{{ $contacto->empresa_celular }}</td>
												<td>{{ $contacto->correo }}</td>
												<td>{{ date('d/m/Y', strtotime($contacto->fecha_nacimiento)) }}</td>
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

