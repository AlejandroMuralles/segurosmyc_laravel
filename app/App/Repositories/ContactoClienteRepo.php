<?php

namespace App\App\Repositories;

use App\App\Entities\ContactoCliente;

class ContactoClienteRepo extends BaseRepo{

	public function getModel()
	{
		return new ContactoCliente;
	}

	public function getByCliente($clienteId)
	{
		return ContactoCliente::where('cliente_id','=',$clienteId)->get();
	}

}