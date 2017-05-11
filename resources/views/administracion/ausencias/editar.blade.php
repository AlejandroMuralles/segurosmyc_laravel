@extends('layouts.admin')

@section('title') Editar Ausencia @stop

@section('header') Editar Ausencia @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($ausencia, ['route' => array('editar_ausencia', $ausencia->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('descripcion', null, ['data-required'=>'true']) !!}
				{!! Field::checkbox('afecta_salario') !!}
				{!! Field::checkbox('incluye_septimo') !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ausencias') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop