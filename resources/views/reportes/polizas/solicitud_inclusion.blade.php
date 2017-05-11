@extends('layouts.reporte')
@section('title')
  Solicitud de Inclusión - Poliza {{$poliza->numero}}
@stop
@section('css')
<style type="text/css">
  
table td{
  font-size: 10px !important;
  padding-top: 1px !important;
  padding-bottom: 1px !important;
  color: black !important;
}
table th{
  font-size: 10px !important;
  padding-top: 1px !important;
  padding-bottom: 1px !important;
}
table{
  border-collapse: collapse !important;
  margin-bottom: 5px !important;
  margin-top: 5px !important;
}
h6{
  margin-top: 0 !important;
}

</style>
@stop
@section('content')
  <div id="content">
    <h6 class="title">DATOS GENERALES DE LA PÓLIZA</h6>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td colspan="6">
            Solicitud No.: {{$inclusion->numero_solicitud}}
          </td>
          <td colspan="6">
            Solicita: {{$inclusion->usuario_actualiza->colaborador->nombre_completo}}
          </td>
        </tr>
        <tr>
          <td colspan="6">
            Fecha de Vigencia:
            desde {{ date('d-m-Y', strtotime($poliza->fecha_inicio)) }} hasta {{date('d-m-Y', strtotime($poliza->fecha_fin)) }}
          </td>
          <td colspan="6">
            Fecha de Solicitud: {{date('d-m-Y')}}
          </td>
        </tr>
        <tr>
          <td colspan="6">
            Aseguradora: {{$poliza->aseguradora->nombre}}
          </td>
          <td colspan="6">
            Dirigida a: {{$poliza->dirigida_a}}
          </td>
        </tr>
      </tbody>
    </table>
    <h6 class="title">Datos del Asegurado</h6>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-bordered">
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
          <td colspan="4">DPI/Pasaporte: {{$poliza->cliente->dpi}}</td>
          <td colspan="4">NIT: {{$poliza->cliente->nit}}</td>
          <td colspan="4">Sexo: @if($poliza->cliente->tipo_cliente == 'C') {{$poliza->cliente->descripcion_genero}} @endif</td>
        </tr>
        <tr>
          <td colspan="4">Estado Civil: </td>
          <td colspan="4">Fecha de Nacimiento: {{ date('d-m-Y', strtotime($poliza->cliente->fecha_nacimiento)) }}</td>
          <td colspan="4">Lugar de Nacimiento: {{ $poliza->cliente->paisFiscal->nombre }} </td>
        </tr>
        <tr>
          <td colspan="4">Tipo de Actividad: {{$poliza->cliente->tipo_actividad}} </td>
          <td colspan="4">Profesión: {{$poliza->cliente->profesion}}</td>
          <td colspan="4">Oficio: {{$poliza->cliente->oficio}}</td>
        </tr>
        <tr>
          <td colspan="12">Dirección: {{$poliza->cliente->direccion_fiscal}} </td>
        </tr>
        <tr>
          <td colspan="6">Municipio: {{$poliza->cliente->municipioFiscal->nombre}} </td>
          <td colspan="6">Departamento: {{$poliza->cliente->departamentoFiscal->nombre}} </td>
        </tr>
      </tbody>
    </table>  
    <h6 class="title">Datos de Facturación</h6>
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
          </td>
        </tr>
      </tbody>
    </table>
    <h6 class="title">DATOS DE VEHÍCULOS A INCLUIR</h6>
    <div class="ribbon bg-maroon"></div>
    @foreach($vehiculosIncluir as $v)
      <h6 style="padding: 2px 5px !important; margin: 5px 0 0 0 !important; background-color: #0b2037; color: white"> 
      NUMERO DE PLACA: {{ $v->vehiculo->placa }}
      </h6>
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td colspan="2">Marca: {{ $v->vehiculo->marca->nombre }} </td>
            <td colspan="2">Línea: {{ $v->vehiculo->linea }} </td>
            <td colspan="2">Tipo: {{ $v->vehiculo->tipoVehiculo->nombre }} </td>
            <td colspan="2">Modelo: {{ $v->vehiculo->modelo }} </td>
          </tr>
          <tr>
            <td colspan="2"> Cilindraje: {{ $v->vehiculo->cilindraje }} </td>
            <td colspan="2"> No. Chasis / VIN:  {{ $v->vehiculo->numero_chasis }} </td>
            <td colspan="2"> No. Motor: {{ $v->vehiculo->numero_motor }} </td>
            <td colspan="2"> No. Asientos: {{ $v->vehiculo->numero_asientos }} </td>
          </tr>
          <tr>
           <td colspan="4">Color: {{ $v->vehiculo->color }} </td>
           <td colspan="4"> Uso: {{ $v->vehiculo->uso }} </td>
          </tr>
          <tr>
            <td colspan="8"> Garantía prendaria a favor de: </td>
          </tr>    
        </tbody>
      </table>
      <h6 style="padding: 2px 5px !important; margin: 0 !important; background-color: #0b2037; color: white"> VALORES</h6>
      <table class="table table-bordered">
        <tbody> 
          <tr>
            <td colspan="6">Suma Asegurada: Q. {{ number_format($v->suma_asegurada,2) }} </td>
            <td colspan="6">Suma Asegurada Blindaje: Q. {{ number_format($v->suma_asegurada_blindaje,2) }} </td>
          </tr>
          <tr>
            <td colspan="3">Prima Neta: Q. {{ number_format($v->prima_neta,2) }} </td>
            <td colspan="3">Prima Total: Q. {{ number_format($v->prima_total,2) }} </td>
            <td colspan="3">Deducible de Daños: {{ $v->pct_deducible_dano }}% </td>
            <td colspan="3">Deducible de Robo: {{ $v->pct_deducible_robo }}% </td>
          </tr>
        </tbody>
      </table>
      @if(count($v->coberturasParticulares) > 0)
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td colspan="10" class="sub-title">Coberturas Particulares a Incluir</td>
          </tr>
          <tr>
            <th colspan="4" class="text-center">COBERTURA</th>
            <th colspan="3" class="text-center">SUMA ASEGURADA</th>
            <th colspan="3" class="text-center">DEDUCIBLE</th>
          </tr>
          @foreach($v->coberturasParticulares as $cp)
          <tr>
            <td colspan="4">{{$cp->cobertura->nombre}}</td>
            <td colspan="3" class="text-right">Q. {{ number_format($cp->suma_asegurada,2) }} </td>
            <td colspan="3" class="text-right">Q. {{ number_format($cp->deducible,2) }} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif     
    @endforeach
	@if( count($coberturasGeneralesIncluir) > 0)
    <h2 class="title">COBERTURAS GENERALES A INCLUIR</h2>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-responsive">
      <thead>
        <tr>
          <th class="text-center">COBERTURA</th>
          <th class="text-center">SUMA ASEGURADA</th>
          <th class="text-center">DEDUCIBLE</th>
        </tr>
      </thead>
      <tbody>
        @foreach($coberturasGeneralesIncluir as $cg)
        <tr>
          <td>{{$cg->cobertura->nombre}}</td>
          <td class="text-right">Q. {{ number_format($cg->suma_asegurada,2)}}</td>
          <td class="text-right">Q. {{ number_format($cg->deducible,2)}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
    @if( count($coberturasGenerales) > 0)
    <h6 class="title">COBERTURAS GENERALES</h6>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-responsive">
      <thead>
        <tr>
          <th class="text-center">COBERTURA</th>
          <th class="text-center">SUMA ASEGURADA</th>
          <th class="text-center">DEDUCIBLE</th>
        </tr>
      </thead>
      <tbody>
        @foreach($coberturasGenerales as $cg)
        <tr>
          <td>{{$cg->cobertura->nombre}}</td>
          <td class="text-right">Q. {{ number_format($cg->suma_asegurada,2)}}</td>
          <td class="text-right">Q. {{ number_format($cg->deducible,2)}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>
@stop