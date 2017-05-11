@extends('layouts.admin')

@section('title') Editar Contacto de Aseguradora @stop

@section('header') Editar Contacto de Aseguradora @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($contacto, ['route' => array('editar_contacto_aseguradora', $contacto->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-6">{!! Field::text('nombre', null, ['data-required'=>'true']) !!}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-4">{!! Field::number('telefonos', null, ['data-required'=>'false']) !!}</div>
					<div class="col-lg-3">{!! Field::number('extension', null, ['data-required'=>'false']) !!}</div>
					<div class="col-lg-4">{!! Field::number('celular', null, ['data-required'=>'false']) !!}</div>
					<div class="col-lg-4">{!! Field::select('empresa_celular', $empresasCelular, null, ['data-required'=>'false']) !!}</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">{!! Field::email('correo', null, ['data-required'=>'true']) !!}</div>
					<div class="col-lg-6">{!! Field::select('area_aseguradora_id', $areas, null, ['data-required'=>'true']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-6">{!! Field::text('fecha_nacimiento',null,['data-required'=>'false','class'=>'fecha']) !!}</div>
				</div>
				<div class="row">
					<div class="col-lg-12">{!! Field::text('observaciones', null, ['data-required'=>'false']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('contactos_aseguradoras',$contacto->aseguradora_id) }}" class="btn btn-danger">Cancelar</a>
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