@extends('layouts.admin')

@section('title') Editar Tipo de Nomina @stop

@section('header') Editar Tipo de Nomina @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($tipoNomina, ['route' => array('editar_tipo_nomina', $tipoNomina->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}
				{!! Field::number('factor_divisor', null, ['data-required'=>'true', 'step'=>'any']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('tipos_nominas') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop