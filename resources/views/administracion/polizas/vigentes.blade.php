@extends('layouts.admin')

@section('title') Listado de Pólizas Vigentes @stop

@section('header') Listado de Pólizas Vigentes @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
<style>
tfoot input {
    width: 100%;
    padding: 3px;
    box-sizing: border-box;
    color: black !important;
}
tfoot.search {
    display: table-header-group;
}
</style>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive">
            	<br/><br/>
                <table id="table" class="table">
					<thead>
						<tr>
							<th>ESTADO</th>
							<th>NUMERO</th>
							<th>ASEGURADORA</th>
							<th>CLIENTE</th>
							<th>CONSORCIO</th>
							<th>RAMO</th>
							<th>TIPO PAGO</th>
							<th>DIAS RENOVACION</th>
							<th width="100px;"></th>
						</tr>
					</thead>
					<tfoot class="search">
						<tr>
							<th></th>
							<th class="searchField">NUMERO</th>
							<th class="searchField">ASEGURADORA</th>
							<th class="searchField">CLIENTE</th>
							<th class="searchField">CONSORCIO</th>
							<th class="searchField">RAMO</th>
							<th class="searchField">TIPO PAGO</th>
							<th></th>
							<th width="100px;"></th>
						</tr>
					</tfoot>
					<tbody>
						@foreach($polizas as $poliza)
							<tr class="@if($poliza->dias_renovacion <= 30) bg-red text-white @endif">
								<td>{{ $poliza->descripcion_estado }}</td>
								<td>{{ $poliza->numero }}</td>
								<td>{{ $poliza->aseguradora->nombre }}</td>
								<td>{{ $poliza->cliente->nombre }}</td>
								<td>
									@if(!is_null($poliza->cliente->consorcio))
										{{$poliza->cliente->consorcio->nombre}}
									@endif
								</td>
								<td>{{ $poliza->ramo->nombre }}</td>
								<td>{{ $poliza->tipo_pago_poliza }}</td>
								<td>{{ $poliza->dias_renovacion }}</td>
								<td>
									@if($poliza->ramo_id == 1 || $poliza->ramo_id == 5)
										@if($poliza->anual_declarativa == 'A')
											<a href="{{route('ver_poliza',$poliza->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><i class="fa fa-eye"></i></a>
										@elseif($poliza->anual_declarativa == 'D')
											<a href="{{route('ver_poliza_declarativa',$poliza->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><i class="fa fa-eye"></i></a>
										@endif
									@elseif($poliza->ramo_id == 6)
										<a href="{{route('ver_poliza_hidrocarburos',$poliza->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Ver"><i class="fa fa-eye"></i></a>
									@endif
									<a href="{{route('editar_poliza',$poliza->id)}}" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fa fa-edit"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop
@section('js')
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/datatables-bs3.js') }}"></script>
<script>
	$(document).ready(function() {
	    // Setup - add a text input to each footer cell
	    $('.table tfoot th.searchField').each( function () {
	        var title = $(this).text();
	        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
	    } );
	 
	    // DataTable
	    var table = $('.table').DataTable();
	 
	    // Apply the search
	    table.columns().every( function () {
	        var that = this;
	 
	        $( 'input', this.footer() ).on( 'keyup change', function () {
	            if ( that.search() !== this.value ) {
	                that
	                    .search( this.value )
	                    .draw();
	            }
	        } );
	    } );
	} );
</script>
@stop