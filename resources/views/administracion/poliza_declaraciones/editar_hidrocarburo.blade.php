@extends('layouts.admin')

@section('title') Editar Declaración {{$declaracion->numero_solicitud}} @stop

@section('header') Editar Declaración {{$declaracion->numero_solicitud}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($declaracion, ['route' => array('editar_poliza_declaracion_hidrocarburo',$declaracion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('petrolera_id', $petroleras, null, ['data-required'=>'true']) !!}

				{!! Field::text('galones',null,['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza_hidrocarburos',$declaracion->poliza_id) }}#declaraciones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop