<?php

namespace App\App\Managers;
use App\App\Entities\PrestamoCuota;

class PrestamoManager extends BaseManager
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
			'colaborador_id'  => 'required',
			'valor' => 'required',
			'descripcion' => 'required',
			'cuotas' => 'required',
			'estado' => 'required'
		];

		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function agregar()
	{
		try{
			\DB::beginTransaction();

				//$this->data[]
				
				$this->data = $this->prepareData($this->data);

				$this->isValid();		
				$this->entity->fill($this->data);
				$this->entity->mes_inicio_cobro = $this->entity->mes_inicio_cobro . '-01';
				$this->entity->save();

				$totalCuotas = 0;
				for($i=1;$i<=$this->entity->cuotas;$i++)
				{
					$cuota = new PrestamoCuota();
					$cuota->prestamo_id = $this->entity->id;
					$cuota->cuota = $i;
					$cuota->mes_cobro = date('Y-m-t', strtotime("+".($i-1)." months",strtotime($this->entity->mes_inicio_cobro)));
					$cuota->estado = 'N';
					$cuota->valor = number_format($this->entity->valor / $this->entity->cuotas,2);

					//ajustando centavos por aproximación de decimales
					if($i==$this->entity->cuotas){
						$cuota->valor = $this->entity->valor - $totalCuotas;
					}

					$totalCuotas += $cuota->valor;
					$cuota->save();
				}
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('¡Error!', $ex);
		}
	}
}