<?php

namespace App\App\Managers;

use App\App\Entities\ProductoCobertura;

class ProductoCoberturaManager extends BaseManager
{

	protected $entity;
	protected $data;

	public function __construct($entity, $data)
	{
		$this->entity = $entity;
        $this->data   = $data;
	}

	function getRules()
	{

		$rules = [
			'producto_id'  => 'required',
			'cobertura_id' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		if(!isset($data['amparada'])) $data['amparada'] = null;
		return $data;
	}

	function agregarCoberturas($producto, $coberturas)
	{
		try{
			\DB::beginTransaction();
				foreach($coberturas as $cobertura)
				{
					if(isset($cobertura['seleccionado'])){
						$pc = new ProductoCobertura();
						$pc->cobertura_id = $cobertura['id'];
						$pc->producto_id = $producto->id;
						$pc->suma_asegurada = $cobertura['suma_asegurada'];
						$pc->pct_deducible = $cobertura['pct_deducible'];
						$pc->deducible_minimo = $cobertura['deducible_minimo'];
						if(isset($cobertura['amparado']))
							$pc->amparada = 1;
						else
							$pc->amparada = 0;
						$pc->save();
					}
				}
		        
	        \DB::commit();
	    }
	    catch(\Exception $ex)
	    {
	    	throw new SaveDataException('Error',$ex);
	    }
	}

}