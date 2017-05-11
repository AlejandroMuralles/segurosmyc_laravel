<?php

namespace App\App\Managers;

class PolizaCoberturaVehiculoManager extends BaseManager
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
			'poliza_vehiculo_id'  => 'required',
			'poliza_id'  => 'required',
			'vehiculo_id'  => 'required',
			'cobertura_id'  => 'required',
			'suma_asegurada'  => 'required',
			'deducible' => 'required',
			'porcentaje_deducible' => 'required',
			'deducible_minimo' => 'required',
			'fecha_inclusion'  => 'required|date',
			'estado' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	public function save()
	{
		try{
			$this->isValid();
			$this->entity->fill($this->prepareData($this->data));
			$this->entity->save();
			return true;
		}
		catch(\Exception $ex)
		{
			$message = $ex->getMessage();
			if(str_contains($message,'Duplicate entry'))
			{
				throw new SaveDataException('¡Error!', new \Exception('Este vehículo ya contiene la cobertura a ingresar.'));
			}
			throw new SaveDataException('¡Error!', $ex);
		}
		return false;
	}

	public function eliminar()
	{
		try{
        	\DB::beginTransaction();
				$this->entity->delete();
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
	}

}