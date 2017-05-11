@extends('layouts.admin')

@section('title') Agregar Observaciones a Poliza @stop

@section('header') Agregar Observaciones a Poliza @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_bitacora_poliza',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::textarea('observaciones', null, ['data-required'=>'true']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                @if($poliza->ramo_id == 1)
						@if($poliza->anual_declarativa == 'A')
							<a href="{{ route('ver_poliza',$poliza->id).'#observaciones' }}" class="btn btn-danger">Cancelar</a>
						@else
							<a href="{{ route('ver_poliza_declarativa',$poliza->id).'#observaciones' }}" class="btn btn-danger">Cancelar</a>
						@endif
					@elseif($poliza->ramod_id == 6)
						<a href="{{ route('ver_poliza_hidrocarburos',$poliza->id).'#observaciones' }}" class="btn btn-danger">Cancelar</a>
					@endif
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop