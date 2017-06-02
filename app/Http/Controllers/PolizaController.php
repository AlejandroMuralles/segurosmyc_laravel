<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable, PDF, Excel;

use App\App\Entities\Poliza;
use App\App\Repositories\PolizaRepo;
use App\App\Managers\PolizaManager;

use App\App\Repositories\AseguradoraRepo;
use App\App\Repositories\ClienteRepo;
use App\App\Repositories\ColaboradorRepo;
use App\App\Repositories\FrecuenciaPagoRepo;
use App\App\Repositories\PolizaVehiculoRepo;
use App\App\Repositories\PolizaInclusionRepo;
use App\App\Repositories\PolizaExclusionRepo;
use App\App\Repositories\PolizaCoberturaRepo;
use App\App\Repositories\PolizaCoberturaVehiculoRepo;
use App\App\Repositories\PolizaRequerimientoRepo;
use App\App\Repositories\ImpuestoRepo;
use App\App\Repositories\NotaCreditoRepo;
use App\App\Repositories\PorcentajeFraccionamientoGeneralRepo;
use App\App\Repositories\PorcentajeFraccionamientoAseguradoraRepo;
use App\App\Repositories\MotivoAnulacionRepo;
use App\App\Managers\SaveDataException;
use App\App\Repositories\PolizaDeclaracionRepo;
use App\App\Repositories\RamoRepo;
use App\App\Repositories\BitacoraPolizaRepo;
use App\App\Repositories\PolizaModificacionRepo;
use App\App\Repositories\PolizaVehiculoReclamoRepo;

class PolizaController extends BaseController {

	protected $polizaRepo;
	protected $aseguradoraRepo;
	protected $clienteRepo;
	protected $colaboradorRepo;
	protected $frecuenciaPagoRepo;
	protected $polizaVehiculoRepo;
	protected $polizaInclusionRepo;
	protected $polizaExclusionRepo;
	protected $polizaCoberturaRepo;
	protected $polizaRequerimientoRepo;
	protected $impuestoRepo;
	protected $notaCreditoRepo;
	protected $pfgRepo;
	protected $pfaRepo;
	protected $polizaCoberturaVehiculoRepo;
	protected $motivoAnulacionRepo;
	protected $polizaDeclaracionRepo;
	protected $ramoRepo;
	protected $bitacoraPolizaRepo;
	protected $polizaModificacionRepo;
	protected $polizaVehiculoReclamoRepo;


	public function __construct(PolizaRepo $polizaRepo, AseguradoraRepo $aseguradoraRepo, ClienteRepo $clienteRepo, ColaboradorRepo $colaboradorRepo, FrecuenciaPagoRepo $frecuenciaPagoRepo, PolizaVehiculoRepo $polizaVehiculoRepo, PolizaInclusionRepo $polizaInclusionRepo, PolizaExclusionRepo $polizaExclusionRepo,PolizaCoberturaRepo $polizaCoberturaRepo, PolizaCoberturaVehiculoRepo $polizaCoberturaVehiculoRepo, PolizaRequerimientoRepo $polizaRequerimientoRepo, ImpuestoRepo $impuestoRepo, NotaCreditoRepo $notaCreditoRepo, MotivoAnulacionRepo $motivoAnulacionRepo, PorcentajeFraccionamientoGeneralRepo $pfgRepo, PorcentajeFraccionamientoAseguradoraRepo $pfaRepo, PolizaDeclaracionRepo $polizaDeclaracionRepo, RamoRepo $ramoRepo, BitacoraPolizaRepo $bitacoraPolizaRepo, PolizaModificacionRepo $polizaModificacionRepo, PolizaVehiculoReclamoRepo $polizaVehiculoReclamoRepo)
	{
		$this->polizaRepo = $polizaRepo;
		$this->aseguradoraRepo = $aseguradoraRepo;
		$this->clienteRepo = $clienteRepo;
		$this->colaboradorRepo = $colaboradorRepo;
		$this->frecuenciaPagoRepo = $frecuenciaPagoRepo;
		$this->polizaVehiculoRepo = $polizaVehiculoRepo;
		$this->polizaInclusionRepo = $polizaInclusionRepo;
		$this->polizaExclusionRepo = $polizaExclusionRepo;
		$this->polizaCoberturaRepo = $polizaCoberturaRepo;
		$this->polizaCoberturaVehiculoRepo = $polizaCoberturaVehiculoRepo;
		$this->polizaRequerimientoRepo = $polizaRequerimientoRepo;
		$this->impuestoRepo = $impuestoRepo;
		$this->notaCreditoRepo = $notaCreditoRepo;
		$this->pfgRepo = $pfgRepo;
		$this->pfaRepo = $pfaRepo;
		$this->motivoAnulacionRepo = $motivoAnulacionRepo;
		$this->polizaDeclaracionRepo = $polizaDeclaracionRepo;
		$this->ramoRepo = $ramoRepo;
		$this->bitacoraPolizaRepo = $bitacoraPolizaRepo;
		$this->polizaModificacionRepo = $polizaModificacionRepo;
		$this->polizaVehiculoReclamoRepo = $polizaVehiculoReclamoRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$polizas = $this->polizaRepo->all('numero');
		return View::make('administracion/polizas/index', compact('polizas'));
	}

	public function mostrarPolizasByEstado($estados)
	{
		$estados = Variable::commaSeparatedListToArray($estados);
		$polizas = $this->polizaRepo->getByEstado($estados);
		return View::make('administracion/polizas/index', compact('polizas'));
	}

	public function solicitudes()
	{
		$polizas = $this->polizaRepo->getByEstado('S');
		return View::make('administracion/polizas/solicitudes', compact('polizas'));
	}

	public function mostrarAgregarSolicitud(){
		$aseguradoras = $this->aseguradoraRepo->lists('nombre','id');
		$ramos = $this->ramoRepo->lists('nombre','id');
		$clientes = $this->clienteRepo->lists('nombre','id');
		$colaboradores = $this->colaboradorRepo->listsConcat('nombres','apellidos','id');
		$frecuencias = $this->frecuenciaPagoRepo->lists('nombre','id');
		$fraccionamientos = array();
		$pfg = $this->pfgRepo->all('cantidad_pagos');
		foreach($pfg as $f)
		{
			$fraccionamientos[$f->cantidad_pagos] = $f->cantidad_pagos;
		}
		$tiposPagoPoliza = Variable::getTiposPagoPoliza();

		return View::make('administracion/polizas/agregar_solicitud', compact('aseguradoras','clientes','colaboradores','frecuencias','fraccionamientos', 'tiposPagoPoliza','ramos'));
	}

	public function agregarSolicitud()
	{
		$data = Input::all();
		$data['estado'] = 'S';
		$data['fecha_solicitud'] = date('Y-m-d H:i:s');

		$pct_fraccionamiento = 0;
		$pfa = $this->pfaRepo->getByAseguradoraByCantidadPagos($data['aseguradora_id'], $data['cantidad_pagos']);
		if(is_null($pfa)){
			$pfg = $this->pfgRepo->getByCantidadPagos($data['cantidad_pagos']);
			if(!is_null($pfg)){
				$pct_fraccionamiento = $pfg->porcentaje/100;
			}
		}
		else{
			$pct_fraccionamiento = $pfa->porcentaje/100;
		}

		$pct_emision = $this->impuestoRepo->find(Variable::getImpuesto('EMISION'))->porcentaje / 100;
		$pct_iva =  $this->impuestoRepo->find(Variable::getImpuesto('IVA'))->porcentaje / 100;

		$data['pct_fraccionamiento'] = $pct_fraccionamiento;
		$data['pct_emision'] = $pct_emision;
		$data['pct_iva'] = $pct_iva;

		if(!isset($data['aplicar_fraccionamiento'])){
			$data['pct_fraccionamiento'] = 0;
		}

		$manager = new PolizaManager(new Poliza(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la solicitud de póliza con éxito.');
		return Redirect::route('solicitudes_polizas');
	}

	public function mostrarVerSolicitud($id)
	{
		$poliza = $this->polizaRepo->find($id);
		
		if($poliza->estado != 'S')
		{
			Session::flash('error', 'La solicitud de póliza ya fue procesada. Estado actual: ' . $poliza->descripcion_estado);
			return Redirect::route('solicitudes_polizas');
		}

		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($id);
		$coberturas = $this->polizaCoberturaRepo->getByPoliza($id);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPoliza($id);
		$observaciones = $this->bitacoraPolizaRepo->getByPoliza($id);
		$requerimientos = $this->polizaRequerimientoRepo->getByPoliza($id);
		return View::make('administracion/polizas/ver_solicitud', compact('poliza', 'vehiculos','coberturas','coberturasParticulares',
			'requerimientos','observaciones'));

	}

	public function mostrarAprobarSolicitudPoliza($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);

		if($poliza->estado != 'S')
		{
			Session::flash('error', 'La solicitud de póliza ya fue procesada. Estado actual: ' . $poliza->descripcion_estado);
			return Redirect::route('solicitudes_polizas');
		}
		return View::make('administracion/polizas/aprobar_solicitud', compact('poliza'));
	}

	public function aprobarSolicitudPoliza($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);

		if($poliza->estado != 'S')
		{
			Session::flash('error', 'La solicitud de póliza ya fue procesada. Estado actual: ' . $poliza->descripcion_estado);
			return Redirect::route('solicitudes_polizas');
		}
		$poliza->estado = 'V';
		$poliza->fecha_aprobada = date('Y-m-d H:i:s');
		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($polizaId);
		$coberturasGenerales = $this->polizaCoberturaRepo->getByPoliza($polizaId);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPoliza($polizaId);
		$manager = new PolizaManager($poliza, Input::all());
		$manager->aprobarSolicitud($vehiculos, $coberturasGenerales, $coberturasParticulares);
		Session::flash('success', 'Se aprobó la póliza con éxito.');
		return Redirect::route('solicitudes_polizas');
	}

	public function vigentes()
	{
		$polizas = $this->polizaRepo->getByEstado('V');
		return View::make('administracion/polizas/vigentes', compact('polizas'));
	}

	public function mostrarVerPoliza($id)
	{
		$poliza = $this->polizaRepo->find($id);
		
		if($poliza->estado == 'S')
		{
			Session::flash('error', 'La póliza aún esta en estado de SOLICITUD.');
			return Redirect::route('polizas_vigentes');
		}

		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($id);
		$coberturas = $this->polizaCoberturaRepo->getByPoliza($id);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPoliza($id);
		$requerimientos = $this->polizaRequerimientoRepo->getByPoliza($id);
		$inclusiones = $this->polizaInclusionRepo->getByPoliza($id);
		$exclusiones = $this->polizaExclusionRepo->getByPoliza($id);
		$notas = $this->notaCreditoRepo->getByPoliza($id);
		$modificaciones = $this->polizaModificacionRepo->getByPoliza($id);
		$observaciones = $this->bitacoraPolizaRepo->getByPoliza($id);
		$motivosAnulacion = $this->motivoAnulacionRepo->lists('nombre','id');
		$reclamos = $this->polizaVehiculoReclamoRepo->getByPoliza($id);

		$totalReclamos = 0;
		foreach($reclamos as $r)
			$totalReclamos += $r->valor;

		$totalCobradoRequerimientos = 0;
		foreach ($requerimientos as $requerimiento) {
			if($requerimiento->estado == 'C')
				$totalCobradoRequerimientos += $requerimiento->prima_neta;
		}
		if($totalCobradoRequerimientos == 0)
			$siniestralidad = $totalReclamos * 100;
		else
			$siniestralidad = $totalReclamos * 100 / $totalCobradoRequerimientos;
		return View::make('administracion/polizas/ver_poliza', compact('poliza', 'vehiculos','coberturas','requerimientos','inclusiones', 'exclusiones','notas','motivosAnulacion','coberturasParticulares','observaciones','modificaciones','reclamos','totalReclamos','siniestralidad','totalCobradoRequerimientos'));

	}

	public function mostrarVerPolizaDeclarativa($id)
	{
		$poliza = $this->polizaRepo->find($id);
		
		if($poliza->estado == 'S')
		{
			Session::flash('error', 'La póliza aún esta en estado de SOLICITUD.');
			return Redirect::route('polizas_vigentes');
		}

		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($id);
		$coberturas = $this->polizaCoberturaRepo->getByPoliza($id);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPoliza($id);
		$requerimientos = $this->polizaRequerimientoRepo->getByPoliza($id);
		$inclusiones = $this->polizaInclusionRepo->getbyPoliza($id);
		$exclusiones = $this->polizaExclusionRepo->getbyPoliza($id);
		$notas = $this->notaCreditoRepo->getByPoliza($id);
		$declaraciones = $this->polizaDeclaracionRepo->getbyPoliza($id);
		$modificaciones = $this->polizaModificacionRepo->getByPoliza($id);
		$observaciones = $this->bitacoraPolizaRepo->getByPoliza($id);
		$motivosAnulacion = $this->motivoAnulacionRepo->lists('nombre','id');
		$reclamos = $this->polizaVehiculoReclamoRepo->getByPoliza($id);

		$totalReclamos = 0;
		foreach($reclamos as $r)
			$totalReclamos += $r->valor;

		$totalCobradoRequerimientos = 0;
		foreach ($requerimientos as $requerimiento) {
			if($requerimiento->estado == 'C')
				$totalCobradoRequerimientos += $requerimiento->prima_neta;
		}
		if($totalCobradoRequerimientos == 0)
			$siniestralidad = $totalReclamos * 100;
		else
			$siniestralidad = $totalReclamos * 100 / $totalCobradoRequerimientos;

		return View::make('administracion/polizas/ver_poliza_declarativa', compact('poliza', 'vehiculos','coberturas','requerimientos','inclusiones', 'exclusiones','notas','motivosAnulacion','coberturasParticulares','declaraciones','observaciones','modificaciones','reclamos','totalReclamos','siniestralidad','totalCobradoRequerimientos'));

	}

	public function mostrarVerPolizaHidrocarburos($id)
	{
		$poliza = $this->polizaRepo->find($id);
		
		if($poliza->estado == 'S')
		{
			Session::flash('error', 'La póliza aún esta en estado de SOLICITUD.');
			return Redirect::route('polizas_vigentes');
		}

		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($id);
		$coberturas = $this->polizaCoberturaRepo->getByPoliza($id);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPoliza($id);
		$requerimientos = $this->polizaRequerimientoRepo->getByPoliza($id);
		$inclusiones = $this->polizaInclusionRepo->getbyPoliza($id);
		$exclusiones = $this->polizaExclusionRepo->getbyPoliza($id);
		$notas = $this->notaCreditoRepo->getByPoliza($id);
		$declaraciones = $this->polizaDeclaracionRepo->getbyPoliza($id);
		$modificaciones = $this->polizaModificacionRepo->getByPoliza($id);
		$motivosAnulacion = $this->motivoAnulacionRepo->lists('nombre','id');
		$observaciones = $this->bitacoraPolizaRepo->getByPoliza($id);
		$reclamos = $this->polizaVehiculoReclamoRepo->getByPoliza($id);

		$totalReclamos = 0;
		foreach($reclamos as $r)
			$totalReclamos += $r->valor;

		$totalCobradoRequerimientos = 0;
		foreach ($requerimientos as $requerimiento) {
			if($requerimiento->estado == 'C')
				$totalCobradoRequerimientos += $requerimiento->prima_neta;
		}
		if($totalCobradoRequerimientos == 0)
			$siniestralidad = $totalReclamos * 100;
		else
			$siniestralidad = $totalReclamos * 100 / $totalCobradoRequerimientos;

		return View::make('administracion/polizas/ver_poliza_hidrocarburos', compact('poliza', 'vehiculos','coberturas','requerimientos','inclusiones', 'exclusiones','notas','motivosAnulacion','coberturasParticulares','declaraciones','observaciones','modificaciones','reclamos','totalReclamos','siniestralidad','totalCobradoRequerimientos'));

	}

	public function mostrarVerSolicitudIncendio($id)
	{
		$poliza = $this->polizaRepo->find($id);
		
		if($poliza->estado != 'S')
		{
			Session::flash('error', 'La solicitud de póliza ya fue procesada. Estado actual: ' . $poliza->descripcion_estado);
			return Redirect::route('solicitudes_polizas');
		}

		$observaciones = $this->bitacoraPolizaRepo->getByPoliza($id);
		$requerimientos = $this->polizaRequerimientoRepo->getByPoliza($id);
		return View::make('administracion/polizas/ver_solicitud_incendio', compact('poliza','requerimientos','observaciones'));

	}

