@extends('layouts.admin')

@section('title') Ver Aseguradora @stop

@section('header') Ver Aseguradora @stop

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
				            {!! Form::model($aseguradora, ['route' => array('editar_aseguradora', $aseguradora->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
								{!! Field::text('nombre', null, ['data-required'=>'true', 'disabled']) !!}
								{!! Field::text('nit', null, ['data-required'=>'true', 'disabled']) !!}
								{!! Field::textarea('direccion', null, ['data-required'=>'true', 'disabled']) !!}

								{!! Field::text('codigo_agente', null, ['data-required'=>'true', 'disabled']) !!}

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

