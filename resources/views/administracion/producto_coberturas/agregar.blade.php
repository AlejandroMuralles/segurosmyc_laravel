@extends('layouts.admin')

@section('title') Agregar Coberturas - {{$producto->nombre}} @stop

@section('header') Agregar Coberturas - {{$producto->nombre}} @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        	{!! Form::open(['route' => array('agregar_producto_coberturas',$producto->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
            <div class="table-responsive">
                <table id="table" class="table">
					<thead>
						<tr>
							<th></th>
							<th>NOMBRE</th>
							<th>AMPARADA</th>
							<th>SUMA ASEGURADA</th>
							<th>PCT DEDUCIBLE</th>
							<th>DEDUCIBLE MINIMO</th>
						</tr>
					</thead>
					<tbody>
						@foreach($coberturas as $cobertura)
							<tr>
								<td width="25px">
									<input class="chkSelect" type="checkbox" id="{{$cobertura->id}}" name="coberturas[{{$cobertura->id}}][seleccionado]">
									<input type="hidden" name="coberturas[{{$cobertura->id}}][id]" value="{{$cobertura->id}}">
								</td>
								<td>{{ $cobertura->nombre }}</td>
								<td> <input type="checkbox" id="cob{{$cobertura->id}}amp" name="coberturas[{{$cobertura->id}}][amparada]"> </td>
								<td> <input type="number" id="cob{{$cobertura->id}}sumaseg" name="coberturas[{{$cobertura->id}}][suma_asegurada]" class="form-control" step="any"> </td>
								<td> <input type="number" id="cob{{$cobertura->id}}pctdec" name="coberturas[{{$cobertura->id}}][pct_deducible]" class="form-control" step="any"> </td>
								<td> <input type="number" id="cob{{$cobertura->id}}decmin" name="coberturas[{{$cobertura->id}}][deducible_minimo]" class="form-control" step="any"> </td>
							</tr>
						@endforeach
					</tbody>
				</table>
				<br/>
				<input type="submit" value="Agregar" class="btn btn-primary">
                <a href="{{ route('producto_coberturas',$producto->id) }}" class="btn btn-danger">Cancelar</a>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables-bs3.js') }}"></script>
<script>
	$(document).ready(function() {
   		var table = $('#table').dataTable({
   			"bSort" : false,
   			"iDisplayLength" : 10,
   			"aaSorting" : [[1, 'asc']]
   		});

   		$('#form').on('submit', function(e){
     		var form = this;
			// Iterate over all checkboxes in the table
			table.$('input.chkSelect').each(function(){
			 	// If checkbox doesn't exist in DOM
		 		if(!$.contains(document, this)){
			    	// If checkbox is checked
			    	if(this.checked){
			    		var id = this.id;
			       		// Create a hidden element 
			       		$('#form').append(
			          		$('<input>')
			             	.attr('type', 'hidden')
			             	.attr('name', this.name)
			             	.val(this.value)
		       			);
		       			$('#form').append(
		       				$('<input>')
			             	.attr('type', 'hidden')
			             	.attr('name', 'coberturas['+id+'][id]')
			             	.val(id)
		       			);
		       			var amparada = $('#cob'+id+'amp').val();
		       			var sumaseg = $('#cob'+id+'sumaseg').val();
		       			var pctdec = $('#cob'+id+'pctdec').val();
		       			var decmin = $('#cob'+id+'decmin').val();
		       			$('#form').append(
		       				$('<input>')
			             	.attr('type', 'hidden')
			             	.attr('name', 'coberturas['+id+'][amparada]')
			             	.val('on')
		       			);
		       			$('#form').append(
		       				$('<input>')
			             	.attr('type', 'hidden')
			             	.attr('name', 'coberturas['+id+'][suma_asegurada]')
			             	.val(sumaseg)
		       			);
		       			$('#form').append(
		       				$('<input>')
			             	.attr('type', 'hidden')
			             	.attr('name', 'coberturas['+id+'][pct_deducible]')
			             	.val(pctdec)
		       			);
		       			$('#form').append(
		       				$('<input>')
			             	.attr('type', 'hidden')
			             	.attr('name', 'coberturas['+id+'][deducible_minimo]')
			             	.val(decmin)
		       			);
			    	}
			 	} 
			});
   		});

	});
</script>
@stop