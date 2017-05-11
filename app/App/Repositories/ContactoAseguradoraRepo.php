<?php

namespace App\App\Repositories;

use App\App\Entities\ContactoAseguradora;

class ContactoAseguradoraRepo extends BaseRepo{

	public function getModel()
	{
		return new ContactoAseguradora;
	}

	public function getByAseguradora($aseguradoraId)
	{
		return ContactoAseguradora::where('aseguradora_id','=',$aseguradoraId)->get();
	}

}