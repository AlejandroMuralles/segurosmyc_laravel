@extends('layouts.admin')

@section('title') Agregar Ausencia - {{$colaborador->nombre_completo}} @stop

@section('header') Agregar Ausencia - {{$colaborador->nombre_completo}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_ausencia_colaborador',$colaborador->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('ausencia_id', $ausencias, null, ['data-required'=>'true']) !!}
				{!! Field::text('fecha_inicio', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::text('fecha_fin', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::number('dias', null, ['data-required'=>'true', 'step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$colaborador->id) }}#ausencias" class="btn btn-danger">Cancelar</a>
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