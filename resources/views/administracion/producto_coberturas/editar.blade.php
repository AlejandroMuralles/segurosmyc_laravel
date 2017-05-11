@extends('layouts.admin')

@section('title') Editar Cobertura de Producto @stop

@section('header') Editar Cobertura de Producto @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            {!! Form::model($cobertura, ['route' => array('editar_producto_cobertura', $cobertura->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('cobertura', $cobertura->cobertura->nombre, ['disabled']) !!}


				{!! Field::checkbox('amparada') !!}
				<div class="row">
					<div class="col-lg-4">{!! Field::number('suma_asegurada') !!}</div>
					<div class="col-lg-4">{!! Field::number('pct_deducible') !!}</div>
					<div class="col-lg-4">{!! Field::number('deducible_minimo') !!}</div>
				</div>
				
				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('producto_coberturas',$cobertura->producto_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
	            
		</div>
	</div>
</div>
@stop