@extends('layouts.reporte')
@section('title')
  Solicitud de Modificación - Poliza {{$poliza->numero}}
@stop
@section('css')
<style type="text/css">
  
table td{
  font-size: 10px !important;
}

</style>
@stop
@section('content')
  <div id="content">
    <h4 class="title">Datos Generales de la Póliza</h4>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-bordered" style="margin-top: 3px">
      <tbody>
        <tr>
          <td colspan="4">
            Solicitud No.: {{$modificacion->numero_solicitud}}
          </td>
          <td colspan="8">
            Solicita: {{$poliza->usuario_actualiza->colaborador->nombre_completo}}
          </td>
        </tr>
        <tr>
          <td colspan="12">
            Fecha de Vigencia:
            desde {{ date('d-m-Y', strtotime($poliza->fecha_inicio)) }} hasta {{date('d-m-Y', strtotime($poliza->fecha_fin)) }}
          </td>
        </tr>
      </tbody>
    </table>
    <h4 class="title">Datos del Asegurado</h4>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-bordered" style="margin-top: 3px">
      <tbody>
        <tr>
          <td colspan="12">
            @if($poliza->cliente->tipo_cliente == 'C')
            Nombres y Apellidos:  
            @else
            Razón Social:
            @endif
            {{$poliza->cliente->nombre}}
          </td>
        </tr>
        <tr>
          <td colspan="5">
            DPI/Pasaporte: {{$poliza->cliente->dpi}}
          </td>
          <td colspan="4">
            NIT: {{$poliza->cliente->nit}}
          </td>
          <td colspan="3">
            Sexo: {{$poliza->cliente->descripcion_genero}}
          </td>
        </tr>
        <tr>
          <td colspan="4">Estado Civil <br/></td>
          <td colspan="4">Fecha de Nacimiento: <br/> {{ date('d-m-Y', strtotime($poliza->cliente->fecha_nacimiento)) }}</td>
          <td colspan="4">Lugar de Nacimiento: <br/> {{ $poliza->cliente->paisFiscal->nombre }} </td>
        </tr>
        <tr>
          <td colspan="4">Tipo de Actividad: <br/> {{$poliza->cliente->tipo_actividad}} </td>
          <td colspan="4">Profesión: <br/> {{$poliza->cliente->profesion}}</td>
          <td colspan="4">Oficio: <br/> {{$poliza->cliente->oficio}}</td>
        </tr>
        <tr>
          <td colspan="12">Dirección: {{$poliza->cliente->direccion_fiscal}} @if(!is_null($poliza->cliente->zona_fiscal))
              Zona {{$poliza->cliente->zona_fiscal}}
            @endif </td>
        </tr>
        <tr>
          <td colspan="6">Municipio: {{$poliza->cliente->municipioFiscal->nombre}} </td>
          <td colspan="6">Departamento: {{$poliza->cliente->departamentoFiscal->nombre}} </td>
        </tr>
      </tbody>
    </table>    
    <h4 class="title">Datos de Facturación</h4>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-bordered" style="margin-top: 0px">
      <tbody>
        <tr>
          <td colspan="12">
            @if($poliza->cliente->tipo_cliente == 'C')
            Nombres y Apellidos:  
            @else
            Razón Social:
            @endif
            {{$poliza->cliente->nombre_facturacion}}
          </td>
        </tr>
        <tr>
          <td colspan="12">
            NIT: {{$poliza->cliente->nit}}
          </td>
        </tr>
        <tr>
          <td colspan="12">
            Dirección: {{$poliza->cliente->direccion_facturacion}} 
            @if(!is_null($poliza->cliente->zona_facturacion))
              Zona {{$poliza->cliente->zona_facturacion}}
            @endif
          </td>
        </tr>
      </tbody>
    </table>
    <h4 class="title">DATOS A MODIFICAR</h4>
    <div class="ribbon bg-maroon"></div>
    @foreach($cambios as $cambio)
      <table class="table table-responsive">
        <thead>
        	<tr>
	        	<th>TIPO</th>
	        	<th>SOLICITANTE</th>
	        	<th>CAMBIO</th>
	        </tr>
        </thead>
        <tbody> 
          	<tr>
	            <td>{{$cambio->tipo_poliza_modificacion->descripcion}}</td>
	            <td>{{$cambio->descripcion_solicitante}}</td>
	            <td>{{$cambio->cambio}}</td>
          	</tr>
        </tbody>
      </table>
      <br/>      
    @endforeach
  </div>
@stop