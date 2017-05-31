@extends('layouts.admin')

@section('title') Agregar Puesto @stop

@section('header') Agregar Puesto @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="portlet portlet-default">
            <div class="portlet-heading">
                <div class="portlet-title">
                    <h4></h4>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="portlet-body">

	            {!! Form::open(['route' => array('agregar_puesto'), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
				
					{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

					{!! Field::select('area_id', $areas, '', ['data-required'=>'true']) !!}

					{!! Field::select('estado', $estados, '', ['data-required'=>'true']) !!}

					<br/>

		            <p>
		                <input type="submit" value="Agregar" class="btn btn-primary">
		                <a href="{{ route('puestos') }}" class="btn btn-danger">Cancelar</a>
		            </p>

	            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop