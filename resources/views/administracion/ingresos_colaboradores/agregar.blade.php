@extends('layouts.admin')

@section('title') Agregar Ingreso a Colaborador - {{$colaborador->nombre_completo}}@stop

@section('header') Agregar Ingreso a Colaborador - {{$colaborador->nombre_completo}}@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_ingreso_colaborador',$colaborador->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}

				<div class="row">
					<div class="col-lg-3">{!! Field::select('ingreso_salario_id',$ingresos,null,['data-required'=>'true']) !!}</div>
					<div class="col-lg-3">{!! Field::text('valor',null,['data-required'=>'true']) !!}</div>
				</div>

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_colaborador',$colaborador->id) }}#ingresos" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop