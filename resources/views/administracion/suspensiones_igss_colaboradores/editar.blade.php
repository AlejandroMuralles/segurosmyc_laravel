@extends('layouts.admin')

@section('title') Editar Suspension IGSS - {{$suspension->colaborador->nombre_completo}} @stop

@section('header') Editar Suspension IGSS - {{$suspension->colaborador->nombre_completo}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($suspension, ['route' => array('editar_suspension_igss_colaborador',$suspension->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('fecha_inicio', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::text('fecha_fin', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::number('dias', null, ['data-required'=>'true', 'step'=>'any']) !!}
				{!! Field::textarea('motivo', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$suspension->colaborador_id) }}" class="btn btn-danger">Cancelar</a>
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