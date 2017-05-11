<?php

namespace App\App\Repositories;

use App\App\Entities\Cliente;

class ClienteRepo extends BaseRepo{

	public function getModel()
	{
		return new Cliente;
	}

	public function getByConsorcio($consorcioId)
	{
		return Cliente::where('consorcio_id',$consorcioId)
						->orderBy('nombre')
						->get();
	}

}
