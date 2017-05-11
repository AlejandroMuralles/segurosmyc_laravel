@extends('layouts.admin')

@section('title') Agregar Planilla @stop

@section('header') Agregar Planilla @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_planilla',$aseguradoraId), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('aseguradora_id', $aseguradoras, $aseguradoraId, ['data-required'=>'true']) !!}
				{!! Field::text('fecha', date('Y-m-d'), ['data-required'=>'true','class'=>'fecha']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('planillas',$aseguradoraId) }}" class="btn btn-danger">Cancelar</a>
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
		$('.fecha').datepicker({
    		format: 'yyyy-mm-dd',
		    autoclose: true,
		    todayHighlight: true,
		    language: 'es'
		});

	});
</script>
@stop