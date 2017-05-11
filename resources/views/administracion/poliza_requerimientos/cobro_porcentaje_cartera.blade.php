@extends('layouts.admin')

@section('title') Listado de Requerimientos @stop

@section('header') Listado de Requerimientos @stop


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
                <table id="table" class="table">
					<thead>
						<tr>
							<th>FECHA PAGO</th>
							<th>REQUERIMIENTO</th>
							<th>POLIZA</th>
							<th>ASEGURADORA</th>
							<th>CLIENTE</th>
							<th>MONTO</th>
							<th>DIAS ATRASADO</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($requerimientos as $requerimiento)
							<tr class="@if($requerimiento->dias_atrasado > 30) bg-red text-white @endif">
								<td>{{ date('d-m-Y',strtotime($requerimiento->fecha_pago)) }}</td>
								<td>{{ $requerimiento->numero }}</td>
								<td>{{ $requerimiento->poliza->numero }}</td>
								<td>{{ $requerimiento->poliza->aseguradora->nombre }}</td>
								<td>{{ $requerimiento->poliza->cliente->nombre }}</td>
								<td>{{ $requerimiento->prima_total }}</td>
								<td>{{ $requerimiento->dias_atrasado }}</td>
								<td><a href="{{route('agregar_pago_requerimiento',$requerimiento->poliza_id)}}" class="btn btn-warning btn-xs fa fa-money" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pagar"></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
