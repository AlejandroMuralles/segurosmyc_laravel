@extends('layouts.admin')

@section('title') Editar Ingreso a Colaborador - {{$colaborador->nombre_completo}}@stop

@section('header') Editar Ingreso a Colaborador - {{$colaborador->nombre_completo}}@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($ingreso, ['route' => array('editar_ingreso_colaborador',$ingreso->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}

				<div class="row">
					<div class="col-lg-3">{!! Field::text('ingreso',$ingreso->ingreso->descripcion, ['disabled']) !!}</div>
					<div class="col-lg-3">{!! Field::text('valor',null,['data-required'=>'true']) !!}</div>
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