@extends('layouts.reporte')
@section('title') Planilla {{ date('d-m-Y', strtotime($planilla->fecha)) }} @stop
@section('content')
  	<div id="content" style="font-size: 10px !important">
    	<h4 class="title">Planilla {{ date('d-m-Y', strtotime($planilla->fecha)) }}</h4>
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
            			<td class="text-center">{{$requerimiento->poliza->numero}}</td>
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
@stop