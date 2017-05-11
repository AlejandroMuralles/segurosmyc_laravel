@extends('layouts.admin')

@section('title') Nomina {{$nomina->tipo->descripcion}} {{ date('d/m/Y', strtotime($nomina->fecha_inicio))}} - {{ date('d/m/Y', strtotime($nomina->fecha_final))}} @stop

@section('header') Nomina {{$nomina->tipo->descripcion}} {{ date('d/m/Y', strtotime($nomina->fecha_inicio))}} - {{ date('d/m/Y', strtotime($nomina->fecha_final))}} @stop

@section('css')
<link href="{{ asset('assets/plugins/datatables/datatables.css')}}" rel="stylesheet">
<style>
	th, td{
		vertical-align: middle !important;
	}
</style>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="table-responsive" >
    			<table class="table table-striped  table-hover table-condensed stripe row-border order-column">
					<thead>
						<tr>
							<th class="text-center bg-blue text-white" style="width: 250px !important; ">COLABORADOR</th>
							<th class="text-center bg-blue text-white">DIAS TRABAJADOS</th>
							<th class="text-center bg-blue text-white">SUELDO ORDINARIO</th>
							<th class="text-center bg-blue text-white">DIAS VACACIONES</th>
							<th class="text-center bg-blue text-white">SUELDO VACACIONES</th>
							<th class="text-center bg-blue text-white">BONIFICACION DECRETO</th>
							<th class="text-center bg-blue text-white">OTRAS BONIFICACIONES</th>
							<th class="text-center bg-blue text-white">TOTAL INGRESOS</th>
							<th class="text-center bg-blue text-white">DIAS SUSPENSION IGSS</th>
							<th class="text-center bg-blue text-white">SUELDO IGSS</th>
							<th class="text-center bg-blue text-white">DIAS AUSENCIAS</th>
							<th class="text-center bg-blue text-white">SUELDO AUSENCIAS</th>
							<th class="text-center bg-blue text-white" style="width: 100px">ISR</th>
							<th class="text-center bg-blue text-white">OTRAS DEDUCCIONES</th>
							<th class="text-center bg-blue text-white">LIQUIDO RECIBIDO</th>
							<th class="text-center bg-blue text-white">PROVISION BONO 14</th>
							<th class="text-center bg-blue text-white">PROVISION AGUINALDO</th>
						</tr>
					</thead>
					<tbody>
						@foreach($detalle as $dn)
							<tr>
								<td class="text-center" style="width: 250px !important;">{{ $dn->colaborador->nombre_completo }}</td>
								<td class="text-center">{{ $dn->dias_trabajados }}</td>
								<td class="text-right">Q. {{ number_format($dn->sueldo_ordinario,2) }}</td>
								<td class="text-center">{{ number_format($dn->dias_vacaciones,0) }}</td>
								<td class="text-right">Q. {{ number_format($dn->sueldo_vacaciones,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->bonificacion_decreto,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->otras_bonificaciones,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->total_ingresos,2) }}</td>
								<td class="text-center">{{ number_format($dn->dias_suspension_igss,0) }}</td>
								<td class="text-right">Q. {{ number_format($dn->sueldo_igss,2) }}</td>
								<td class="text-center">{{ number_format($dn->dias_ausencias,0) }}</td>
								<td class="text-right">Q. {{ number_format($dn->sueldo_ausencias,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->isr,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->otras_deducciones,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->liquido_recibido,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->provision_bon14,2) }}</td>
								<td class="text-right">Q. {{ number_format($dn->provision_aguinaldo,2) }}</td>
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
<script src="{{ asset('assets/plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>
<script>
	$(document).ready(function() {
   		var table = $('.table').DataTable( {
						scrollY:        "300px",
				        scrollX:        true,
				        scrollCollapse: true,
				        paging:         false,
				        fixedColumns:   {
				            leftColumns: 3
				        }
			    	});
	});
</script>
@stop