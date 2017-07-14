<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\PolizaRequerimiento;
use App\App\Repositories\PolizaRequerimientoRepo;
use App\App\Managers\PolizaRequerimientoManager;

use App\App\Repositories\PolizaRepo;
use App\App\Repositories\PorcentajeFraccionamientoAseguradoraRepo;
use App\App\Repositories\PorcentajeFraccionamientoGeneralRepo;

use App\App\Repositories\PolizaInclusionRepo;
use App\App\Repositories\MotivoAnulacionRepo;

use App\App\Repositories\PolizaDeclaracionRepo;
use App\App\Repositories\ClienteRepo;

class PolizaRequerimientoController extends BaseController {

	protected $polizaRequerimientoRepo;
	protected $polizaRepo;
	protected $polizaInclusionRepo;
	protected $pfgRepo;
	protected $pfaRepo;
	protected $motivoAnulacionRepo;
	protected $polizaDeclaracionRepoRepo;
	protected $clienteRepo;

	public function __construct(PolizaRequerimientoRepo $polizaRequerimientoRepo, PolizaRepo $polizaRepo, PolizaInclusionRepo $polizaInclusionRepo, PorcentajeFraccionamientoGeneralRepo $pfgRepo,
			PorcentajeFraccionamientoAseguradoraRepo $pfaRepo, MotivoAnulacionRepo $motivoAnulacionRepo, PolizaDeclaracionRepo $polizaDeclaracionRepo, ClienteRepo $clienteRepo)
	{
		$this->polizaRequerimientoRepo = $polizaRequerimientoRepo;
		$this->polizaRepo = $polizaRepo;
		$this->polizaInclusionRepo = $polizaInclusionRepo;
		$this->pfgRepo = $pfgRepo;
		$this->pfaRepo = $pfaRepo;
		$this->motivoAnulacionRepo = $motivoAnulacionRepo;
		$this->polizaDeclaracionRepo = $polizaDeclaracionRepo;
		$this->clienteRepo = $clienteRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($polizaId){
		$poliza = $this->polizaRepo->find($polizaId);
		$inclusiones = $this->polizaInclusionRepo->getByPolizaByEstado($polizaId, ['V'])->pluck('endoso','id')->toArray();
		$declaraciones = $this->polizaDeclaracionRepo->getByPolizaByEstado($polizaId, ['V'])->pluck('endoso','id')->toArray();
		$clientes = $this->clienteRepo->getByConsorcio($poliza->cliente->consorcio_id)->pluck('nombre','id')->toArray();
		$numero = 0;
		$numero_inicial = 0;		
		$prima_neta = $poliza->total_prima_neta;
		$asistencia = $poliza->total_asistencia;
		$requerimientos = $this->polizaRequerimientoRepo->getByPolizaByEstado($polizaId, ['N','C']);
		foreach($requerimientos as $r)
		{
			$prima_neta -= $r->prima_neta;
			$asistencia -= $r->asistencia;
		}
		$prima_neta = number_format($prima_neta,2,'.','');
		$cantidad_pagos = $poliza->cantidad_pagos;
		$fecha_inicio = $poliza->fecha_inicio;	
		$polizaInclusionId = 0;
		$polizaDeclaracionId = 0;
		$clienteId = 0;
		$pctDescuento = 0;
		$descuento = 0;
		$observaciones = "";
		return View::make('administracion/poliza_requerimientos/agregar', compact('poliza','numero_inicial','numero','fecha_inicio','prima_neta','asistencia','cantidad_pagos','inclusiones','polizaInclusionId','polizaDeclaracionId','declaraciones','clienteId','clientes','pctDescuento','descuento','observaciones'));
	}

	public function agregar($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$data = Input::all();
		$manager = new PolizaRequerimientoManager(new PolizaRequerimiento(), $data);
		$manager->agregarRequerimientos($poliza);
		Session::flash('success', 'Se agregaron los requerimientos con éxito.');
		if($poliza->estado == 'S')
			$url = route('ver_solicitud_poliza',$polizaId).'#requerimientos';
		else
			$url = route($poliza->ruta,$polizaId).'#requerimientos';
		return Redirect::to($url);
	}

	public function generarRequerimientos($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$declaraciones = $this->polizaDeclaracionRepo->getByPolizaByEstado($polizaId, ['V'])->pluck('endoso','id')->toArray();
		$inclusiones = $this->polizaInclusionRepo->getByPoliza($polizaId)->pluck('endoso','id')->toArray();
		$clientes = $this->clienteRepo->getByConsorcio($poliza->cliente->consorcio_id)->pluck('nombre','id')->toArray();
		$observaciones = Input::get('observaciones');;
		$cantidad_pagos = Input::get('cantidad_pagos');;
		$polizaInclusionId = Input::get('poliza_inclusion_id');
		$polizaDeclaracionId = Input::get('poliza_declaracion_id');
		$clienteId = Input::get('cliente_id');
		$descuento = Input::get('descuento');
		$pctDescuento = Input::get('pct_descuento') / 100;
		if($polizaInclusionId == '') $polizaInclusionId = null;
		if($polizaDeclaracionId == '') $polizaDeclaracionId = null;
		if($clienteId == '') $clienteId = null;
		if($observaciones == '') $observaciones = null;
		$requerimientos = array();

		$numero_inicial = Input::get('numero');
		$numero = $numero_inicial;
		$prima_neta = Input::get('prima_neta');
		$prima_neta_frac = $prima_neta / $cantidad_pagos;
		$descuento_frac = $descuento / $cantidad_pagos;

		$asistencia = Input::get('asistencia');
		$asistencia_frac = $asistencia / $cantidad_pagos;

		$pct_fraccionamiento = $poliza->pct_fraccionamiento;
		$pct_iva = $poliza->pct_iva;
		$pct_emision = $poliza->pct_emision;

		$mesesFrecuenciaPago = $poliza->frecuenciaPago->meses;

		$fecha_inicio = Input::get('fecha_inicio');
		$totalPrimaNeta = 0;
		$totalPrimaTotal = 0;
		$totalAsistencia = 0;
		
		for($i=1;$i<=$cantidad_pagos;$i++)
		{
			$r = new PolizaRequerimiento();
			$r->numero = $numero;
			$r->fecha_cobro = date('Y-m-d', strtotime("+".$mesesFrecuenciaPago*($i-1)." months", strtotime($fecha_inicio)));
			
			$r->prima_neta = round($prima_neta_frac,2);
			$r->asistencia = round($asistencia_frac,2);
			$r->fraccionamiento = round($r->prima_neta * $pct_fraccionamiento,2);
			$r->emision = round($r->prima_neta * $pct_emision,2);
			$r->iva = round(($r->prima_neta + $r->fraccionamiento + $r->emision + $r->asistencia ) * $pct_iva,2);
			$r->sub_total_prima = $r->prima_neta + $r->fraccionamiento + $r->emision + $r->iva + $r->asistencia;
			$r->pct_descuento = $pctDescuento;
			$r->descuento = round($descuento_frac,2);
			$r->prima_total = round($r->sub_total_prima - $descuento_frac,2);
			$r->cuota = $i;
			$r->observaciones = $observaciones;
			$r->poliza_inclusion_id = $polizaInclusionId;
			$r->poliza_declaracion_id = $polizaDeclaracionId;
			$r->cliente_id = $clienteId;
			
			$requerimientos[] = $r;
			$totalPrimaNeta += $r->prima_neta;
			$totalPrimaTotal += $r->prima_total;
			$totalAsistencia += $r->asistencia;
			$numero++;
		}
		$pctDescuento = $pctDescuento*100;
		return View::make('administracion/poliza_requerimientos/agregar', compact('poliza','requerimientos','numero_inicial','numero','prima_neta','fecha_inicio','totalPrimaNeta','totalPrimaTotal','cantidad_pagos','inclusiones','polizaInclusionId','polizaDeclaracionId','declaraciones','clientes','clienteId','asistencia','totalAsistencia','pctDescuento','descuento','observaciones'));
	}

	public function mostrarEditar($id){
		$requerimiento = $this->polizaRequerimientoRepo->find($id);
		$clientes = $this->clienteRepo->getByConsorcio($requerimiento->poliza->cliente->consorcio_id)->pluck('nombre','id')->toArray();
		return View::make('administracion/poliza_requerimientos/editar', compact('requerimiento','clientes'));
	}

	public function editar($id)
	{
		$requerimiento = $this->polizaRequerimientoRepo->find($id);
		$data = Input::all();
		$data['cuota'] = $requerimiento->cuota;
		$data['poliza_id'] = $requerimiento->poliza_id;
		$data['numero'] = $requerimiento->numero;
		$manager = new PolizaRequerimientoManager($requerimiento, $data);
		$manager->save();
		Session::flash('success', 'Se editó el requerimiento con éxito.');
		$url = route($requerimiento->poliza->ruta,$requerimiento->poliza_id).'#requerimientos';
		return Redirect::to($url);
	}

	public function mostrarPendientes()
	{
		$motivos = $this->motivoAnulacionRepo->lists('nombre','id');
		$estado = ['N'];
		$fecha = date('Y-m-d', strtotime('+15 days', time()));
		$requerimientos = $this->polizaRequerimientoRepo->getByEstadoBeforeFechaCobroByEstadoPoliza($estado, $fecha, ['V']);
		return View::make('administracion/poliza_requerimientos/pendientes', compact('requerimientos'));
	}

	public function anular()
	{
		$data = Input::all();
		$id = $data['requerimiento_id'];
		$data['estado'] = 'A';
		$data['fecha_anulacion'] = date('Y-m-d H:i:s');		
		$requerimiento = $this->polizaRequerimientoRepo->find($id);
		$manager = new PolizaRequerimientoManager($requerimiento, $data);
		$manager->anular();
		Session::flash('success', 'Se anuló el requerimiento '. $requerimiento->numero .' con éxito.');
		$url = route($requerimiento->poliza->ruta,$requerimiento->poliza_id).'#requerimientos';
		return Redirect::to($url);
	}

	public function eliminar()
	{
		$data = Input::all();
		$id = $data['requerimiento_eliminar_id'];
		$requerimiento = $this->polizaRequerimientoRepo->find($id);
		$manager = new PolizaRequerimientoManager($requerimiento, $data);
		$manager->eliminar();
		Session::flash('success', 'Se eliminó el requerimiento '. $requerimiento->numero .' con éxito.');
		$url = route($requerimiento->poliza->ruta,$requerimiento->poliza_id).'#requerimientos';
		return Redirect::to($url);
	}

	public function mostrarNoCobradosPorMes()
	{
		$fecha = date('Y-m-d');
		$requerimientosPendientes = $this->polizaRequerimientoRepo->getByEstadoBeforeFechaCobro(['N'], $fecha);
		$meses = [];
		foreach($requerimientosPendientes as $r)
		{
			$mes = date('m',strtotime($r->fecha_cobro));
			$meses[$mes]['mes'] = date('m-Y', strtotime($r->fecha_cobro));
			if( !isset($meses[$mes]['total_no_cobrado']))
				$meses[$mes]['total_no_cobrado'] = 0;
			$meses[$mes]['total_no_cobrado'] += $r->prima_total;
			if( !isset($meses[$mes]['requerimientos']))
				$meses[$mes]['requerimientos'] = 0;
			$meses[$mes]['requerimientos']++;
		}

		$noCobrados = count($requerimientosPendientes);
		$requerimientosCobrados = $this->polizaRequerimientoRepo->getByEstadoBeforeFechaCobro(['C'], $fecha);
		$cobrados = count($requerimientosCobrados);
		$totalRequerimientos = $noCobrados + $cobrados;
		$porcentaje = $cobrados * 100 / $totalRequerimientos;

		return View::make('administracion/poliza_requerimientos/no_cobrado_mes', compact('meses','noCobrados','cobrados','totalRequerimientos','porcentaje'));
	}


}
