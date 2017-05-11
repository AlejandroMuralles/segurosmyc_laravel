@extends('layouts.admin')

@section('title') Editar Descuento - {{$descuento->colaborador->nombre_completo}} @stop

@section('header') Editar Descuento - {{$descuento->colaborador->nombre_completo}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($descuento, ['route' => array('editar_descuento_colaborador',$descuento->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-4">{!! Field::text('tipo_descuento_id', $descuento->descuento->nombre, ['disabled']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-4">{!! Field::number('valor', null, ['data-required'=>'true','step'=>'any']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-4">{!! Field::text('fecha_inicio', null, ['data-required'=>'true','class'=>'fecha']) !!}</div>
					<div class="col-lg-4">{!! Field::text('fecha_fin', null, ['data-required'=>'true','class'=>'fecha']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-4">{!! Field::select('estado', $estados, null, ['data-required'=>'true']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$descuento->colaborador->id) }}#vacaciones" class="btn btn-danger">Cancelar</a>
	            </p>

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