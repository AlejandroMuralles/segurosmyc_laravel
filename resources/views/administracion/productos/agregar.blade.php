@extends('layouts.admin')

@section('title') Agregar Producto @stop

@section('header') Agregar Producto @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

            {!! Form::open(['route' => array('agregar_producto'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

				{!! Field::select('aseguradora_id', $aseguradoras, '', ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('productos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
            
		</div>
	</div>
</div>
@stop