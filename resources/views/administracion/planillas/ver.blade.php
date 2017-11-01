@extends('layouts.admin')

@section('title') Planilla {{date('d-m-Y',strtotime($planilla->fecha))}} - {{$planilla->aseguradora->nombre}} @stop

@section('header') Planilla {{date('d-m-Y',strtotime($planilla->fecha))}} - {{$planilla->aseguradora->nombre}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	<a href="{{route('buscar_requerimientos_planilla',$planilla->id)}}" class="btn btn-primary fa fa-plus" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar Requerimientos"></a>
			@if($planilla->tipo == 1)
        	<a href="{{route('reporte_planilla_diaria',$planilla->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Planilla">
        		<img src="{{asset('assets/iconos/pdf.png')}}" width="48px" >
			</a>
			@elseif($planilla->tipo == 2)
			<a href="{{route('reporte_planilla_poliza',$planilla->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Generar Planilla Poliza">
        		<img src="{{asset('assets/iconos/pdf.png')}}" width="48px" >
			</a>
			@endif
			<hr>
			<div class="table-responsive">
            	<table class="table table-responsive">
            		<thead>
            			<tr>
            				<th class="text-center">POLIZA</th>
            				<th class="text-center">CLIENTE</th>
            				<th class="text-center">NUMERO</th>
            				<th class="text-center">FECHA PAGO</th>
            				<th class="text-center">DOCUMENTO</th>
            				<th class="text-center">TIPO DOCUMENTO</th>
            				<th class="text-center">VALOR DOCUMENTO</th>
            				<th class="text-center">BANCO</th>
            				<th class="text-center">VALOR</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php $total = 0; ?>
            			@foreach($requerimientos as $requerimiento)
            			<tr>
            				<?php $total += $requerimiento->prima_total; ?>
            				<?php $pagos = $requerimiento->pagos; ?>
	            			<td class="text-center">
	            				@if($planilla->tipo == 1)
	            					{{$requerimiento->poliza->numero}}
	            				@elseif($planilla->tipo == 2)
									{{$requerimiento->poliza->numero_solicitud}}
								@endif
	            			</td>
	            			<td class="text-center">{{$requerimiento->poliza->cliente->nombre}}</td>
	            			<td class="text-center">{{$requerimiento->numero}}</td>
	            			<td class="text-center">
	            				@foreach($pagos as $pago)
	            					{{date('d-m-Y', strtotime($pago->pago->fecha_pago))}}
	            					<br/>
	            				@endforeach
	            			</td>
	            			<td class="text-center">
	            				@foreach($pagos as $pago)
	            					{{$pago->pago->numero_documento}}
	            					<br/>
	            				@endforeach
	            			</td>
	            			<td class="text-center">
	            				@foreach($pagos as $pago)
	            					{{$pago->pago->descripcion_forma_pago}}
	            					<br/>
	            				@endforeach
	            			</td>
	            			<td class="text-center">
	            				@foreach($pagos as $pago)
	            					Q. {{ number_format($pago->pago->monto,2) }}
	            					<br/>
	            				@endforeach
	            			</td>
	            			<td class="text-center">
	            				@foreach($pagos as $pago)
	            					{{$pago->pago->banco->nombre}}
	            					<br/>
	            				@endforeach
	            			</td>
	            			<td class="text-right">Q. {{ number_format($requerimiento->prima_total,2) }}</td>
            			</tr>
            			@endforeach
            			<tr class="bg-primary text-white">
	            			<td colspan="8" class="text-center">TOTAL</td>
	            			<td class="text-right ">Q. {{ number_format($total,2) }}</td>
            			</tr>
            		</tbody>
            	</table>
            </div>

		</div>
	</div>
</div>
@stop