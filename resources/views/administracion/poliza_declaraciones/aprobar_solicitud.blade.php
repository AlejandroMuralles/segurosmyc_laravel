@extends('layouts.admin')

@section('title') Aprobar Declaración @stop

@section('header') Aprobar Declaración @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($declaracion, ['route' => array('aprobar_poliza_declaracion',$declaracion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('solicitud', $declaracion->numero_solicitud, ['data-required'=>'false', 'disabled']) !!}
				{!! Field::text('endoso', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Aprobar" class="btn btn-primary">
	                @if($declaracion->poliza->ramo_id == 1)
	                	<a href="{{ route('ver_poliza_declarativa',$declaracion->poliza_id) }}#declaraciones" class="btn btn-danger">Cancelar</a>
	                @elseif($declaracion->poliza->ramo_id == 6)
	                	<a href="{{ route('ver_poliza_hidrocarburos',$declaracion->poliza_id) }}#declaraciones" class="btn btn-danger">Cancelar</a>
	                @endif
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop