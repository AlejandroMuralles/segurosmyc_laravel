<?php

namespace App\App\Entities;

class ContactoCliente extends \Eloquent {

	protected $table = 'contacto_cliente';

	protected $fillable = ['nombre','telefonos','correo','empresa_celular','celular','cliente_id','fecha_nacimiento'];

	public function cliente()
	{
		return $this->belongsTo('App\App\Entities\Cliente');
	}

}