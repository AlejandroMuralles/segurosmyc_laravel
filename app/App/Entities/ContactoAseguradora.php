<?php

namespace App\App\Entities;

class ContactoAseguradora extends \Eloquent {

	protected $table = 'contacto_aseguradora';

	protected $fillable = ['nombre','telefonos','correo','empresa_celular','celular','aseguradora_id','fecha_nacimiento','extension','observaciones','area_aseguradora_id'];

	public function cliente()
	{
		return $this->belongsTo('App\App\Entities\Cliente');
	}

	public function area()
	{
		return $this->belongsTo('App\App\Entities\AreaAseguradora');
	}

}