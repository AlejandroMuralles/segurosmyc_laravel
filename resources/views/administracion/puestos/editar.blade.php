@extends('layouts.admin')

@section('title') Editar Puesto @stop

@section('header') Editar Puesto @stop

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

	            {!! Form::model($puesto, ['route' => array('editar_puesto', $puesto->id), 'method' => 'PUT', 'id' => 'form', 'class' => 'validate-form']) !!}
				
					{!! Field::text('nombre', null, ['data-required'=>'true']) !!}

					{!! Field::select('area_id', $areas, $puesto->area->id, ['id'=>'area', 'data-required'=>'true']) !!}

					{!! Field::select('estado', $estados, '', ['data-required'=>'true']) !!}

					<br/>

		            <p>
		                <input type="submit" value="Editar" class="btn btn-primary">
		                <a href="{{ route('puestos') }}" class="btn btn-danger">Cancelar</a>
		            </p>

	            {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@stop