	public function mostrarVerPolizaIncendio($id)
	{
		$poliza = $this->polizaRepo->find($id);
		
		if($poliza->estado == 'S')
		{
			Session::flash('error', 'La póliza aún esta en estado de SOLICITUD.');
			return Redirect::route('polizas_vigentes');
		}

		$requerimientos = $this->polizaRequerimientoRepo->getByPoliza($id);
		$notas = $this->notaCreditoRepo->getByPoliza($id);
		$modificaciones = $this->polizaModificacionRepo->getByPoliza($id);
		$motivosAnulacion = $this->motivoAnulacionRepo->lists('nombre','id');
		$observaciones = $this->bitacoraPolizaRepo->getByPoliza($id);
		$reclamos = $this->polizaVehiculoReclamoRepo->getByPoliza($id);

		$totalReclamos = 0;
		foreach($reclamos as $r)
			$totalReclamos += $r->valor;

		$totalCobradoRequerimientos = 0;
		foreach ($requerimientos as $requerimiento) {
			if($requerimiento->estado == 'C')
				$totalCobradoRequerimientos += $requerimiento->prima_neta;
		}
		if($totalCobradoRequerimientos == 0)
			$siniestralidad = $totalReclamos * 100;
		else
			$siniestralidad = $totalReclamos * 100 / $totalCobradoRequerimientos;

		return View::make('administracion/polizas/ver_poliza_hidrocarburos', compact('poliza','requerimientos','notas','motivosAnulacion','observaciones','modificaciones','reclamos','totalReclamos','siniestralidad','totalCobradoRequerimientos'));

	}

	public function eliminarSolicitud()
	{
		$id = Input::get('poliza_id');
		$poliza = $this->polizaRepo->find($id);
		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($id);
		$coberturas = $this->polizaCoberturaRepo->getByPoliza($id);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPoliza($id);
		$manager = new PolizaManager($poliza, null);
		$manager->eliminarSolicitud($poliza, $vehiculos, $coberturas, $coberturasParticulares);
		Session::flash('success', 'Se eliminó la solicitud de poliza ' . $poliza->numero_solicitud . ' con éxito.');
		return Redirect::route('solicitudes_polizas');
	}

	public function anular($id)
	{
		$motivoAnulacionId = Input::get('motivo_anulacion_id');
		$poliza = $this->polizaRepo->find($id);
		$vehiculos = $this->polizaVehiculoRepo->getByPolizaByEstado($id, ['V','P','SE']);
		$coberturas = $this->polizaCoberturaRepo->getByPolizaByEstado($id, ['V','P','SE']);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPolizaByEstado($id, ['V','P','SE']);
		$requerimientos = $this->polizaRequerimientoRepo->getByPolizaByEstado($id,['N']);
		$inclusiones = $this->polizaInclusionRepo->getByPolizaByEstado($id, ['S','V']);
		$exclusiones = $this->polizaExclusionRepo->getByPolizaByEstado($id, ['S','V']);
		$notas = $this->notaCreditoRepo->getByPoliza($id);
		$manager = new PolizaManager($poliza, Input::all());
		$manager->anular($poliza, $motivoAnulacionId, $vehiculos, $coberturas, $coberturasParticulares, $requerimientos, $inclusiones, $exclusiones);
		Session::flash('success', 'Se anuló la poliza con éxito.');
		return Redirect::route('polizas');
	}

