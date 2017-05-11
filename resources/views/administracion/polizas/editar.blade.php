@extends('layouts.admin')

@section('title') Editar Póliza @stop

@section('header') Editar Póliza @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($poliza, ['route' => array('editar_poliza',$poliza->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-6">{!! Field::text('numero_solicitud', null, ['disabled']) !!}</div>
					@if($poliza->estado == 'V')
					<div class="col-lg-6">{!! Field::text('numero', null, ['data-required'=>'true']) !!}</div>
					@endif
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::select('aseguradora_id',$aseguradoras,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-6">{!! Field::select('cliente_id',$clientes,null,['data-required'=>'true']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::text('fecha_inicio', null, ['data-required'=>'true', 'class'=>'fecha']) !!}</div>
					<div class="col-lg-6">{!! Field::text('fecha_fin', null, ['data-required'=>'true', 'class'=>'fecha']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::select('dueno_id',$colaboradores,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-6">{!! Field::select('ejecutivo_id',$colaboradores,null,['data-required'=>'true']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-6">{!! Field::select('ramo_id',$ramos,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-6">{!! Field::text('dirigida_a',null,['data-required'=>'false']) !!}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-4">{!! Field::select('anual_declarativa',$tiposPagoPoliza,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-4">{!! Field::select('frecuencia_pago_id',$frecuencias,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-4">{!! Field::select('cantidad_pagos',$fraccionamientos,null,['data-required'=>'true']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="aplicar_fraccionamiento">Aplicar Fraccionamiento</label>
							@if($poliza->pct_fraccionamiento == 0)
								<input name="aplicar_fraccionamiento" type="checkbox" value="1">
							@else
								<input name="aplicar_fraccionamiento" type="checkbox" value="1" checked="true">
							@endif
						</div>
					</div>
				</div>
				
				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                @if($poliza->estado == 'S')
	                <a href="{{ route('solicitudes_polizas') }}" class="btn btn-danger">Cancelar</a>
	                @elseif($poliza->estado == 'V')
	                <a href="{{ route($poliza->ruta, $poliza->id) }}" class="btn btn-danger">Cancelar</a>
	                @endif
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
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