<?php

namespace App\App\Repositories;

use App\App\Entities\PolizaRequerimiento;

class PolizaRequerimientoRepo extends BaseRepo{

	public function getModel()
	{
		return new PolizaRequerimiento;
	}

	public function getByPoliza($polizaId)
	{
		return PolizaRequerimiento::where('poliza_id','=',$polizaId)->get();
	}

	public function getByPolizaByEstado($polizaId, $estados)
	{
		return PolizaRequerimiento::where('poliza_id','=',$polizaId)->whereIn('estado',$estados)->orderBy('fecha_cobro')->get();
	}

	public function getByEstadoBeforeFechaCobro($estados, $fecha)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
									->where('fecha_cobro','<=',$fecha)
									->whereHas('poliza',function($q){
										$q->with('aseguradora');
									})
									->with('poliza')
									->orderBy('fecha_cobro','ASC')
									->get();
	}

	public function getByEstadoBeforeFechaCobroByEstadoPoliza($estados, $fecha, $estadosPoliza)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
									->where('fecha_cobro','<=',$fecha)
									->whereHas('poliza',function($q) use ($estadosPoliza) {
										$q->with('aseguradora');
										$q->with('ramo');
										$q->whereIn('estado',$estadosPoliza);
									})
									->with('poliza')
									->with('poliza.aseguradora')
									->with('poliza.ramo')
									->with('poliza.cliente')
									->orderBy('fecha_cobro','ASC')
									->get();
	}

	public function getByEstadoBeforeFechaCobroByEstadoPolizaByAseguradora($estados, $fecha, $estadosPoliza, $aseguradoraId)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
			->where('fecha_cobro','<=',$fecha)
			->whereHas('poliza',function($q) use ($estadosPoliza,$aseguradoraId)
			{
				$q->where('aseguradora_id',$aseguradoraId);
				$q->with('aseguradora');
				$q->with('ramo');
				$q->whereIn('estado',$estadosPoliza);
			})
			->with('poliza')
			->with('poliza.aseguradora')
			->with('poliza.ramo')
			->with('poliza.cliente')
			->orderBy('fecha_cobro','ASC')
			->get();
	}

	public function getByEstadoBeforeFechaCobroByEstadoPolizaByRamo($estados, $fecha, $estadosPoliza, $ramoId)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
					->where('fecha_cobro','<=',$fecha)
					->whereHas('poliza',function($q) use ($estadosPoliza,$ramoId)
					{
						$q->where('ramo_id',$ramoId);
						$q->with('aseguradora');
						$q->with('ramo');
						$q->whereIn('estado',$estadosPoliza);
					})
					->with('poliza')
					->with('poliza.aseguradora')
					->with('poliza.ramo')
					->with('poliza.cliente')
					->orderBy('fecha_cobro','ASC')
					->get();
	}

	public function getByEstadoBeforeFechaCobroByEstadoPolizaByAseguradoraByRamo($estados, $fecha, $estadosPoliza, $aseguradoraId, $ramoId)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
			->where('fecha_cobro','<=',$fecha)
			->whereHas('poliza', function($q) use ($estadosPoliza, $aseguradoraId, $ramoId)
			{
				$q->where('aseguradora_id',$aseguradoraId);
				$q->where('ramo_id',$ramoId);
				$q->with('aseguradora');
				$q->with('ramo');
				$q->whereIn('estado',$estadosPoliza);
			})
			->with('poliza')
			->with('poliza.aseguradora')
			->with('poliza.ramo')
			->with('poliza.cliente')
			->orderBy('fecha_cobro','ASC')
			->get();
	}

	public function getByAseguradoraBetweenFechaCobroByEstadoNotInPlanilla($aseguradoraId, $fechaInicio, $fechaFin, $estados)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
				->whereBetween('fecha_cobro',[$fechaInicio, $fechaFin])
				->whereHas('poliza',function($q) use ($aseguradoraId) {
					$q->where('aseguradora_id',$aseguradoraId);
				})
				->with('poliza')
				->whereNull('planilla_id')
				->with('poliza.cliente')
				->orderBy('fecha_cobro','ASC')
				->get();
	}

	public function getByPolizaBetweenFechaCobroByEstadoNotInPlanilla($polizaId, $fechaInicio, $fechaFin, $estados)
	{
		return PolizaRequerimiento::whereIn('estado',$estados)
									->whereBetween('fecha_cobro',[$fechaInicio, $fechaFin])
									->where('poliza_id',$polizaId)
									->with('poliza')
									->whereNull('planilla_id')
									->orderBy('fecha_cobro','ASC')
									->get();
	}

	public function getByPlanilla($planillaId)
	{
		return PolizaRequerimiento::where('planilla_id',$planillaId)->get();
	}

}