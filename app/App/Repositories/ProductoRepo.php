<?php

namespace App\App\Repositories;

use App\App\Entities\Producto;

class ProductoRepo extends BaseRepo{

	public function getModel()
	{
		return new Producto;
	}

	public function all($orderBy)
	{
		return Producto::with('aseguradora')->orderBy($orderBy)->get();
	}

	public function getByAseguradora($aseguradoraId)
	{
		return Producto::where('aseguradora_id','=',$aseguradoraId)->get();
	}

}