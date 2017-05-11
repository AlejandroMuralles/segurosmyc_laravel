<?php

namespace App\App\Repositories;

use App\App\Entities\Puesto;

class PuestoRepo extends BaseRepo{

	public function getModel()
	{
		return new Puesto;
	}

	public function all($orderBy)
	{
		return Puesto::with('area')->orderBy($orderBy)->get();
	}

	public function getByArea($areaId)
	{
		return Puesto::where('area_id','=',$areaId)->get();
	}

}