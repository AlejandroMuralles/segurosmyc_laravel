<?php

namespace App\App\Managers;
use App\App\Entities\Pago;
use App\App\Entities\PagoRequerimiento;
use App\App\Repositories\PolizaRequerimientoRepo;

class PagoRequerimientoManager extends BaseManager
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
			'fecha_pago'  		=> 'required',
			'forma_pago'  		=> 'required',
			'monto'		  		=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregarPagoRequerimiento()
	{
		try{
        	\DB::beginTransaction();

        		$polizaRequerimientoRepo = new PolizaRequerimientoRepo();
        		$montoTotal = $this->data['monto'];
        		$montoActual = round($montoTotal,2);
        		$pago = new Pago();
        		$pago->fill($this->prepareData($this->data));
        		$pago->save();
        		$requerimientos = $this->data['requerimientos'];
        		foreach($requerimientos as $r)
        		{
        			if(isset($r['check'])){
	        			$polizaRequerimiento = $polizaRequerimientoRepo->find($r['id']);
	        			$pagoRequerimiento = new PagoRequerimiento();
	        			$pagoRequerimiento->pago_id = $pago->id;
	        			$pagoRequerimiento->requerimiento_id = $polizaRequerimiento->id;
	        			if ($montoActual >= $polizaRequerimiento->pago_pendiente && $polizaRequerimiento->pago_pendiente > 0)
	        			{
	        				$pagoRequerimiento->monto = $polizaRequerimiento->pago_pendiente;
	        				$montoActual = round($montoActual - $polizaRequerimiento->pago_pendiente,2);
	        				$polizaRequerimiento->pago_pendiente = 0;
	        				$polizaRequerimiento->estado = 'C';
	        				$polizaRequerimiento->fecha_pago = $pago->fecha_pago;
	        				$polizaRequerimiento->save();
	        				$pagoRequerimiento->save();
	        				//dd($pagoRequerimiento);
	        			}
	        			else if($montoActual > 0)
	        			{
	        				$pagoRequerimiento->monto = round($montoActual,2);
	        				$polizaRequerimiento->pago_pendiente = round($polizaRequerimiento->pago_pendiente - $montoActual,2);
	        				$montoActual = 0;
	        				$polizaRequerimiento->save();
	        				$pagoRequerimiento->save();
	        				//dd($polizaRequerimiento);
	        			}
	        		}

        		}
        		//dd('close');
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
	}

}