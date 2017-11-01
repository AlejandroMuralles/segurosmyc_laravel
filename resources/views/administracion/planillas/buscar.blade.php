@extends('layouts.admin')
@section('title') Agregar Requerimientos a Planilla @stop
@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('buscar_requerimientos_planilla',$planilla->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}

				{!! Field::text('fecha_inicio', $fechaInicio, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::text('fecha_final', $fechaFinal, ['data-required'=>'true','class'=>'fecha']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Buscar Requerimientos" class="btn btn-primary">
	                <a href="{{ route('planillas',$planilla->aseguradora_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}

            <h3 class="sub-title">Requerimientos</h3>

			{!! Form::open(['route' => array('agregar_requerimientos_planilla',$planilla->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
            <div class="table-responsive">
            	<table class="table table-responsive">
            		<thead>
            			<tr>
            				<th></th>
            				<th class="text-center">POLIZA</th>
            				<th class="text-center">REQUERIMIENTO</th>
                            <th class="text-center">FECHA COBRO</th>
                            <th class="text-center">CLIENTE</th>
            				<th class="text-center">VALOR</th>
            			</tr>
            		</thead>
            		<tbody>
            			<?php $total = 0; ?>
            			@foreach($requerimientos as $requerimiento)
            			<tr>
            				<?php $total += $requerimiento->prima_total; ?>
            				<td>
								<input type="checkbox" name="requerimientos[{{$requerimiento->id}}][check]" class="chk" value="{{$requerimiento->id}}">
								<input type="hidden" name="requerimientos[{{$requerimiento->id}}][id]" value="{{$requerimiento->id}}">
							</td>
	            			<td class="text-center">
                                @if($planilla->tipo == 1)
                                    {{$requerimiento->poliza->numero}}
                                @elseif($planilla->tipo == 2)
                                    {{$requerimiento->poliza->numero_solicitud}}
                                @endif
                            </td>
	            			<td class="text-center">{{$requerimiento->numero}}</td>
                            <td class="text-center">{{$requerimiento->fecha_cobro}}</td>
                            <td class="text-center">{{$requerimiento->poliza->cliente->nombre}}</td>
	            			<td class="text-right">Q. {{ number_format($requerimiento->prima_total,2) }}</td>
            			</tr>
            			@endforeach
            			<tr class="bg-primary text-white">
	            			<td colspan="5" class="text-center">TOTAL</td>
	            			<td class="text-right ">Q. {{ number_format($total,2) }}</td>
            			</tr>
            		</tbody>
            	</table>
            </div>
            <input type="submit" value="Agregar Requerimientos a Planilla" class="btn btn-primary">
            {!! Form::close() !!}

		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    $(function(){
    	$('.fecha').datepicker({
    		format: 'yyyy-mm-dd',
		    autoclose: true,
		    todayHighlight: true
		});

    });
</script>
@stop