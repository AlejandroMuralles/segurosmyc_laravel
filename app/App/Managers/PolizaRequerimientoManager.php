<?php

namespace App\App\Managers;

use App\App\Entities\PolizaRequerimiento;

class PolizaRequerimientoManager extends BaseManager
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
			'poliza_id'  	 	=> 'required',
			'numero'  			=> 'required',
			'cuota'				=> 'required',
			'fecha_cobro'		=> 'required',
			'prima_neta'  		=> 'required',
			'prima_total'  		=> 'required',
			'fraccionamiento'	=> 'required',
			'emision'  			=> 'required',
			'iva'				=> 'required',

		];

		return $rules;
	}

	function getRulesForVarious()
	{

		$rules = [
			'requerimiento.*.numero'  			=> 'required',
			'requerimiento.*.cuota'				=> 'required',
			'requerimiento.*.fecha_cobro'		=> 'required',
			'requerimiento.*.prima_neta'  		=> 'required',
			'requerimiento.*.prima_total'  		=> 'required',
			'requerimiento.*.fraccionamiento'	=> 'required',
			'requerimiento.*.emision'  			=> 'required',
			'requerimiento.*.iva'				=> 'required',
		];

		return $rules;
	}

	function getRulesAnular()
	{
		$rules = [
			'estado' => 'required',
			'fecha_anulacion' => 'required|date',
			'observacion_anulacion' => 'required'
		];
		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregarRequerimientos($poliza)
	{
		$rules = $this->getRulesForVarious();
		$requerimientos = $this->data['requerimientos'];
        try{
        	\DB::beginTransaction();
        		foreach($requerimientos as $requerimiento)
        		{
        			$r = new PolizaRequerimiento();
        			$r->fill($this->prepareData($requerimiento));
        			$r->pago_pendiente = $r->prima_total;

        			if($r->poliza_inclusion_id == '') $r->poliza_inclusion_id = null;
        			if($r->poliza_declaracion_id == '') $r->poliza_inclusion_id = null;
        			if($r->cliente_id == '') $r->cliente_id = null;
        			if($r->observaciones == '') $r->observaciones = null;     
        			$r->planilla_id = null;   			

        			$r->poliza_id = $poliza->id;
        			$r->estado = 'N';
        			$r->save();
        		}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		
	}

	function anular()
	{
		$rules = $this->getRulesAnular();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }
		$this->entity->fill($this->prepareData($this->data));
		$this->entity->save();
		return true;
	}

	function eliminar()
	{
		try{
        	\DB::beginTransaction();
				$this->entity->cliente_id = null;
				$this->entity->save();
				$this->entity->delete();
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			\DB::rollback();
			throw new SaveDataException('¡Error!', $ex);
		}
		return true;
	}

}