@extends('layouts.admin')

@section('title') Aprobar Exclusión @stop

@section('header') Aprobar Exclusión @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($exclusion, ['route' => array('aprobar_poliza_exclusion',$exclusion->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::text('solicitud', $exclusion->numero_solicitud, ['data-required'=>'false', 'disabled']) !!}
				{!! Field::text('endoso', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Aprobar" class="btn btn-primary">
	                <a href="{{ route('ver_poliza',$exclusion->poliza_id) }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop