<?php

namespace App\App\Components;

class StaticVariables {


	protected $tipoUsuario = [
		'Administrador' => 1
	];

	protected $generos = [
		'F' 	=> 'FEMENINO',
		'M' 	=> 'MASCULINO',
	];

	protected $empresasCelular = [
		'CLARO' 	=> 'CLARO',
		'TIGO' 		=> 'TIGO',
		'MOVISTAR' 	=> 'MOVISTAR'
	];

	protected $estadosGenerales = [
		'A' => 'ACTIVO',
		'I' => 'INACTIVO'
	];

	protected $estadosColaborador = [
		'C' => 'CONTRATADO',
		'R' => 'RENUNCIA',
		'D' => 'DESPEDIDO'
	];

	protected $estadosDescuentos = [
		'A' => 'ACTIVO',
		'I' => 'INACTIVO',
		'S' => 'SUSPENDIDO'
	];

	protected $estadosRequerimientos = [
		'C' => 'COBRADO',
		'N' => 'NO COBRADO',
		'A' => 'ANULADO'
	];

	protected $estadosReclamos = [
		'S' => 'SOLICITUD',
		'V' => 'APROBADO',
		'R' => 'RECHAZADO',
		'A' => 'ANULADO'
	];

	protected $estadosCobros = [
		'C' => 'COBRADO',
		'N' => 'NO COBRADO',
		'A' => 'ANULADO'
	];

	protected $estadosNominas = [
		'P' => 'PENDIENTE',
		'A' => 'ANULADA',
		'G' => 'GENERADA',
		'C' => 'PAGADA' //cancelada 
	];

	protected $estadosPoliza = [
		'S'	=> 'SOLICITUD',
		'V' => 'VIGENTE',
		'A' => 'ANULADA',
		'C' => 'CANCELADA',
		'R' => 'RENOVADA'
	];

	protected $estadosPolizaVehiculo = [
		'P'	 => 'EMISION',
		'V'  => 'VIGENTE',
		'E'  => 'EXCLUIDO',
		'SE' => 'S. EXCLUSION',
		'A'  => 'ANULADO',
		'R'  => 'RENOVADO'
	];

	protected $estadosPolizaCobertura = [
		'P'	 => 'EMISION',
		'V'  => 'VIGENTE',
		'E'  => 'EXCLUIDA',
		'SE' => 'S. EXCLUSION',
		'A'  => 'ANULADA',
		'R'  => 'RENOVADA'
	];

	protected $tiposPlaca = [
		'P'  => 'PARTICULAR',
		'C'  => 'COMERCIAL',
		'TC' => 'TRANSPORTE COMERCIAL',
		'M'  => 'MOTOCICLETA'
	];

	protected $tiposPlanilla = [
		1  => 'POR ASEGURADORA',
		2  => 'POR POLIZA',
	];

	protected $solicitantesPolizaModificaciones = [
		1  => 'ASEGURADORA',
		2  => 'CLIENTE',
	];

	protected $impuestos = [
		'IVA' => 1,
		'EMISION' => 2,
	];

	protected $formasPago = [
		'C' => 'CHEQUE',
		'T' => 'TRANSFERENCIA',
		'D' => 'DEPOSITO',
		'E' => 'EFECTIVO',
		'TC' => 'TARJETA DE CREDITO'
	];

	protected $tiposPagoPoliza = [
		'A' => 'ANUAL',
		'D' => 'DECLARATIVA'
	];

	protected $prefixSolicitudPoliza = 'SP-';
	protected $prefixSolicitudInclusion = 'SI-';
	protected $prefixSolicitudExclusion = 'SE-';
	protected $prefixSolicitudDeclaracion = 'SD-';
	protected $prefixSolicitudModificacion = 'SM-';
	protected $prefixSolicitudReclamo = 'SR-';

	public function STipoUsuario($key) { return $this->tipoUsuario[$key]; }
	public function getImpuesto($key) { return $this->impuestos[$key]; }