	public function mostrarRenovar($id)
	{
		/*VERIFICAR SI NO TIENE REQUERIMIENTOS PENDIENTES DE COBRO*/
		$requerimientos = $this->polizaRequerimientoRepo->getByPolizaByEstado($id,['N']);
		if(count($requerimientos)>0)
		{
			throw new SaveDataException('Error', new \Exception('No se puede renovar la póliza. Existen '. count($requerimientos) . ' requerimientos sin cobrar.'));
		}

		$poliza = $this->polizaRepo->find($id);
		$aseguradoras = $this->aseguradoraRepo->lists('nombre','id');
		$clientes = $this->clienteRepo->lists('nombre','id');
		$colaboradores = $this->colaboradorRepo->listsConcat('nombres','apellidos','id');
		$frecuencias = $this->frecuenciaPagoRepo->lists('nombre','id');
		$fraccionamientos = array();
		$pfg = $this->pfgRepo->all('cantidad_pagos');
		foreach($pfg as $f)
		{
			$fraccionamientos[$f->cantidad_pagos] = $f->cantidad_pagos;
		}
		return View::make('administracion/polizas/renovar', compact('poliza','aseguradoras','clientes','colaboradores','frecuencias','fraccionamientos'));
	}

	public function renovar($id)
	{
		/*VERIFICAR SI NO TIENE REQUERIMIENTOS PENDIENTES DE COBRO*/
		$requerimientos = $this->polizaRequerimientoRepo->getByPolizaByEstado($id,['N']);
		if(count($requerimientos)>0)
		{
			throw new SaveDataException('Error', new \Exception('No se renovó la póliza. Existen '. count($requerimientos) . ' requerimientos sin cobrar.'));
		}

		$data = Input::all();

		/* CALCULOS PARA LA NUEVA SOLICITUD DE POLIZA */
		$pct_fraccionamiento = 0;
		$pfa = $this->pfaRepo->getByAseguradoraByCantidadPagos($data['aseguradora_id'], $data['cantidad_pagos']);
		if(is_null($pfa)){
			$pfg = $this->pfgRepo->getByCantidadPagos($data['cantidad_pagos']);
			if(!is_null($pfg)){
				$pct_fraccionamiento = $pfg->porcentaje/100;
			}
		}
		else{
			$pct_fraccionamiento = $pfa->porcentaje/100;
		}

		$pct_emision = $this->impuestoRepo->find(Variable::getImpuesto('EMISION'))->porcentaje / 100;
		$pct_iva =  $this->impuestoRepo->find(Variable::getImpuesto('IVA'))->porcentaje / 100;

		$data['pct_fraccionamiento'] = $pct_fraccionamiento;
		$data['pct_emision'] = $pct_emision;
		$data['pct_iva'] = $pct_iva;
		
		/* DATOS DE LA POLIZA A RENOVAR */
		$poliza = $this->polizaRepo->find($id);
		$vehiculos = $this->polizaVehiculoRepo->getByPolizaByEstado($id, ['V','P','SE']);
		$coberturas = $this->polizaCoberturaRepo->getByPolizaByEstado($id, ['V','P','SE']);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPolizaByEstado($id, ['V','P','SE']);
		$inclusiones = $this->polizaInclusionRepo->getbyPolizaByEstado($id, ['S','V']);
		$exclusiones = $this->polizaExclusionRepo->getbyPolizaByEstado($id, ['S','V']);

		$manager = new PolizaManager($poliza, $data);
		$manager->renovar($poliza, $vehiculos, $coberturas, $coberturasParticulares, $requerimientos, $inclusiones, $exclusiones);
		Session::flash('success', 'Se renovó la poliza con éxito.');
		return Redirect::route('solicitudes_polizas');
	}


	public function mostrarEditar($id){
		$aseguradoras = $this->aseguradoraRepo->lists('nombre','id');
		$ramos = $this->ramoRepo->lists('nombre','id');
		$clientes = $this->clienteRepo->lists('nombre','id');
		$colaboradores = $this->colaboradorRepo->listsConcat('nombres','apellidos','id');
		$frecuencias = $this->frecuenciaPagoRepo->lists('nombre','id');
		$fraccionamientos = array();
		$pfg = $this->pfgRepo->all('cantidad_pagos');
		foreach($pfg as $f)
		{
			$fraccionamientos[$f->cantidad_pagos] = $f->cantidad_pagos;
		}
		$tiposPagoPoliza = Variable::getTiposPagoPoliza();
		$poliza = $this->polizaRepo->find($id);
		return View::make('administracion/polizas/editar', compact('aseguradoras','clientes','colaboradores','frecuencias','fraccionamientos', 'tiposPagoPoliza','poliza','ramos'));
	}

