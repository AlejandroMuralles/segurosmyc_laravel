@extends('layouts.admin')

@section('title') Agregar Coberturas a Póliza por Producto @stop

@section('header') Agregar Coberturas a Póliza por Producto @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">

			<div class="row">
				<div class="col-lg-4">{!! Field::select('producto_id',$productos, $productoId, ['id'=>'productoId']) !!}</div>
			</div>

			@if(isset($coberturas))
				<div class="row">
					<div class="col-lg-9">
			            {!! Form::open(['route' => array('agregar_poliza_producto',$poliza->id, $productoId), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
						
							<table class="table table-responsive" id="table_coberturas">
								<thead>
									<tr>
										<th>ID</th>
										<th>COBERTURA</th>
										<th>SUMA ASEGURADA</th>
										<th>PORCENTAJE DEDUCIBLE</th>
										<th>DEDUCIBLE</th>
										<th>MINIMO</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($coberturas as $cobertura)
										<tr>
											<td>{{$cobertura->cobertura->id}}</td>
											<td>
												<input type="hidden" value="{{$poliza->id}}" name="coberturas[{{$cobertura->cobertura->id}}][poliza_id]" class="form-control">
												<input type="hidden" value="{{$cobertura->cobertura->id}}" name="coberturas[{{$cobertura->cobertura->id}}][cobertura_id]" class="form-control">
												{{$cobertura->cobertura->nombre}}
											</td>
											<td>
												<input type="number" step="any" value="0" name="coberturas[{{$cobertura->cobertura->id}}][suma_asegurada]" class="form-control"
														data-required="true">
											</td>
											<td>
												<input type="number" step="any" value="0" name="coberturas[{{$cobertura->cobertura->id}}][porcentaje_deducible]" class="form-control"
														data-required="true">
											</td>
											<td>
												<input type="number" step="any" value="0" name="coberturas[{{$cobertura->cobertura->id}}][deducible]" class="form-control"
														data-required="true">
											</td>
											<td>
												<input type="number" step="any" value="0" name="coberturas[{{$cobertura->cobertura->id}}][deducible_minimo]" class="form-control"
														data-required="true">
											</td>
											<td><a class="eliminar-cobertura btn btn-danger"><i class="fa fa-times"></i></a></td>
										</tr>
									@endforeach
								</tbody>
							</table>

							<br/>

				            <p>
				                <input type="submit" value="Agregar" class="btn btn-primary">
				                <a href="{{ route('ver_solicitud_poliza',$poliza->id) }}" class="btn btn-danger">Cancelar</a>
				            </p>
			            {!! Form::close() !!}
			        </div>
				</div>
            @endif
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

		$('#productoId').on('change',function()
		{
			var productoId = $(this).val();
			if(productoId == ''){
				productoId = 0;
			}
			window.location.href = "{{route('inicio')}}/Polizas-Coberturas/agregar-producto/{{$poliza->id}}/"+productoId;
		});

		$(".eliminar-cobertura").on('click', function(e) {
		    var whichtr = $(this).closest("tr");
		    whichtr.remove();      
		});
    });
</script>
@stop