	public function getGeneros() { return $this->generos; }
	public function getGenero($key) { return $this->generos[$key]; }

	public function getEmpresasCelular() { return $this->empresasCelular; }
	public function getEmpresaCelular($key) { return $this->empresasCelular[$key]; }

	public function getEstadosGenerales() { return $this->estadosGenerales; }
	public function getEstadoGeneral($key) { return $this->estadosGenerales[$key]; }

	public function getEstadosColaborador() { return $this->estadosColaborador; }
	public function getEstadoColaborador($key) { return $this->estadosColaborador[$key]; }

	public function getEstadosDescuentos() { return $this->estadosDescuentos; }
	public function getEstadoDescuento($key) { return $this->estadosDescuentos[$key]; }

	public function getEstadosRequerimientos() { return $this->estadosRequerimientos; }
	public function getEstadoRequerimiento($key) { return $this->estadosRequerimientos[$key]; }

	public function getEstadosReclamos() { return $this->estadosReclamos; }
	public function getEstadoReclamo($key) { return $this->estadosReclamos[$key]; }

	public function getEstadosCobros() { return $this->estadosCobros; }
	public function getEstadoCobro($key) { return $this->estadosCobros[$key]; }

	public function getEstadosNominas() { return $this->estadosNominas; }
	public function getEstadoNomina($key) { return $this->estadosNominas[$key]; }

	public function getEstadosPoliza() { return $this->estadosPoliza; }
	public function getEstadoPoliza($key) { return $this->estadosPoliza[$key]; }

	public function getEstadosPolizaVehiculo() { return $this->estadosPolizaVehiculo; }
	public function getEstadoPolizaVehiculo($key) { return $this->estadosPolizaVehiculo[$key]; }

	public function getTiposPlaca() { return $this->tiposPlaca; }
	public function getTipoPlaca($key) { return $this->tiposPlaca[$key]; }

	public function getTiposPlanilla() { return $this->tiposPlanilla; }
	public function getTipoPlanilla($key) { return $this->tiposPlanilla[$key]; }

	public function getTiposPagoPoliza() { return $this->tiposPagoPoliza; }
	public function getTipoPagoPoliza($key) { return $this->tiposPagoPoliza[$key]; }

	public function getPrefixSolicitudPoliza(){ return $this->prefixSolicitudPoliza; }
	public function getPrefixSolicitudInclusion(){ return $this->prefixSolicitudInclusion; }
	public function getPrefixSolicitudExclusion(){ return $this->prefixSolicitudExclusion; }
	public function getPrefixSolicitudDeclaracion(){ return $this->prefixSolicitudDeclaracion; }
	public function getPrefixSolicitudModificacion(){ return $this->prefixSolicitudModificacion; }
	public function getPrefixSolicitudReclamo(){ return $this->prefixSolicitudReclamo; }

	public function getFormasPago() { return $this->formasPago; }
	public function getFormaPago($key) { return $this->formasPago[$key]; }

	public function getSolicitantesPolizaModificaciones() { return $this->solicitantesPolizaModificaciones; }
	public function getSolicitantePolizaModificaciones($key) { return $this->solicitantesPolizaModificaciones[$key]; }


	public function arrayToCommaSeparatedList($array)
	{
		$list = "";
		$i=0;
		foreach($array as $key)
		{
			if($i==0)
				$list = '\''.$key.'\'';
			else
				$list .= ',\''. $key.'\'';
			$i++;
		}
		return $list;
	}

	public function commaSeparatedListToArray($list)
	{
		$array = explode(',', $list);
		return $list;
	}

	public function getDiasBetweenFechas($fechaInicio, $fechaFin)
	{

		$fechaInicio = strtotime($fechaInicio);
		$fechaFin = strtotime($fechaFin);
		$datediff = $fechaFin - $fechaInicio;
		return floor($datediff / (60 * 60 * 24));
	}

}