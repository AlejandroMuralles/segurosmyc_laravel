@extends('layouts.admin')

@section('title') Editar Requerimiento @stop

@section('header') Editar Requerimiento @stop
@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            {!! Form::model($requerimiento, ['route' => array('editar_poliza_requerimiento', $requerimiento->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-3">{!! Field::text('numero_solicitud', $requerimiento->poliza->numero_solicitud, ['data-required'=>'true', 'disabled']) !!}</div>
					<div class="col-lg-3">{!! Field::text('numero_poliza', $requerimiento->poliza->numero, ['data-required'=>'true', 'disabled']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-3">{!! Field::text('numero', null, ['data-required'=>'true', 'disabled']) !!}</div>
					<div class="col-lg-3">{!! Field::number('cuota', null, ['data-required'=>'true', 'disabled']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-3">{!! Field::number('prima_neta', null, ['data-required'=>'true','step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('iva', null, ['data-required'=>'true','step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('fraccionamiento', null, ['data-required'=>'true','step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('emision', null, ['data-required'=>'true','step'=>'any']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-3">{!! Field::number('asistencia', null, ['data-required'=>'true','step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::number('prima_total', null, ['data-required'=>'true','step'=>'any']) !!}</div>
					<div class="col-lg-3">{!! Field::text('fecha_cobro', null, ['data-required'=>'true','class'=>'fecha']) !!}</div>
					<div class="col-lg-3">{!! Field::select('cliente_id', $clientes) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						{!! Field::textarea('observaciones') !!}
					</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$requerimiento->poliza_id) }}#requerimientos" class="btn btn-danger">Cancelar</a>
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