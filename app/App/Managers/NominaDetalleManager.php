<?php

namespace App\App\Managers;
use \App\App\Entities\NominaDetalle;
use \App\App\Repositories\NominaDetalleRepo;
use \App\App\Repositories\ColaboradorRepo;
use \App\App\Repositories\VacacionColaboradorRepo;
use \App\App\Repositories\SuspensionIgssColaboradorRepo;
use \App\App\Repositories\DescuentoColaboradorRepo;
use \App\App\Repositories\PrestamoCuotaRepo;


class NominaDetalleManager extends BaseManager
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
		$rules = [];
		return $rules;
	}

	function prepareData($data)
	{
		return $data;
	}

	function generarAnticipoQuincenal($nomina)
	{ 
		$colaboradorRepo = new ColaboradorRepo();
		try{
			\DB::beginTransaction();

				$nomina->estado = 'G';
				$nomina->save();

				/*Obtener colaboradores*/
				$colaboradores = $colaboradorRepo->all('nombres');
				foreach($colaboradores as $colaborador)
				{
					$nd = new NominaDetalle();
					$nd->nomina_id = $nomina->id;
					$nd->colaborador_id = $colaborador->id;
					/*Dias trabajados y sueldo ordinario*/
					$dias_trabajados = 0;
					if($colaborador->fecha_ingreso < $nomina->fecha_inicio){
						$dias_trabajados = $this->getDiasBetweenFechas($nomina->fecha_inicio, $nomina->fecha_final);
						$nd->sueldo_ordinario = $colaborador->sueldo_base / 2;
					}
					else{
						$dias_trabajados = $this->getDiasBetweenFechas($colaborador->fecha_ingreso, $nomina->fecha_final);
						$nd->sueldo_ordinario = 0;
					}
					$nd->dias_trabajados = $dias_trabajados;
					$nd->total_ingresos = $nd->sueldo_ordinario;
					$nd->liquido_recibido = $nd->sueldo_ordinario;
					$nd->save();

				}


			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('Error',$ex);
		}
	}

	function generarNominaMensual($nomina)
	{
		$diasMes = intval(date('t',strtotime($nomina->fecha_inicio)));

		$colaboradorRepo = new ColaboradorRepo();
		$vacacionColaboradorRepo = new VacacionColaboradorRepo();
		$suspensionIgssColaboradorRepo = new SuspensionIgssColaboradorRepo();
		$descuentoColaboradorRepo = new DescuentoColaboradorRepo();
		$prestamoCuotaRepo = new PrestamoCuotaRepo();

		try{
			\DB::beginTransaction();

				$nomina->estado = 'G';
				$nomina->save();

				/*Obtener colaboradores*/
				$colaboradores = $colaboradorRepo->all('nombres');
				foreach($colaboradores as $colaborador)
				{
					$nd = new NominaDetalle();
					$nd->nomina_id = $nomina->id;
					$nd->colaborador_id = $colaborador->id;
					/*Dias trabajados y sueldo ordinario*/
					$diasTrabajados = 0;
					if($colaborador->fecha_ingreso < $nomina->fecha_inicio){
						$diasTrabajados = $this->getDiasBetweenFechas($nomina->fecha_inicio, $nomina->fecha_final);						
					}
					else{
						$diasTrabajados = $this->getDiasBetweenFechas($colaborador->fecha_ingreso, $nomina->fecha_final);
					}					

					/*CALCULO DIAS DE VACACIONES*/
					$vacaciones = $vacacionColaboradorRepo->getByColaboradorBetweenFechas($colaborador->id, $nomina->fecha_inicio, $nomina->fecha_final);
					$diasVacaciones = 0;
					foreach($vacaciones as $vacacion)
					{
						$diasVacaciones += $vacacion->dias_gozados;
					}
					$diasTrabajados -= $diasVacaciones;
					$nd->dias_trabajados = $diasTrabajados;
					$nd->dias_vacaciones = $diasVacaciones;

					$nd->sueldo_ordinario = round(($diasTrabajados * $colaborador->sueldo_base) / $diasMes,2);
					$nd->sueldo_vacaciones = round(($diasVacaciones * $colaborador->sueldo_base) / $diasMes,2);

					/*SUSPENSIONES IGSS*/
					$suspensionesIgss = $suspensionIgssColaboradorRepo->getByColaborador($colaborador->id);
					$diasIgss = 0;
					foreach($suspensionesIgss as $suspensionIgss)
					{
						//Si ambas fechas estan dentro de las fechas de nomina
						if( ($suspensionIgss->fecha_inicio >= $nomina->fecha_inicio && $suspensionIgss->fecha_inicio <= $nomina->fecha_final) &&
							($suspensionIgss->fecha_fin >= $nomina->fecha_inicio && $suspensionIgss->fecha_fin <= $nomina->fecha_final)){

							$diasIgss += $this->getDiasBetweenFechas($suspensionIgss->fecha_inicio, $suspensionIgss->fecha_fin);

						}
						/* SI INICIA EN EL MES DE LA NOMINA PERO TERMINA EN EL MES SIGUIENTE */
						elseif( ($suspensionIgss->fecha_inicio >= $nomina->fecha_inicio && $suspensionIgss->fecha_inicio <= $nomina->fecha_final) &&
							($suspensionIgss->fecha_fin >= $nomina->fecha_inicio && $suspensionIgss->fecha_fin > $nomina->fecha_final)){

							$diasIgss += $this->getDiasBetweenFechas($suspensionIgss->fecha_inicio, $nomina->fecha_final);

						}
						/* SI INICIA EN OTRO MES PERO TERMINA EN EL MES DE LA NOMINA*/
						elseif( ($suspensionIgss->fecha_inicio < $nomina->fecha_inicio && $suspensionIgss->fecha_inicio <= $nomina->fecha_final) &&
							($suspensionIgss->fecha_fin >= $nomina->fecha_inicio && $suspensionIgss->fecha_fin <= $nomina->fecha_final)){

							$diasIgss += $this->getDiasBetweenFechas($nomina->fecha_inicio, $suspensionIgss->fecha_fin);

						}
						/* SI ABARCA TODO EL MES */
						elseif( $suspensionIgss->fecha_inicio < $nomina->fecha_inicio && $suspensionIgss->fecha_fin > $nomina->fecha_final)
						{
							$diasIgss += $diasMes;
						}

					}

					$nd->dias_suspension_igss = $diasIgss;
					$nd->sueldo_igss = round(($diasIgss * $colaborador->sueldo_base) / $diasMes,2);

					$totalDescuentos = 0;
					/* DESCUENTOS */
					$descuentos = $descuentoColaboradorRepo->getByColaboradorByEstadoBetweenFechas($colaborador->id, ['A'], $nomina->fecha_inicio);
					foreach($descuentos as $descuento)
					{
						//Si descuento es ISR
						if($descuento->tipo_descuento_id == 1)
						{
							$nd->isr = $descuento->valor;
						}
						else
						{
							$totalDescuentos += $descuento->valor;
						}
					}

					$nd->otras_deducciones = $totalDescuentos;

					/* PRESTAMOS */
					$totalPrestamos = 0;
					$mesNomina = date('Y-m-t',strtotime($nomina->fecha_inicio));
					$cuotasColaborador = $prestamoCuotaRepo->getByColaboradorByMesCobro($colaborador->id, $mesNomina );
					foreach($cuotasColaborador as $cuotaColaborador)
					{
						$totalPrestamos += $cuotaColaborador->valor;
						$cuotaColaborador->mes_pago = $mesNomina;
						$cuotaColaborador->estado = 'C';
						$cuotaColaborador->nomina_id = $nomina->id;
						$cuotaColaborador->save();

						/* CUOTAS DE PRESTAMO ACTUAL - SE VERIFICA SI YA SE PAGARON TODAS LAS CUOTAS PARA ACTUALIZAR EL PRESTAMO */
						$cuotasPrestamo = $prestamoCuotaRepo->getByPrestamo($cuotaColaborador->prestamo_id);
						foreach($cuotasPrestamo as $cuotaPrestamo)
						{
							$cuotasCanceladas = true;
							if($cuotaPrestamo->estado == 'N'){
								$cuotasCanceladas = false;
							}
						}
						if($cuotasCanceladas){
							$prestamo = $cuotaColaborador->prestamo;
							$prestamo->estado = 'C';
							$prestamo->save();
						}


					}
					//$nd->total_prestamos = $totalPrestamos;
					$nd->otras_deducciones += $totalPrestamos;
					$nd->total_ingresos = $nd->sueldo_ordinario + $nd->sueldo_vacaciones;
					$nd->liquido_recibido = $nd->sueldo_ordinario - $nd->sueldo_igss - $nd->otras_deducciones - $nd->isr;

					//dd($nd);
					$nd->save();

				}


			\DB::commit();
		}
		catch(\Exception $ex)
		{
			throw new SaveDataException('Error',$ex);
		}
	}

	private function getDiasBetweenFechas($fechaInicio, $fechaFin)
	{
		$dias	= (strtotime($fechaInicio)-strtotime($fechaFin))/86400;
		$dias 	= abs($dias); 
		$dias   = floor($dias);
		return $dias+1;
	}

}
