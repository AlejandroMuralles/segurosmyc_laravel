<?php

namespace App\App\Repositories;

use App\App\Entities\PagoRequerimiento;

class PagoRequerimientoRepo extends BaseRepo{

	public function getModel()
	{
		return new PagoRequerimiento;
	}

	public function getByRequerimiento($polizaRequerimientoId)
	{
		return PagoRequerimiento::where('requerimiento_id',$polizaRequerimientoId)->get();
	}

}