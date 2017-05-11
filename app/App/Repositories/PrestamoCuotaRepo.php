<?php

namespace App\App\Repositories;

use App\App\Entities\PrestamoCuota;

class PrestamoCuotaRepo extends BaseRepo{

	public function getModel()
	{
		return new PrestamoCuota;
	}

	public function getByPrestamo($prestamoId)
	{
		return PrestamoCuota::where('prestamo_id',$prestamoId)->get();
	}

	public function getByColaborador($colaboradorId)
	{
		return PrestamoCuota::whereHas('prestamo', function($q) use ($colaboradorId){
									$q->where('colaborador_id',$colaboradorId);
								})
								->with('prestamo')
								->get();
	}

	public function getByColaboradorByMesCobro($colaboradorId, $mes)
	{
		return PrestamoCuota::whereHas('prestamo', function($q) use ($colaboradorId){
									$q->where('colaborador_id',$colaboradorId);
								})
								->where('mes_cobro',$mes)
								->with('prestamo')
								->get();
	}

}