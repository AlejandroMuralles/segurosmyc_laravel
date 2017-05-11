<?php

namespace App\App\Repositories;

use App\App\Entities\Colaborador;
use App\App\Entities\User;

class ColaboradorRepo extends BaseRepo{

	public function getModel()
	{
		return new Colaborador;
	}

	public function all($orderBy)
	{
		return Colaborador::with(['puesto' => function ($query) {
    				$query->with('area');
				}])->orderBy($orderBy)->get();
	}

	public function getWithoutUsuario()
	{
		$ids = User::select('colaborador_id')->pluck('colaborador_id')->toArray();
		return Colaborador::whereNotIn('id',$ids)
						->orderBy('nombres')
						->orderBy('apellidos')
						->get();
	}

}