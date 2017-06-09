<?php

namespace App\App\Repositories;

use App\App\Entities\BitacoraPoliza;

class BitacoraPolizaRepo extends BaseRepo{

	public function getModel()
	{
		return new BitacoraPoliza;
	}

	public function getByPoliza($polizaId)
	{
		return BitacoraPoliza::where('poliza_id',$polizaId)
						->orderBy('created_at', 'DESC')
						->get();
	}

	public function getByPolizaByEstadoPoliza($polizaId, $estados)
	{
		return BitacoraPoliza::where('poliza_id',$polizaId)
						->whereIn('estado_poliza',$estados)
						->orderBy('created_at', 'DESC')
						->get();
	}

}
