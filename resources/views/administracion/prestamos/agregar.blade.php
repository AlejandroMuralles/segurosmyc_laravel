@extends('layouts.admin')

@section('title') Agregar Prestamo - {{$colaborador->nombre_completo}} @stop

@section('header') Agregar Prestamo - {{$colaborador->nombre_completo}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            {!! Form::open(['route' => array('agregar_prestamo',$colaborador->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}
				{!! Field::text('cuotas', null, ['data-required'=>'true']) !!}
				{!! Field::text('valor', null, ['data-required'=>'true']) !!}
				{!! Field::text('mes_inicio_cobro', null, ['data-required'=>'true','class'=>'mes']) !!}				

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$colaborador->id) }}#prestamos" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
            
		</div>
	</div>
</div>
@stop

@section('js')
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.js')}}"></script>
<script>
    $(function(){
    	$('.mes').datepicker({
	        format: 'yyyy-mm',
	        autoclose: true,
	        todayHighlight: true,
	        language: 'es',
	    	viewMode: "months", 
	    	minViewMode: "months"
	    });

    });
</script>
@stop