<?php

namespace App\App\Repositories;

use App\App\Entities\PlanillaRequerimiento;

class PlanillaRequerimientoRepo extends BaseRepo{

	public function getModel()
	{
		return new PlanillaRequerimiento;
	}

	public function getByPlanilla($planillaId)
	{
		return Planilla::where('planilla_id',$planillaId)->get();
	}

}