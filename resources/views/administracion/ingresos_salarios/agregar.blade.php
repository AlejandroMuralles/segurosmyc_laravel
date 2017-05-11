@extends('layouts.admin')

@section('title') Agregar Ingreso de Salario @stop

@section('header') Agregar Ingreso de Salario @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_ingreso_salario'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				<div class="row">
					<div class="col-lg-6">{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::checkbox('aplica_iggs') !!}</div>
					<div class="col-lg-3">{!! Field::checkbox('aplica_isr') !!}</div>
					<div class="col-lg-3">{!! Field::checkbox('aplica_bono14') !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::checkbox('aplica_aguinaldo') !!}</div>
					<div class="col-lg-3">{!! Field::checkbox('aplica_vacaciones') !!}</div>
					<div class="col-lg-3">{!! Field::checkbox('aplica_liquidacion') !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ingresos_salarios') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop