@extends('layouts.admin')
@section('title') Agregar Observaciones a Poliza @endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs3.css')}}">
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_bitacora_poliza',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
				{!! Field::textarea('observaciones', null, ['data-required'=>'true','id'=>'summernote']) !!}

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                @if($poliza->estado = 'S')
						<a href="{{ route($poliza->ruta_solicitud,$poliza->id).'#observaciones' }}" class="btn btn-danger">Cancelar</a>
	                @else
						<a href="{{ route($poliza->ruta,$poliza->id).'#observaciones' }}" class="btn btn-danger">Cancelar</a>
	                @endif
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/plugins/summernote/summernote.js')}}"></script>
<script>
	$(function()
	{
		$('#summernote').summernote({height: 300,});

		$('#form').on('submit', function(){
	    	$('#summernote').val($('#summernote').code());
	    });
	});
</script>
@endsection