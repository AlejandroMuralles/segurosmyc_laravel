<?php

namespace App\App\Repositories;

use App\App\Entities\ProductoCobertura;
use App\App\Entities\Cobertura;

class ProductoCoberturaRepo extends BaseRepo{

	public function getModel()
	{
		return new ProductoCobertura;
	}

	public function getByProducto($productoId)
	{
		$coberturas = ProductoCobertura::where('producto_id','=',$productoId)
								->with('cobertura')
								->get();
		//$coberturas = $coberturas->sortBy(function ($cobertura) { return $cobertura->nombre; });
		return $coberturas;
	}

	public function getNotInProducto($productoId)
	{
		$ids = ProductoCobertura::where('producto_id','=',$productoId)
									->select('cobertura_id')
									->pluck('cobertura_id');
		return Cobertura::whereNotIn('id',$ids)
								->orderBy('nombre')
								->get(); 
	}

}