<?php

namespace App\App\Entities;
use Variable;

class Colaborador extends \Eloquent {

	protected $fillable = ['nombres', 'apellidos', 'dpi','telefono','puesto_id','sexo','foto','fecha_nacimiento','contratado','celular','email','horario_entrada','dias_vacaciones','fecha_ingreso','fecha_salida','motivo_salida','sueldo_base'];

	protected $table = 'colaborador';

	public function puesto()
	{
		return $this->belongsTo('App\App\Entities\Puesto');
	}

	public function getNombreCompletoAttribute()
	{
		return $this->nombres . ' ' . $this->apellidos;
	}

	public function getDescripcionSexoAttribute()
	{
		return Variable::getGenero($this->sexo);
	}

	public function getDescripcionEstadoAttribute()
	{
		return Variable::getEstadoColaborador($this->estado);
	}

}