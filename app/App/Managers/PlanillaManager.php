<?php

namespace App\App\Managers;

use App\App\Repositories\PolizaRequerimientoRepo;

class PlanillaManager extends BaseManager
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
			'fecha'  			=> 'required',
			'aseguradora_id'  	=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregarRequerimientos($planilla, $requerimientos)
	{
	
		$polizaRequerimientoRepo = new PolizaRequerimientoRepo();	
	 	try{
	 		\DB::beginTransaction();

	 		foreach($requerimientos as $requerimiento)
	 		{
	 			if(isset($requerimiento['check'])){
	 				$r = $polizaRequerimientoRepo->find($requerimiento['id']);
	 				$r->planilla_id = $planilla->id;
	 				$r->save();
	 			}
	 		}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		return true;
	}

}