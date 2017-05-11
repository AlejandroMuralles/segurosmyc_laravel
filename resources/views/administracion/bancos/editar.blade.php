@extends('layouts.admin')

@section('title') Editar Banco @stop

@section('header') Editar Banco @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($banco, ['route' => array('editar_banco', $banco->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('bancos') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop