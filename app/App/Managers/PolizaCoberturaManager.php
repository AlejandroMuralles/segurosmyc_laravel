<?php

namespace App\App\Managers;
use Session;
use App\App\Entities\PolizaCobertura;

class PolizaCoberturaManager extends BaseManager
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
			'cobertura_id'  	=> 'required',
			'poliza_id'  	 	=> 'required',
			'suma_asegurada'  	=> 'required',
			'deducible' => 'required',
			'porcentaje_deducible' => 'required',
			'deducible_minimo' => 'required'
		];

		return $rules;
	}

	function getRulesAgregarProducto()
	{
		$rules = [
			'coberturas.*.cobertura_id'		=> 'required',
			'coberturas.*.poliza_id'			=> 'required',
			'coberturas.*.suma_asegurada'	=> 'required'
		];
		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregarProducto($polizaId){
		$rules = $this->getRulesAgregarProducto();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
        	Session::flash('errores', $this->getMensajes($validation->messages()->getMessages()));
            throw new ValidationException('Validation failed', $validation->messages()->getMessages());
        }
        try{
        	\DB::beginTransaction();
				foreach($this->data['coberturas'] as $cobertura){
		        	$pc = new PolizaCobertura();
		        	$pc->fecha_inclusion = date('Y-m-d');
		        	$pc->estado = 'P';
		        	$pc->fill($this->prepareData($cobertura));
					$pc->save();
		        }
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			$message = $ex->getMessage();
			if(str_contains($message,'Duplicate entry'))
			{
				throw new SaveDataException('¡Error!', new \Exception('Verifique ya que se está tratando de agregar una cobertura que ya posee la póliza.'));
			}
			throw new SaveDataException('¡Error!', $ex);
		}
        		
		return true;
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

	function getMensajes($errores)
	{
		$mensajes = [];
		foreach($errores as $error){
			foreach($error as $e){
				$mensajes[] = $e;
			}
		}
		return $mensajes;
	}

}