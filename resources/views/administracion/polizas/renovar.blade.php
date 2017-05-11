@extends('layouts.admin')

@section('title') Renovar Póliza @stop

@section('header') Renovar Póliza @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($poliza, ['route' => array('renovar_poliza',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
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
					<div class="col-lg-4">{!! Field::select('anual_declarativa',['A'=>'Anual','D'=>'Declarativa'],null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-4">{!! Field::select('frecuencia_pago_id',$frecuencias,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-4">{!! Field::select('cantidad_pagos',$fraccionamientos,null,['data-required'=>'true']) !!}</div>
				</div>
				


				<br/>

	            <p>
	                <input type="submit" value="Renovar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$poliza->id) }}" class="btn btn-danger">Cancelar</a>
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