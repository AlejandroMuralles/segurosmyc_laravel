<?php

namespace App\App\Entities;

class BitacoraPoliza extends \Eloquent {
	protected $fillable = ['poliza_id','observaciones'];

	protected $table = 'bitacora_poliza';

	public function poliza()
	{
		return $this->belongsTo('App\App\Entities\Poliza');
	}

}