@extends('layouts.admin')

@section('title') Editar Colaborador @stop

@section('header') Editar Colaborador @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::model($colaborador, ['route' => array('editar_colaborador',$colaborador->id), 'files'=>true, 'method' => 'PUT', 'id' => 'form', 'class'=>'validate-form']) !!}
			
				<div class="row">
        			<div class="col-lg-6">{!! Field::text('nombres', null, ['data-required'=>'true']) !!}</div>
        			<div class="col-lg-6">{!! Field::text('apellidos', null, ['data-required'=>'true']) !!}</div>
        		</div>

				{!! Field::text('fecha_nacimiento', $colaborador->fecha_nacimiento, ['class'=>'fecha','data-required'=>'true']) !!}

				{!! Field::number('dpi', null, ['data-required'=>'true']) !!}

				{!! Field::number('sueldo_base', null, ['data-required'=>'true']) !!}

				<div class="form-group">
					<label for="sexo">Sexo</label><br/>
					<input type="radio" name="sexo" value="F" @if($colaborador->sexo == F) checked @endif> Femenino</input>&nbsp;&nbsp;&nbsp;
					<input type="radio" name="sexo" value="M" @if($colaborador->sexo == M) checked @endif> Masculino</input>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::text('telefono') !!}</div>
					<div class="col-lg-3">{!! Field::text('extension') !!}</div>
					<div class="col-lg-3">{!! Field::text('celular') !!}</div>
					<div class="col-lg-3">{!! Field::email('email') !!}</div>
				</div>

				<div class="row">
					<div class="col-lg-3">{!! Field::text('fecha_ingreso',null,['data-required'=>'true','class'=>'fecha']) !!}</div>
					<div class="col-lg-3">{!! Field::text('dias_vacaciones',null,['data-required'=>'true']) !!}</div>
				</div>

				

				<div class="row">
					<div class="col-lg-3">
						<label>Hora</label>
						<div class="input-append bootstrap-timepicker input-group">
	                        <input id="timepicker1" class="form-control" type="text" name="horario_entrada" />
	                        <span class="input-group-btn">
	                            <button class="btn btn-default add-on" type="button"><i class="fa fa-clock-o"></i>
	                            </button>
	                        </span>
                		</div>
					</div>
				</div>
           		<br/>

				{!! Field::select('puesto_id', $puestos, null, ['id'=>'puesto_id', 'data-required'=>'true']) !!}

				{!! Field::file('imagen') !!}

				<br/>

				<img src="{{asset('profile_pics/')}}/{{$colaborador->foto}}" alt="" height="150px">
	            
				<br/><br/>
	            
	            <p>
	                <input type="submit" value="Editar" class="btn btn-primary">
	                <a href="{{ route('colaboradores') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop

@section('js')
<script src="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    $(function(){
    	$('.fecha').datepicker({
    		format: 'yyyy-mm-dd',
		    autoclose: true,
		    todayHighlight: true
		});

		$('#timepicker1').timepicker({
			showMeridian: false,
			minuteStep: 30,
			defaultTime: '{{date("H:i",strtotime($colaborador->horario_entrada))}}'
		});
    });
</script>
@stop