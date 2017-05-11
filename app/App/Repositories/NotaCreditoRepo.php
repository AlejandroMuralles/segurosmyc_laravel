<?php

namespace App\App\Repositories;

use App\App\Entities\NotaCredito;

class NotaCreditoRepo extends BaseRepo{

	public function getModel()
	{
		return new NotaCredito;
	}

	public function getByPoliza($polizaId)
	{
		return NotaCredito::where('poliza_id','=',$polizaId)->get();
	}

	public function getByExclusion($exclusionId)
	{
		return NotaCredito::where('poliza_exclusion_id','=',$exclusionId)->get();
	}

}