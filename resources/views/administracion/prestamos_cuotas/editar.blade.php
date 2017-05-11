@extends('layouts.admin')

@section('title') Editar Prestamo - {{$prestamo->prestamo->descripcion}} ({{$prestamo->cuota}}/{{$prestamo->prestamo->cuotas}}) @stop

@section('header') Editar Prestamo - {{$prestamo->prestamo->descripcion}} ({{$prestamo->cuota}}/{{$prestamo->prestamo->cuotas}}) @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            {!! Form::model($prestamo, ['route' => array('editar_prestamo_cuota',$prestamo->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('valor', null, ['data-required'=>'true']) !!}
				{!! Field::text('mes_cobro', date('Y-m',strtotime($prestamo->mes_cobro)), ['data-required'=>'true','class'=>'mes']) !!}
				{!! Field::select('estado', $estados, null, ['data-required'=>'true']) !!}				

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$prestamo->prestamo->colaborador_id) }}#prestamos" class="btn btn-danger">Cancelar</a>
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