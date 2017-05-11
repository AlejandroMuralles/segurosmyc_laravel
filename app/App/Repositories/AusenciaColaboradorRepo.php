<?php

namespace App\App\Repositories;

use App\App\Entities\AusenciaColaborador;

class AusenciaColaboradorRepo extends BaseRepo{

	public function getModel()
	{
		return new AusenciaColaborador;
	}

	public function getByColaborador($colaboradorId)
	{
		return AusenciaColaborador::where('colaborador_id',$colaboradorId)->get();
	}

}