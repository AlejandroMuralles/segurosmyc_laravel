<html>
<head>
  
  <link href="{{asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/custom_reports.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/tables.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
  <style>
    @page { margin: 125px 50px; }
    #header { position: fixed; left: 0px; top: -125px; right: 0px; height: 100px; text-align: center; padding-top: 10px;}
    #footer { position: fixed; left: 0px; bottom: -125px; right: 0px; height: 100px; text-align: center; display: block}
    #footer .page:after { content: counter(page); }
    .logo { float: left; height: 100px;  }
    .table-bordered td { border-top: 1px solid #ddd !important; border-bottom: 1px solid #ddd !important; width: 8.33% }
    .table-bordered td, th {border-color: black !important}
    .table { margin: 0; }
    body { background: white; }
  </style>

<body>
  <div id="header">
    <img src="{{asset('assets/images/logo_sm.png')}}" class="logo" style="vertical-align: middle;">
    <h1>Solicitud de Póliza</h1>
  </div>
  <div id="footer">
    <p style="font-weight: bold;">
      "La respuesta amiga a tu confianza" <br/>
      12 calle 2-04 zona 9, Edificio Plaza del sol, 1er. Nivel, Oficina 107 PBX: 2360-9686 - FAX: 2381-8738
    </p>
  </div>
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
    <br/>
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
				    <td colspan="2"><span class="font14">Suma Asegurada:</span> <br/>Q. {{ number_format($v->suma_asegurada,2) }} </td>
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
	    <table class="table table-bordered" style="margin-top: 3px">
	      	<tbody>
	      		<tr>
        			<th colspan="12" class="title"> Datos de Facturación </th>
  				</tr>
		        <tr>
	          		<td colspan="12">
		            @if($v->cliente->tipo_cliente == 'C')
                Nombres y Apellidos:  
                @else
                Razón Social:
                @endif
                {{$v->cliente->nombre_facturacion}}
		          	</td>
		        </tr>
		        <tr>
	          		<td colspan="12">
		            NIT: {{$v->cliente->nit}}
		          	</td>
		        </tr>
		        <tr>
		          	<td colspan="12">
		            Dirección: {{$v->cliente->direccion_facturacion}} 
		            @if(!is_null($v->cliente->zona_facturacion))
		              Zona {{$v->cliente->zona_facturacion}}
		            @endif
		          	</td>
		        </tr>
	      	</tbody>
	    </table>
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
</body>
</html>