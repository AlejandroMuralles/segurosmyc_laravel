@extends('layouts.admin')

@section('title') Editar Ingreso de Salario @stop

@section('header') Editar Ingreso de Salario @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($ingresoSalario, ['route' => array('editar_ingreso_salario',$ingresoSalario->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
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

				<div class="row">
					<div class="col-lg-6">{!! Field::select('estado', $estados, null, ['data-required'=>'true']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ingresos_salarios') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop