<?php

namespace App\App\Managers;
use App\App\Entities\Poliza;
use Auth;

class PolizaManager extends BaseManager
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
			'cliente_id'  			=> 'required',
			'aseguradora_id'        => 'required',
			'ejecutivo_id'			=> 'required',
			'dueno_id'				=> 'required',
		];

		return $rules;
	}

	function getRulesAprobar()
	{

		$rules = [
			'numero'	=> 'required',
		];

		return $rules;
	}

	function prepareData($data)
	{
        if(isset($data['ramo_id'])){
            if($data['ramo_id'] == 1) $data['ruta'] = 'ver_poliza';
            if($data['ramo_id'] == 2) $data['ruta'] = 'ver_poliza';
            if($data['ramo_id'] == 5) $data['ruta'] = 'ver_poliza';
            if($data['anual_declarativa'] == 'D') $data['ruta'] = 'ver_poliza_declarativa';
            if($data['ramo_id'] == 6) $data['ruta'] = 'ver_poliza_hidrocarburos';
        }

		return $data;
	}

    function editar($poliza, $vehiculos)
    {
        $errorMessage = '¡Error editando póliza!';
        $rules = $this->getRules();
        $validation = \Validator::make($this->data, $rules);
        if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }
        try{
            \DB::beginTransaction();
                $poliza->fill($this->prepareData($this->data));
                $poliza->save();

                foreach($vehiculos as $vehiculo)
                {
                    $errorMessage = 'Error editando vehiculos';

                    $prima_neta = $vehiculo->prima_neta;

                    $pct_fraccionamiento = $poliza->pct_fraccionamiento;
                    $pct_emision = $poliza->pct_emision;
                    $pct_iva =  $poliza->pct_iva;

                    $fraccionamiento = round($prima_neta*$pct_fraccionamiento,2);
                    $emision = round($prima_neta * $pct_emision,2);
                    $iva = round(($prima_neta + $fraccionamiento + $emision) * $pct_iva,2);
                    $prima_total = round($prima_neta + $emision + $fraccionamiento + $iva,2);

                    $vehiculo->pct_fraccionamiento = $pct_fraccionamiento;
                    $vehiculo->fraccionamiento = $fraccionamiento;
                    $vehiculo->pct_emision = $pct_emision;
                    $vehiculo->emision = $emision;
                    $vehiculo->pct_iva = $pct_iva;
                    $vehiculo->iva = $iva;
                    
                    $vehiculo->prima_total = $prima_total;

                    $vehiculo->save();
                }

            \DB::commit();
        }
        catch(\Exception $ex)
        {
            throw new SaveDataException($errorMessage, $ex);
        }
        
        return true;

    }

	function aprobarSolicitud($vehiculos, $coberturasGenerales, $coberturasParticulares)
	{
		$errorMessage = '¡Error editando póliza!';
		$rules = $this->getRulesAprobar();
		$validation = \Validator::make($this->data, $rules);
		if ($validation->fails())
        {
            throw new ValidationException('Validation failed', $validation->messages());
        }
        try{
        	\DB::beginTransaction();
        		$this->entity->fill($this->prepareData($this->data));
				$this->entity->save();

				foreach($vehiculos as $vehiculo)
				{
					$errorMessage = 'Error editando vehiculos';
					$vehiculo->estado = 'V';
					$vehiculo->save();
				}
				foreach($coberturasGenerales as $coberturaG)
				{
					$errorMessage = 'Error editando coberturas generales';
					$coberturaG->estado = 'V';
					$coberturaG->save();
				}
				foreach($coberturasParticulares as $coberturaP)
				{
					$errorMessage = 'Error editando coberturas particulares';
					$coberturaP->estado = 'V';
					$coberturaP->save();
				}
				
			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException($errorMessage, $ex);
		}
		
		return true;
	}

	function anular($poliza, $motivoAnulacionId, $vehiculos, $coberturas, $coberturasParticulares, $requerimientos, $inclusiones, $exclusiones)
	{
		$fecha = date('Y-m-d H:i:s');
		try{
        	\DB::beginTransaction();

        		$poliza->estado = 'A';
        		$poliza->motivo_anulacion_id = $motivoAnulacionId;
        		$poliza->fecha_anulada = $fecha;
        		$poliza->save();

        		/*foreach($vehiculos as $vehiculo)
        		{
        			$vehiculo->estado = 'A';
        			$vehiculo->motivo_anulacion_id = $motivoAnulacionId;
        			$vehiculo->fecha_anulacion = $fecha;
        			$vehiculo->save();
        		}

        		foreach($coberturas as $cobertura)
        		{
        			$cobertura->estado = 'A';
        			$cobertura->motivo_anulacion_id = $motivoAnulacionId;
        			$cobertura->save();
        		}

        		foreach($coberturasParticulares as $coberturaParticular)
        		{
        			$coberturaParticular->estado = 'A';
        			$coberturaParticular->motivo_anulacion_id = $motivoAnulacionId;
        			$coberturaParticular->fecha_anulacion = $fecha;
        			$coberturaParticular->save();
        		}

        		foreach($requerimientos as $requerimiento)
        		{
        			$requerimiento->estado = 'A';
        			$requerimiento->motivo_anulacion_id = $motivoAnulacionId;
        			$requerimiento->fecha_anulacion = $fecha;
        			$requerimiento->save();
        		}

        		foreach($inclusiones as $inclusion)
        		{
        			$inclusion->estado = 'A';
        			$inclusion->motivo_anulacion_id = $motivoAnulacionId;
        			$inclusion->fecha_anulacion = $fecha;
        			$inclusion->save();
        		}

        		foreach($exclusiones as $exclusion)
        		{
        			$exclusion->estado = 'A';
        			$exclusion->motivo_anulacion_id = $motivoAnulacionId;
        			$exclusion->fecha_anulacion = $fecha;
        			$exclusion->save();
        		}*/


        	\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('Error', $ex);
		}
		
		return true;
	}

	function renovar($poliza, $vehiculos, $coberturas, $coberturasParticulares, $inclusiones, $exclusiones)
	{
		$fecha = date('Y-m-d H:i:s');
		try{
        	\DB::beginTransaction();

        		$poliza->estado = 'R';
        		$poliza->fecha_renovada = $fecha;
        		$poliza->save();

        		$polizaNueva = new Poliza();
        		$polizaNueva->fill($this->data);
        		$polizaNueva->estado = 'S';
        		$polizaNueva->fecha_solicitud = $fecha;
                $polizaNueva->numero = $poliza->numero;
                $polizaNueva->poliza_anterior_id = $poliza->id;
                $polizaNueva->ramo_id = $poliza->ramo_id;
                $polizaNueva->ruta = $poliza->ruta;
        		$polizaNueva->save();

        		foreach($vehiculos as $vehiculo)
        		{
        			$vehiculoNuevo = $vehiculo->replicate();
        			$vehiculoNuevo->estado = 'P';
        			$vehiculoNuevo->fecha_inclusion = $fecha;
        			$vehiculoNuevo->poliza_id = $polizaNueva->id;
        			$vehiculoNuevo->poliza_inclusion_id = null;
        			$vehiculoNuevo->fecha_anulacion = null;
        			$vehiculoNuevo->motivo_anulacion_id = null;
        			$vehiculoNuevo->save();

        			$vehiculo->estado = 'R';
        			$vehiculo->save();
        		}

        		foreach($coberturas as $cobertura)
        		{
        			$coberturaNueva = $cobertura->replicate();
        			$coberturaNueva->estado = 'P';
        			$coberturaNueva->fecha_inclusion = $fecha;
        			$coberturaNueva->poliza_id = $polizaNueva->id;
        			$coberturaNueva->poliza_inclusion_id = null;
        			$coberturaNueva->fecha_anulacion = null;
        			$coberturaNueva->motivo_anulacion_id = null;
        			$coberturaNueva->save();

        			$cobertura->estado = 'R';
        			$cobertura->save();
        		}

        		foreach($coberturasParticulares as $coberturaParticular)
        		{
        			$coberturaParticularNueva = $coberturaParticular->replicate();
        			$coberturaParticularNueva->estado = 'P';
        			$coberturaParticularNueva->fecha_inclusion = $fecha;
        			$coberturaParticularNueva->poliza_id = $polizaNueva->id;
        			$coberturaParticularNueva->poliza_inclusion_id = null;
        			$coberturaParticularNueva->fecha_anulacion = null;
        			$coberturaParticularNueva->motivo_anulacion_id = null;
        			$coberturaParticularNueva->save();

        			$coberturaParticular->estado = 'R';
        			$coberturaParticular->save();
        		}

        		/*foreach($requerimientos as $requerimiento)
        		{
        			$requerimiento->estado = 'A';
        			$requerimiento->motivo_anulacion_id = $motivoAnulacionId;
        			$requerimiento->save();
        		}*/

        		foreach($inclusiones as $inclusion)
        		{
        			$inclusion->estado = 'R';
        			$inclusion->save();
        		}

        		foreach($exclusiones as $exclusion)
        		{
        			$exclusion->estado = 'R';
        			$exclusion->save();
        		}


        	\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('Error', $ex);
		}
		
		return true;
	}

    function eliminarSolicitud($poliza, $vehiculos, $coberturas, $coberturasParticulares)
    {
        $fecha = date('Y-m-d H:i:s');
        try{
            \DB::beginTransaction();

                foreach($coberturasParticulares as $coberturaParticular)
                {
                    $coberturaParticular->delete();
                }

                foreach($vehiculos as $vehiculo)
                {
                    $vehiculo->delete();
                }

                foreach($coberturas as $cobertura)
                {
                    $cobertura->delete();
                }

                $poliza->delete();


            \DB::commit();
        }
        catch(\Exception $ex)
        {
            throw new SaveDataException('Error', $ex);
        }
        
        return true;
    }

    public function copiarSolicitud($poliza, $vehiculos, $coberturasGenerales, $coberturasParticulares)
    {
        try{
            \DB::beginTransaction();

                $nuevaPoliza = $poliza->replicate();
                $nuevaPoliza->user_created = Auth::user()->username;
                $nuevaPoliza->user_updated = Auth::user()->username;
                $nuevaPoliza->fecha_solicitud = date('Y-m-d H:i:s');
                $nuevaPoliza->save();

                foreach($vehiculos as $vehiculo)
                {
                    $nuevoVehiculo = $vehiculo->replicate();
                    $nuevoVehiculo->poliza_id = $nuevaPoliza->id;
                    $nuevoVehiculo->fecha_inclusion = date('Y-m-d H:i:s');
                    $nuevoVehiculo->user_created = Auth::user()->username;
                    $nuevoVehiculo->user_updated = Auth::user()->username;
                    $nuevoVehiculo->save();
                }

                foreach($coberturasGenerales as $cobertura)
                {
                    $nuevaCobertura = $cobertura->replicate();
                    $nuevaCobertura->poliza_id = $nuevaPoliza->id;
                    $nuevaCobertura->fecha_inclusion = date('Y-m-d H:i:s');
                    $nuevaCobertura->user_created = Auth::user()->username;
                    $nuevaCobertura->user_updated = Auth::user()->username;
                    $nuevaCobertura->save();
                }

                foreach($coberturasParticulares as $coberturaP)
                {
                    $nuevaCoberturaParticular = $coberturaP->replicate();
                    $nuevaCoberturaParticular->poliza_id = $nuevaPoliza->id;
                    $nuevaCoberturaParticular->fecha_inclusion = date('Y-m-d H:i:s');
                    $nuevaCoberturaParticular->user_created = Auth::user()->username;
                    $nuevaCoberturaParticular->user_updated = Auth::user()->username;
                    $nuevaCoberturaParticular->save();
                }

            \DB::commit();
        }
        catch(\Exception $ex)
        {
            throw new SaveDataException('Error', $ex);
        }
        
        return $nuevaPoliza;
    }

}
