@extends('layouts.reporte')
@section('title')
  Renovación de Póliza <br/> {{$poliza->numero}}
@stop
@section('content')
  <div id="content">
    <h4 class="title">Datos Generales de la Póliza</h4>
    <div class="ribbon bg-maroon"></div>
    <table class="table table-bordered" style="margin-top: 3px">
      <tbody>
        <tr>
          <td colspan="4">
            Solicitud No.: {{$poliza->numero_solicitud}}
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
            Nombres y apellidos o Razón Social:  
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
            Nombres y apellidos o Razón Social:  {{$poliza->cliente->nombre_facturacion}}
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
    <h4 style="page-break-before: always;" class="title">Datos de Vehículos</h4>
    <div class="ribbon bg-maroon"></div>
    @foreach($vehiculos as $v)
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="8" class="title"> Numero de Placa: {{ $v->vehiculo->placa }} </th>
          </tr>
        </thead>
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
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="10" class="title"> Valores </th>
          </tr>
        </thead>
        <tbody> 
          <tr>
            <td colspan="2">Suma Asegurada: <br/>Q. {{ number_format($v->suma_asegurada,2) }} </td>
            <td colspan="2">Prima Neta: <br/>Q. {{ number_format($v->prima_neta,2) }} </td>
            <td colspan="2">Prima Total: <br/>Q. {{ number_format($v->prima_total,2) }} </td>
            <td colspan="2">Deducible de Daños: <br/> {{ $v->pct_deducible_dano }}% </td>
            <td colspan="2">Deducible de Robo: {{ $v->pct_deducible_robo }}% </td>
          </tr>
        </tbody>
      </table>
      @if(count($v->coberturasParticulares) > 0)
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td colspan="10" class="sub-title">Coberturas Particulares</td>
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
      <br/>      
    @endforeach
    <h2 style="page-break-before: always;" class="title">Coberturas Generales</h2>
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
  </div>
@stop