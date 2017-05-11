<?php

namespace App\App\Managers;
use App\App\Entities\PolizaVehiculo;

class PolizaVehiculoManager extends BaseManager
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
			'vehiculo_id'  		=> 'required',
			'poliza_id'  	 	=> 'required',
			'suma_asegurada'  	=> 'required',
			'prima_neta'		=> 'required',
			'iva'				=> 'required',
		];

		return $rules;
	}

	function getRulesCertificado()
	{

		$rules = [
			'numero_certificado'  => 'required',
		];

		return $rules;
	}

	function getRulesCambiarEstadoDeclaracion()
	{
		$rules = [
			'activo_declaracion'  => 'required',
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
				throw new SaveDataException('¡Error!', new \Exception('Este vehículo ya existe en la póliza.'));
			}
			throw new SaveDataException('¡Error!', $ex);
		}
		return false;
	}

	public function editarCertificado()
	{
		try{
			$rules = $this->getRulesCertificado();
			$validation = \Validator::make($this->data, $rules);
			if ($validation->fails())
	        {
	            throw new ValidationException('Validation failed', $validation->messages());
	        }
			$this->entity->fill($this->prepareData($this->data));
			$this->entity->save();
			return true;
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
		return false;
	}

	public function eliminar($vehiculo, $coberturasVehiculo)
	{
		try{
        	\DB::beginTransaction();        		
        		foreach($coberturasVehiculo as $cobertura)
        		{
        			$cobertura->delete();
        		}
        		$vehiculo->delete();
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
	}

	public function cambiarEstadoDeclaracion()
	{
		try{
        	$this->entity->save();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
	}

	public function agregarVarios()
	{
		try{
			\DB::beginTransaction();
				foreach($this->data['vehiculos'] as $vehiculo){
					$v = new PolizaVehiculo();
					$v->fill($this->prepareData($vehiculo));
					$v->save();
				}
			\DB::commit();
			return true;
		}
		catch(\Exception $ex)
		{
			$message = $ex->getMessage();
			if(str_contains($message,'Duplicate entry'))
			{
				throw new SaveDataException('¡Error!', new \Exception('Este vehículo ya existe en la póliza.'));
			}
			throw new SaveDataException('¡Error!', $ex);
		}
		return false;
	}

}