	public function editar($id)
	{
		$poliza = $this->polizaRepo->find($id);
		$data = Input::all();

		if($poliza->estado == 'S'){ $data['estado'] = 'S'; }
		else { $data['estado'] = $poliza->estado; }

		$data['fecha_solicitud'] = $poliza->fecha_solicitud;

		$pct_fraccionamiento = 0;
		$pfa = $this->pfaRepo->getByAseguradoraByCantidadPagos($data['aseguradora_id'], $data['cantidad_pagos']);
		if(is_null($pfa)){
			$pfg = $this->pfgRepo->getByCantidadPagos($data['cantidad_pagos']);
			if(!is_null($pfg)){
				$pct_fraccionamiento = $pfg->porcentaje/100;
			}
		}
		else{
			$pct_fraccionamiento = $pfa->porcentaje/100;
		}

		$pct_emision = $this->impuestoRepo->find(Variable::getImpuesto('EMISION'))->porcentaje / 100;
		$pct_iva =  $this->impuestoRepo->find(Variable::getImpuesto('IVA'))->porcentaje / 100;

		$data['pct_fraccionamiento'] = $pct_fraccionamiento;
		$data['pct_emision'] = $pct_emision;
		$data['pct_iva'] = $pct_iva;

		if(!isset($data['aplicar_fraccionamiento'])){
			$data['pct_fraccionamiento'] = 0;
		}
		
		$manager = new PolizaManager($poliza, $data);
		$vehiculos = $this->polizaVehiculoRepo->getByPolizaByEstado($id, ['P']);
		$manager->editar($poliza, $vehiculos);
		Session::flash('success', 'Se editó el poliza con éxito.');
		if($poliza->estado == 'S')
			return Redirect::route('ver_solicitud_poliza',$poliza->id);
		else
			return Redirect::route($poliza->ruta, $poliza->id);
	}

	public function mostrarCopiarSolicitud($id){
		$poliza = $this->polizaRepo->find($id);
		return View::make('administracion/polizas/copiar', compact('poliza'));
	}

	public function copiarSolicitud($id)
	{		
		$poliza = $this->polizaRepo->find($id);
		$data = Input::all();

		$vehiculos = [];
		$coberturasGenerales = [];
		$coberturasParticulares = [];
		if(isset($data['incluir_vehiculos'])){
			$vehiculos = $this->polizaVehiculoRepo->getByPolizaByEstado($id, ['P']);
			$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPolizaByEstado($id, ['P']);
		}
		if(isset($data['incluir_coberturas'])){
			$coberturasGenerales = $this->polizaCoberturaRepo->getByPolizaByEstado($id, ['P']);	
		}	

		$manager = new PolizaManager(null, null);
		$nuevaPoliza = $manager->copiarSolicitud($poliza, $vehiculos, $coberturasGenerales, $coberturasParticulares);
		Session::flash('success', 'Se copió la solicitud poliza con éxito. Nueva póliza: ' . $nuevaPoliza->numero_solicitud);
		return Redirect::route('solicitudes_polizas');
	}

	public function reporteSolicitud($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($polizaId);
		$coberturasGenerales = $this->polizaCoberturaRepo->getByPolizaByEstado($polizaId, ['P']);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPolizaByEstado($polizaId, ['P']);
		$pdf = PDF::loadView('reportes/polizas/solicitud', compact('poliza','vehiculos','coberturasGenerales','coberturasParticulares'));
		return $pdf->download($poliza->numero_solicitud.' - '. strtoupper($poliza->cliente->nombre).'.pdf');
		return view('reportes/polizas/solicitud', compact('poliza','vehiculos','coberturasGenerales','coberturasParticulares'));
	}

	public function reporteSolicitudClientePorVehiculo($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($polizaId);
		$coberturasGenerales = $this->polizaCoberturaRepo->getByPolizaByEstado($polizaId, ['P']);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPolizaByEstado($polizaId, ['P']);
		$pdf = PDF::loadView('reportes/polizas/solicitud_cliente_vehiculo', compact('poliza','vehiculos','coberturasGenerales','coberturasParticulares'));
		return $pdf->download('Solicitud de Poliza - '.$poliza->numero_solicitud.'.pdf');
		//return view('reportes/polizas/solicitud', compact('poliza','vehiculos','coberturasGenerales','coberturasParticulares'));
	}


