@extends('layouts.admin')

@section('title') Agregar Nota de Crédito a Exclusipon {{$exclusion->numero_solicitud}} @stop

@section('header') Agregar Nota de Crédito a Exclusipon {{$exclusion->numero_solicitud}} @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_nota_credito',$exclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('exclusion',$exclusion->numero_solicitud,['disabled']) !!}
				{!! Field::text('numero_documento', null, ['data-required'=>'true']) !!}
				{!! Field::textarea('observaciones', null, ['data-required'=>'true']) !!}
				{!! Field::text('fecha', date('Y-m-d'), ['data-required'=>'true','class'=>'fecha']) !!}
				{!! Field::number('monto', null, ['data-required'=>'true','step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$exclusion->poliza_id) }}" class="btn btn-danger">Cancelar</a>
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