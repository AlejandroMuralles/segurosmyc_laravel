@extends('layouts.admin')

@section('title') Editar Producto @stop

@section('header') Editar Producto @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            {!! Form::model($producto, ['route' => array('editar_producto', $producto->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

				{!! Field::select('aseguradora_id', $aseguradoras, $producto->aseguradora->id, ['id'=>'aseguradora', 'data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('productos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
	            
		</div>
	</div>
</div>
@stop