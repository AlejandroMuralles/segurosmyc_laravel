<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, PDF;

use App\App\Entities\Planilla;
use App\App\Repositories\PlanillaRepo;
use App\App\Managers\PlanillaManager;

use App\App\Repositories\AseguradoraRepo;
use App\App\Repositories\PolizaRequerimientoRepo;
use App\App\Repositories\PolizaRepo;

class PlanillaController extends BaseController {

	protected $planillaRepo;
	protected $aseguradoraRepo;
	protected $polizaRequerimientoRepo;
	protected $polizaRepo;

	public function __construct(PlanillaRepo $planillaRepo, AseguradoraRepo $aseguradoraRepo, PolizaRequerimientoRepo $polizaRequerimientoRepo, PolizaRepo $polizaRepo)
	{
		$this->planillaRepo = $planillaRepo;
		$this->aseguradoraRepo = $aseguradoraRepo;
		$this->polizaRequerimientoRepo = $polizaRequerimientoRepo;
		$this->polizaRepo = $polizaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado($aseguradoraId)
	{
		$aseguradoras = $this->aseguradoraRepo->lists('nombre','id');
		if($aseguradoraId == 0)
			$planillas = $this->planillaRepo->all('fecha');
		else
			$planillas = $this->planillaRepo->getByAseguradora($aseguradoraId);
		return View::make('administracion/planillas/index', compact('planillas','aseguradoraId','aseguradoras'));
	}

	public function mostrarAgregar($aseguradoraId){
		$aseguradoras = $this->aseguradoraRepo->lists('nombre','id');
		return View::make('administracion/planillas/agregar',compact('aseguradoraId','aseguradoras'));
	}

	public function agregar($aseguradoraId)
	{
		$data = Input::all();
		$data['estado'] = 'N';
		$data['tipo'] = 1;
		$manager = new PlanillaManager(new Planilla(), $data);
		$planilla = $manager->save();
		Session::flash('success', 'Se agregó la planilla con éxito.');
		return Redirect::route('buscar_requerimientos_planilla',$planilla->id);
	}

	public function mostrarBuscarRequerimientos($planillaId)
	{
		$planilla = $this->planillaRepo->find($planillaId);
		$fechaInicio = $planilla->fecha;
		$fechaFinal = $planilla->fecha;
		if($planilla->tipo == 1)
			$requerimientos = $this->polizaRequerimientoRepo->getByAseguradoraBetweenFechaCobroByEstadoNotInPlanilla(
					$planilla->aseguradora_id,$fechaInicio,$fechaFinal,['C']
				);
		if($planilla->tipo == 2)
			$requerimientos = $this->polizaRequerimientoRepo->getByPolizaBetweenFechaCobroByEstadoNotInPlanilla(
					$planilla->poliza_id,$fechaInicio,$fechaFinal,['C']
				);
		return View::make('administracion/planillas/buscar',compact('planilla','fechaInicio','fechaFinal','requerimientos'));
	}

	public function buscarRequerimientos($planillaId)
	{
		$planilla = $this->planillaRepo->find($planillaId);
		$fechaInicio = Input::get('fecha_inicio');
		$fechaFinal = Input::get('fecha_final');
		if($planilla->tipo == 1)
			$requerimientos = $this->polizaRequerimientoRepo->getByAseguradoraBetweenFechaCobroByEstadoNotInPlanilla(
					$planilla->aseguradora_id,$fechaInicio,$fechaFinal,['C']
				);
		if($planilla->tipo == 2)
			$requerimientos = $this->polizaRequerimientoRepo->getByPolizaBetweenFechaCobroByEstadoNotInPlanilla(
					$planilla->poliza_id,$fechaInicio,$fechaFinal,['C']
				);
		return View::make('administracion/planillas/buscar',compact('planilla','fechaInicio','fechaFinal','requerimientos'));
	}

	public function agregarRequerimientos($planillaId)
	{
		$planilla = $this->planillaRepo->find($planillaId);
		$requerimientos = Input::get('requerimientos');
		$cuenta = 0;
		foreach($requerimientos as $r)
		{
			if(isset($r['check'])){
				$cuenta++;
			}
		}
		if($cuenta == 0){
			throw new \App\App\Managers\SaveDataException('¡Error!', new \Exception('No seleccionó ningun requerimiento.'));
		}
		$manager = new PlanillaManager(null, null);
		$manager->agregarRequerimientos($planilla, $requerimientos);
		Session::flash('success', 'Se agregaron los  requerimientos a la planilla con éxito.');
		return Redirect::route('ver_planilla',$planilla->id);
	}

	public function ver($planillaId)
	{
		$planilla = $this->planillaRepo->find($planillaId);
		$requerimientos = $this->polizaRequerimientoRepo->getByPlanilla($planilla->id);
		return View::make('administracion/planillas/ver',compact('planilla','requerimientos'));
	}

	public function mostrarAgregarPlanillaPoliza($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		return View::make('administracion/planillas/agregar_planilla_poliza',compact('poliza','requerimientos'));
	}

	public function agregarPlanillaPoliza($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$data = Input::all();
		$data['estado'] = 'N';
		$data['tipo'] = 2;
		$data['poliza_id'] = $polizaId;
		$data['aseguradora_id'] = $poliza->aseguradora_id;
		$manager = new PlanillaManager(new Planilla(), $data);
		$planilla = $manager->save();
		Session::flash('success', 'Se agregó la planilla con éxito.');
		return Redirect::route('buscar_requerimientos_planilla',$planilla->id);
	}

	public function reporteDiaria($planillaId)
	{
		$planilla = $this->planillaRepo->find($planillaId);
		$requerimientos = $this->polizaRequerimientoRepo->getByPlanilla($planilla->id);
		$pdf = PDF::loadView('reportes/planillas/diaria', compact('planilla','requerimientos'));
		$pdf->setPaper('letter', 'landscape');
		return $pdf->download('Planilla - '. date('Ymd', strtotime($planilla->fecha)) .' - '. $planilla->aseguradora->nombre .'.pdf');
	}

	public function reportePoliza($planillaId)
	{
		$planilla = $this->planillaRepo->find($planillaId);
		$requerimientos = $this->polizaRequerimientoRepo->getByPlanilla($planilla->id);
		$pdf = PDF::loadView('reportes/planillas/poliza', compact('planilla','requerimientos'));
		$pdf->setPaper('letter', 'landscape');
		return $pdf->download('Planilla - '. date('Ymd', strtotime($planilla->fecha)) .' - '. $planilla->poliza->numero_solicitud .'.pdf');
	}

	public function mostrarEditar($id){
		$planilla = $this->planillaRepo->find($id);
		return View::make('administracion/planillas/editar', compact('planilla'));
	}

	public function editar($id)
	{
		$planilla = $this->planillaRepo->find($id);
		$manager = new PlanillaManager($planilla, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó la planilla con éxito.');
		return Redirect::route('planillas');
	}
}
