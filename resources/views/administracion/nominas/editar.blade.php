@extends('layouts.admin')

@section('title') Editar Nomina @stop

@section('header') Editar Nomina @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($nomina, ['route' => array('editar_nomina', $nomina->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('tipo_nomina_id', $tipos, null, ['data-required'=>'true']) !!}
				{!! Field::text('fecha_inicio', null, ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::text('fecha_final', null, ['data-required'=>'true','class'=>'fecha']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('nominas') }}" class="btn btn-danger">Cancelar</a>
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
	        language: 'es',
	    });

    });
</script>
@stop