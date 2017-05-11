@extends('layouts.admin')

@section('title') Agregar Contacto de Cliente @stop

@section('header') Agregar Contacto de Cliente @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_contacto_cliente',$cliente->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
				
				<div class="row">
					<div class="col-lg-6">{!! Field::text('nombre', null, ['data-required'=>'true']) !!}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-4">{!! Field::number('telefonos', null, ['data-required'=>'false']) !!}</div>
					<div class="col-lg-4">{!! Field::number('celular', null, ['data-required'=>'false']) !!}</div>
					<div class="col-lg-4">{!! Field::select('empresa_celular', $empresasCelular, null, ['data-required'=>'false']) !!}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">{!! Field::email('correo', null, ['data-required'=>'true']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-6">{!! Field::text('fecha_nacimiento', null, ['data-required'=>'true', 'class'=>'fecha']) !!}</div>
				</div>

				
				
				
				


				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('contactos_clientes',$cliente->id) }}" class="btn btn-danger">Cancelar</a>
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
