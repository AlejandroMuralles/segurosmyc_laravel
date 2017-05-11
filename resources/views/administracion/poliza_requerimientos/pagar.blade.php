@extends('layouts.admin')

@section('title') Pagar Requerimientos @stop

@section('header') Pagar Requerimientos @stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
		{!! Form::open(['route' => array('pagar_requerimientos',$poliza->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
        <div class="row">
        	<div class="col-lg-6">
        		<div class="table-responsive">
					<table class="table table-responsive">
						<thead>
							<tr>
								<th></th>
								<th>ESTADO</th>
								<th>NUMERO</th>
								<th>CUOTA</th>
								<th>FECHA DE PAGO</th>
								<th>MONTO</th>
							</tr>
						</thead>
						<tbody>
						@foraech($requerimientos as $requerimiento)
						<tr>
							<td>
								<input type="checkbox" name="requerimientos[{{$requerimiento->id}}][check]">
								<input type="hidden" name="requerimientos[{{$requerimiento->id}}][id]" value="{{$requerimiento->id}}">
							</td>
							<td>{{ $requerimiento->descripcion_estado }}</td>
							<td>{{ $requerimiento->numero }}</td>
							<td>{{ $requerimiento->cuota }}</td>
							<td>{{ $requerimiento->fecha_pago }}</td>
							<td>{{ number_format($requerimiento->monto,2) }}</td>							
						</tr>
						@endforeach
					</tbody>
					</table>
				</div>
        	</div>
        	<div class="col-lg-6">

				{!! Field::select('forma_pago',$formasPago,null,['data-required'=>'true']) !!}
				{!! Field::select('banco_id',$bancos,null,['data-required'=>'true']) !!}

        		<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('requerimientos_pendientes') }}" class="btn btn-danger">Cancelar</a>
	            </p>
        	</div>
        </div>
        {!! Form::close() !!}    
			
				

				

            
		</div>
	</div>
</div>
@stop