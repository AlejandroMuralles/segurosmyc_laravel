@extends('layouts.admin')

@section('title') Agregar Declaración - Poliza {{$poliza->numero}} @stop

@section('header') Agregar Declaración - Poliza {{$poliza->numero}} @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_declaracion_hidrocarburo',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::select('petrolera_id', $petroleras, null, ['data-required'=>'true']) !!}

				{!! Field::text('galones',null,['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza_hidrocarburos',$poliza->id) }}#declaraciones" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop