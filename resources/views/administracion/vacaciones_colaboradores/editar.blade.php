@extends('layouts.admin')

@section('title') Editar Vacación - {{$vacacion->colaborador->nombre_completo}} @stop

@section('header') Editar Vacación - {{$vacacion->colaborador->nombre_completo}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($vacacion, ['route' => array('editar_vacacion_colaborador',$vacacion->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::number('periodo', date('Y',strtotime($vacacion->periodo)), ['data-required'=>'true']) !!}
				{!! Field::text('fecha_inicio', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::text('fecha_fin', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::number('dias_gozados', null, ['data-required'=>'true', 'step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$vacacion->colaborador_id) }}#vacaciones" class="btn btn-danger">Cancelar</a>
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