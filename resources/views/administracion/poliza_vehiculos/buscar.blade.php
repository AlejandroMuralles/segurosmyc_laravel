@extends('layouts.admin')

@section('title') Buscar Vehículo en Póliza @stop

@section('header') Buscar Vehículo en Póliza @stop

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('buscar_poliza_vehiculo'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-4">{!! Field::text('placa', null, ['data-required'=>'true']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Buscar" class="btn btn-primary">
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>

@if(!is_null($vehiculo))

<h2>VEHICULO</h2>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-responsive">
				<thead>
					<th>PLACA</th>
					<th>MARCA</th>
					<th>MODELO</th>
					<th>LINEA</th>
					<th>COLOR</th>
				</thead>
				<tbody>
					<tr>
						<td>{{$vehiculo->placa}}</td>
						<td>{{$vehiculo->marca->nombre}}</td>
						<td>{{$vehiculo->modelo}}</td>
						<td>{{$vehiculo->linea}}</td>
						<td>{{$vehiculo->color}}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<h2>POLIZAS</h2>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table class="table table-responsive">
				<thead>
					<th>SOLICITUD</th>
					<th>POLIZA</th>
					<th>ESTADO</th>
					<th>ASEGURADORA</th>
					<th>CLIENTE</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($polizas as $poliza)
					<tr>
						<td>{{$poliza->poliza->id}}</td>
						<td>{{$poliza->poliza->numero}}</td>
						<td>{{$poliza->poliza->descripcion_estado}}</td>
						<td>{{$poliza->poliza->aseguradora->nombre}}</td>
						<td>{{$poliza->poliza->cliente->nombre}}</td>
						<td>
							@if($poliza->poliza->estado == 'S')
								<a href="{{route('ver_solicitud_poliza',$poliza->poliza->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
							@elseif($poliza->poliza->estado == 'V')
								<a href="{{route('ver_poliza',$poliza->poliza->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endif

@stop