	public function reporteSolicitudesPendientes()
	{
		$solicitudesDB = $this->polizaRepo->getByEstado('S');
		$solicitudes = array();
		foreach($solicitudesDB as $solicitudDB)
		{
			$solicitud['FECHA SOLICITUD'] = date('d/m/y', strtotime($solicitudDB->fecha_solicitud));
			$solicitud['NUMERO SOLICITUD'] = $solicitudDB->numero_solicitud;
			$solicitud['ASEGURADORA'] = $solicitudDB->aseguradora->nombre;
			$solicitud['CLIENTE'] = $solicitudDB->cliente->nombre;
			$solicitud['DIAS ATRASO'] = $solicitudDB->dias_desde_solicitud;
			$solicitudes[] = $solicitud;
		}
		Excel::create('Solicitudes de Póliza Pendientes', function($excel) use ($solicitudes) {
			$excel->setTitle('Solicitudes de Póliza Pendientes');
		    $excel->sheet('Solicitudes Pendientes', function($sheet) use ($solicitudes) {				
				$sheet->fromArray($solicitudes);
				$sheet->setAutoFilter();
		    });
		})->export('xlsx');
	}

	public function reporteRenovacion($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$vehiculos = $this->polizaVehiculoRepo->getByPoliza($polizaId);
		$coberturasGenerales = $this->polizaCoberturaRepo->getByPolizaByEstado($polizaId, ['P']);
		$coberturasParticulares = $this->polizaCoberturaVehiculoRepo->getByPolizaByEstado($polizaId, ['P']);
		$pdf = PDF::loadView('reportes/polizas/renovacion', compact('poliza','vehiculos','coberturasGenerales','coberturasParticulares'));
		return $pdf->download('Renovación de Poliza - '.$poliza->numero_solicitud.'.pdf');
		//return view('reportes/polizas/solicitud', compact('poliza','vehiculos','coberturasGenerales','coberturasParticulares'));
	}

	public function polizasVencidas()
	{
		$polizas = $this->polizaRepo->getVencidasByEstado(['V']);
		return View::make('administracion/polizas/vencidas', compact('polizas'));
	}

	public function reportePolizasVencidas()
	{
		$polizasDB = $this->polizaRepo->getVencidasByEstado(['V']);
		$polizas = array();
		foreach($polizasDB as $polizaDB)
		{
			$poliza['NUMERO'] = $polizaDB->numero;
			$poliza['CLIENTE'] = $polizaDB->cliente->nombre;
			$poliza['FECHA INICIO'] = date('d/m/y', strtotime($polizaDB->fecha_inicio));
			$poliza['FECHA FIN'] = date('d/m/y', strtotime($polizaDB->fecha_fin));
			$poliza['ASEGURADORA'] = $polizaDB->aseguradora->nombre;
			$poliza['RAMO'] = $polizaDB->ramo->nombre;			
			$poliza['DIAS VENCIDAS'] = $polizaDB->dias_desde_solicitud;
			$polizas[] = $poliza;
		}
		Excel::create('Polizas Vigentes Vencidas', function($excel) use ($polizas) {
			$excel->setTitle('Polizas Vigentes Vencidas');
		    $excel->sheet('Polizas Vencidas', function($sheet) use ($polizas) {				
				$sheet->fromArray($polizas);
				$sheet->setAutoFilter();
		    });
		})->export('xlsx');
	}

	public function polizasVencidasMes($anio, $mes)
	{
		$polizas = [];
		if($anio != 0 && $mes != 0){
			$fechaInicio = $anio . '-' . $mes . '-1';
		}
		else{
			$fechaInicio = date('Y-m-1');
		}
		$fechaFin = date('Y-m-t', strtotime($fechaInicio));
		$polizas = $this->polizaRepo->getVencidasBetweenFechasByEstado(['V'], $fechaInicio, $fechaFin);
		return View::make('administracion/polizas/vencidas_mes', compact('polizas','fechaInicio'));
	}


}
