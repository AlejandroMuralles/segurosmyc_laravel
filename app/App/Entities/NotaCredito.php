<?php

namespace App\App\Entities;

use Variable;

class NotaCredito extends \Eloquent {
	protected $fillable = ['numero_documento','observaciones','poliza_id','poliza_exclusion_id','fecha','monto'];

	protected $table = 'nota_credito';

	public function getNumeroExclusionAttribute()
	{
		if(!is_null($this->poliza_exclusion_id))
			return Variable::getPrefixSolicitudExclusion().$this->poliza_exclusion_id;
		return '';
	}

}